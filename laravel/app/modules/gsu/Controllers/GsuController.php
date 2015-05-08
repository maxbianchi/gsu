<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
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
        $utility = new Utility();
        $class = $utility->getClassColorStato($res);
        return view("gsu::admin.main", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $res = new GsuModel();
        $res = $res->getFilteredRequest();
        $utility = new Utility();
        $class = $utility->getClassColorStato($res);
        return view("gsu::admin.main", ['request' => $res, 'class' => $class]);
    }

}
