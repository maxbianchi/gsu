<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SimModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SimController extends MainController {

    private $tableName = "SIM";

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
        $res = new SimModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim.sim", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new SimModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim.sim", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $pianotariffario = $return['pianotariffario']['NOME_PIANO'];
        $note = $return['pianotariffario']['NOTE_PIANO'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim.sim-detail", ['request' => $res, 'btn' => $btn,'pianotariffario' => $pianotariffario, 'note' => $note, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $pianotariffario = $return['pianotariffario']['NOME_PIANO'];
        $note = $return['pianotariffario']['NOTE_PIANO'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim.sim-detail", ['request' => $res, 'btn' => $btn,'pianotariffario' => $pianotariffario, 'note' => $note, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new SimModel();
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

        $piano = $model->getPianoTariffario($res['CANONE']);

        $return['pianotariffario'] = $piano;
        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new SimModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SimModel();
        $return = $res->saveData();
        return $return;
    }

}
