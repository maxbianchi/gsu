<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;

class GsuController extends MainController {

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
        $model = new GsuModel();
        $anagrafica = $model->getNameAnagrafica();
		return view("gsu::index", ['anagrafica' => json_encode($anagrafica)]);
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

    public function anagrafica(){
        $model = new GsuModel();
        $anagrafica = $model->getAllAnagrafica();
        return view("gsu::admin.anagrafica", ['anagrafica' => $anagrafica]);
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/');
    }

}
