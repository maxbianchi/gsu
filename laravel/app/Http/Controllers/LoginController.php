<?php namespace App\Http\Controllers;

use App\Modules\Gsu\Utility;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Utenti;
use Session;
use Redirect;
use Input;
use Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->beforeFilter('csrf', ['on' => 'post']);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = new Utenti();
        $res = $user->checkLogin();
        if($res){
            return Redirect::to('/dashboard');
        }
        return redirect('/');
	}

    public function password(){
        return view('auth.password');
    }

    public function passwordEmail(){
        $piva = Input::get('piva');
        $model = new Utenti();
        $res = $model->recuperapassword($piva);
        $utente = $res['utenti'];
        $errors = isset($res['errors']) ? $res['errors'] : "";

        $isOK = 0;
        foreach($utente as $row){
            if(!empty($row['EMAIL']))
                $isOK = 1;
        }

        if($isOK == 0)
            $errors[] = "Non &egrave; associato alcun indirizzo email al cliente selezionato";

        if(count($utente) == 0 || empty($piva) || $isOK == 0){
            return view('auth.password',['errors' => $errors]);
        }

        foreach($utente as $row){
              Mail::send('emails.password', ['pwd' => $row['PASSWORD'], 'user' => $row['DESCRIZIONE']], function($message) use ($row)
            {
                $message->to($row['EMAIL'], $row['DESCRIZIONE'])->subject('Recupero password area clienti');
            });
        }

        return view('auth.password',['message' => "Email inviata all'indirizzo da Lei indicato"]);
    }

    public function nuovaregistrazione(){
        $id = Input::get('id');
        $model = new Utenti();
        $utenti = $model->getAllUser();
        $res = $model->recuperapasswordByID($id);
        $utente = $res['utenti'];
        $errors = isset($res['errors']) ? $res['errors'] : "";

        $isOK = 0;
        foreach($utente as $row){
            if(!empty($row['EMAIL']))
                $isOK = 1;
        }

        if($isOK == 0)
            $errors = "Non &egrave; associato alcun indirizzo email al cliente selezionato";

        if(count($utente) == 0 || empty($id) || $isOK == 0){
            return view('users.users',['utenti' => $utenti, 'errors' => $errors]);
        }

        foreach($utente as $row){
            Mail::send('emails.registrazione', ['pwd' => $row['PASSWORD'], 'user' => $row['DESCRIZIONE'], 'username' => $row['UTENTE']], function($message) use ($row)
            {
                $message->to($row['EMAIL'], $row['DESCRIZIONE'])->subject('Registrazione area clienti Uniweb');
            });
        }

        return view('users.users', ['utenti' => $utenti, 'message' => "Email inviata all'indirizzo da Lei indicato"]);
    }

    public function cookiepolicy(){
        return view('cookie.cookie-policy');
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/');
    }

}
