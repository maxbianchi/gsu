<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SmartnetModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SmartnetController extends MainController {

    private $tableName = "SMARTNET";

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
        $res = new SmartnetModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.smartnet.smartnet", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new SmartnetModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.smartnet.smartnet", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.smartnet.smartnet-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.smartnet.smartnet-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new SmartnetModel();
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

        $servizi_plus = "NO";
        $servizi_access = "NO";
        if(count($res) > 0) {
            $res = $res[0];
        }

        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new SmartnetModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SmartnetModel();
        $return = $res->saveData();
        return $return;
    }

}
