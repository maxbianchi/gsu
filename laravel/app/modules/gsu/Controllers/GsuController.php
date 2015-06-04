<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Redirect;

class GsuController extends MainController {

	public function __construct()
	{
        parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $livello = Session::get('livello');
        /*if($livello != 1) {
            return Redirect::to('/gsu/main');
        }*/

		return view("gsu::index");
	}

    public function main(){
        $res = new GsuModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->getClassColorStato($res);
        return view("gsu::$this->view_folder.main", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $res = new GsuModel();
        $res = $res->getFilteredRequest();
        $utility = new Utility();
        $class = $utility->getClassColorStato($res);
        return view("gsu::$this->view_folder.main", ['request' => $res, 'class' => $class]);
    }

    public function anagrafica(){
        $model = new GsuModel();
        $anagrafica = $model->getAllAnagrafica();
        return view("gsu::admin.anagrafica", ['anagrafica' => $anagrafica]);
    }

    public function getanagrafica(){
        $model = new GsuModel();
        $anagrafica = $model->getAnagraficaByName();
        return json_encode($anagrafica);
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/');
    }

    public function getclienti(){
        $model = new GsuModel();
        $clienti = $model->getClientiByRivenditore();
        return json_encode($clienti);
    }

}
