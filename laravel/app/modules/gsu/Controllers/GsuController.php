<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\GsuModel;
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
		return view("gsu::index");
	}

    public function main(){
        $res = new GsuModel();
        $res = $res->getAllRequest();
        return view("gsu::admin.main", ['request' => $res]);
    }

    public function getall(){
        $res = new GsuModel();
        $res = $res->getAllRequest();
        return $res;
    }

}
