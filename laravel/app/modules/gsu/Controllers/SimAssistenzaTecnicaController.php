<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SimAssistenzaTecnicaModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SimAssistenzaTecnicaController extends MainController {

    private $tableName = "SIM ASSISTENZA TECNICA";

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
        $res = new SimAssistenzaTecnicaModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-assistenza-tecnica.sim-assistenza-tecnica", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new SimAssistenzaTecnicaModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-assistenza-tecnica.sim-assistenza-tecnica", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $opz = $return['opz'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-assistenza-tecnica.sim-assistenza-tecnica-detail", ['request' => $res, 'btn' => $btn,'opz' => $opz, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $opz = $return['opz'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-assistenza-tecnica.sim-assistenza-tecnica-detail", ['request' => $res, 'btn' => $btn,'opz' => $opz, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new SimAssistenzaTecnicaModel();
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

        $opz = $model->getOpzioniIntercom();
        $return['opz'] = $opz;
        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new SimAssistenzaTecnicaModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SimAssistenzaTecnicaModel();
        $return = $res->saveData();
        return $return;
    }

}
