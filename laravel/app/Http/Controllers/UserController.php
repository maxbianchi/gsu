<?php namespace App\Http\Controllers;


use App\Modules\Gsu\Utility;
use App\Utenti;
use Session;
use Input;
use Redirect;

class UserController extends Controller {

	public function __construct()
	{

        $this->beforeFilter(function(){
            $logged = Session::get('logged');
            if(is_null($logged) && $logged != 1) {
                Session::flush();
                return Redirect::to('/');
            }
        });

        $this->beforeFilter('csrf', ['on' => 'post']);

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $utenti = new Utenti();
        $utenti = $utenti->getAllUser();
		return view('users.users', ['utenti' => $utenti]);
	}

    public function adduser()
    {
        $utenti = new Utenti();
        $utenti = $utenti->getAllUserFromMago();
        return view('users.addusers', ['utenti' => $utenti]);
    }

    public function edituser()
    {
        $id = Input::get("id");
        $model = new Utenti();
        $utenti = $model->getAllUserFromMago();
        $request = $model->getAllUser($id);

        return view('users.addusers', ['utenti' => $utenti, 'request' => $request]);
    }

    public function createuser()
    {
        $codutente = Input::get('codutente');
        $username = Input::get('username');
        $password = Input::get('password');
        $livello = Input::get('livello');
        $id = Input::get('id');

        if (empty($username) || empty($password) || empty($livello) || empty($codutente)) {
            $res = ['msg' => 'Dati inseriti non validi'];
            return json_encode($res);
        }

        $usr = new Utenti();
        $usr->createUser($codutente, $username, $password, $livello,$id);
        $res = ['msg' => 'Nuovo utente creato'];
        return json_encode($res);
    }

    public function deleteuser(){
        $model = new Utenti();
        $id = Input::get('id');
        $model->deleteUser($id);
    }

    public function riferimenti(){
        $model = new Utenti();
        $riferimenti = $model->getAllRiferimenti();
        return view('users.riferimenti', ['riferimenti' => $riferimenti]);
    }

    public function AutoSetRiferimenti(){
        $model = new Utenti();
        $num = $model->autoSetRiferimenti();
        return json_encode($num);
    }

    public function riferimentiaddnew(){
        $utenti = new Utenti();
        $utenti = $utenti->getAllUserFromMago();
        return view('users.addriferimenti', ['utenti' => $utenti]);
    }

    public function riferimentisavenew(){
        try {
            $model = new Utenti();
            $model->saveRiferimento();
        }
        catch (Exception $e) {
            return 'Caught exception: '. $e->getMessage() . "\n";
        }
        return "Riferimento registrato correttamente";
    }

}
