<?php namespace App\Http\Controllers;

use Session;
use Redirect;

class DashboardController extends Controller {

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
        $user = Session::get('user');
		return view('welcome',["user" => $user]);
	}

}
