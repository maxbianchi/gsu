<?php namespace App\Http\Controllers;


use App\Utenti;
use Session;
use Input;

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

    public function createuser()
    {
        $codutente = Input::get('codutente');
        $username = Input::get('username');
        $password = Input::get('password');
        $livello = Input::get('livello');

        if (empty($username) || empty($password) || empty($livello) || empty($codutente)) {
            $res = ['msg' => 'Dati inseriti non validi'];
            return json_encode($res);
        }

        $usr = new Utenti();
        $usr->createUser($codutente, $username, $password, $livello);
        $res = ['msg' => 'Nuovo utente creato'];
        return json_encode($res);
    }
}