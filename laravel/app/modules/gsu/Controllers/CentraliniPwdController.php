<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\CentraliniPwdModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class CentraliniPwdController extends MainController {

    private $tableName = "CENTRALINI PWD";

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
        $res = new CentraliniPwdModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.centralini-pwd.centralini-pwd", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new CentraliniPwdModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.centralini-pwd.centralini-pwd", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzacentralino = $return['assistenzacentralino'];

        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.centralini-pwd.centralini-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users,'assistenzacentralino' => $assistenzacentralino, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzacentralino = $return['assistenzacentralino'];

        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.centralini-pwd.centralini-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users, 'assistenzacentralino' => $assistenzacentralino, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new CentraliniPwdModel();
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

        if(count($res) == 0)
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        else
            $res = $res[0];

        $assistenzacentralino = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['SN'])) {
                $assistenzacentralino = $model->getAssistenzaCentralino($res['SN']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['assistenzacentralino'] = $assistenzacentralino;

        return $return;
    }

    public function delete(){
        $res = new CentraliniPwdModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new CentraliniPwdModel();
        $return = $res->saveData();
        return $return;
    }

}
