<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SimOpzioneDatiModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SimOpzioneDatiController extends MainController {


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */

    public function main(){
        $res = new SimOpzioneDatiModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-opzione-dati.sim-opzione-dati", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new SimOpzioneDatiModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-opzione-dati.sim-opzione-dati", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $opz = $return['opz'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-opzione-dati.sim-opzione-dati-detail", ['request' => $res, 'btn' => $btn,'opz' => $opz]);
    }

    public function edit(){
        $return = $this->manageShow();
        $opz = $return['opz'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-opzione-dati.sim-opzione-dati-detail", ['request' => $res, 'btn' => $btn,'opz' => $opz]);
    }

    private function manageShow(){
        $model = new SimOpzioneDatiModel();
        $res = $model->getFilteredRequest();

        $action = Route::currentRouteAction();
        $action = explode("@", $action);
        $action = $action[1];

        if($action == "edit")
            $btn = 'save';
        else
            $btn = 'back';

        if(Input::get('isnew') == 1){
            $res = [];
        }

        if(count($res) > 0) {
             $res = $res[0];
          }

        $opz = $model->getOpzioniDati();
        $return['opz'] = $opz;
        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new SimOpzioneDatiModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SimOpzioneDatiModel();
        $return = $res->saveData();
        return $return;
    }

}
