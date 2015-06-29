<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\UnigateModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class UnigateController extends MainController {

    private $tableName = "UNIGATE";

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
        $res = new UnigateModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.unigate.unigate", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new UnigateModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.unigate.unigate", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $model = new UnigateModel();
        $apparecchi = $model->getAllApparecchi();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.unigate.unigate-detail", ['request' => $res, 'btn' => $btn, 'apparecchi' => $apparecchi, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $model = new UnigateModel();
        $apparecchi = $model->getAllApparecchi();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.unigate.unigate-detail", ['request' => $res, 'btn' => $btn, 'apparecchi' => $apparecchi, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new UnigateModel();
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

        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new UnigateModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new UnigateModel();
        $return = $res->saveData();
        return $return;
    }

}
