<?php namespace App\Http\Controllers;

use App\Modules\Gsu\Utility;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Utenti;
use Session;
use Redirect;
use Input;
use Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {

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
        $email = Input::get('email');
        $model = new Utenti();
        $res = $model->recuperapassword($email);
        $utente = $res['utenti'];
        $errors = $res['errors'];

        if(count($utente) == 0){
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


    public function registrazione(){
        return view('auth.register');
    }

    public function registrazioneSave(){
        $model = new Utenti();
        $res = $model->registrazioneSave();
        return view('auth.register',['errors' => $res['errors'], 'messages' => $res['messages']]);
    }

}