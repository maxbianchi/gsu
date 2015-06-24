<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SimExtensionModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SimExtensionController extends MainController {


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
        $res = new SimExtensionModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-extension.sim-extension", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new SimExtensionModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.sim-extension.sim-extension", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $pianotariffario = $return['pianotariffario']['NOME_PIANO'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-extension.sim-extension-detail", ['request' => $res, 'btn' => $btn,'pianotariffario' => $pianotariffario]);
    }

    public function edit(){
        $return = $this->manageShow();
        $pianotariffario = $return['pianotariffario']['NOME_PIANO'];
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.sim-extension.sim-extension-detail", ['request' => $res, 'btn' => $btn,'pianotariffario' => $pianotariffario]);
    }

    private function manageShow(){
        $model = new SimExtensionModel();
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

        $piano = $model->getPianoTariffarioExtension();
        $return['pianotariffario'] = $piano;
        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new SimExtensionModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SimExtensionModel();
        $return = $res->saveData();
        return $return;
    }

}
