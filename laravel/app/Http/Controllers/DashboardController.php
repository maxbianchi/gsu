<?php namespace App\Http\Controllers;

use Session;
use Redirect;

class DashboardController extends Controller {

	public function __construct()
	{
        $this->beforeFilter(function() {
            if (Session::has('logged') && Session::get('logged') != 1) {
                Session::flush();
                return Redirect::to('/')->with('message', 'Your are now logged out!');
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
