<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use DB;

class GsuController extends Controller {

	public function __construct()
	{
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $res = DB::select("SELECT * FROM UTENTI");
        print_r($res);
        exit;
		//return view("gsu::test");
	}

}
