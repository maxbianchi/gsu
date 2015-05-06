<?php namespace App\Http\Controllers;

use App\Utenti;
use Session;
use Redirect;

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
        echo "QUI";
        return redirect('/');
	}

    public function logout(){
        Session::flush();
        return Redirect::to('/');
    }

}
