<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\ApparatiMobileModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class ApparatiMobileController extends MainController {

    private $tableName = "APPARATI MOBILE";

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
        $res = new ApparatiMobileModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.apparati-mobile.apparati-mobile", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new ApparatiMobileModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.apparati-mobile.apparati-mobile", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzatecnica = $return['assistenzatecnica'];
        $model = new ApparatiMobileModel();
        $tel = $model->getAllTelefoni();
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.apparati-mobile.apparati-mobile-detail", ['request' => $res, 'btn' => $btn, 'users' => $users,'assistenzatecnica' => $assistenzatecnica, 'telefoni' => $tel, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzatecnica = $return['assistenzatecnica'];
        $model = new ApparatiMobileModel();
        $tel = $model->getAllTelefoni();
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.apparati-mobile.apparati-mobile-detail", ['request' => $res, 'btn' => $btn, 'users' => $users, 'assistenzatecnica' => $assistenzatecnica, 'telefoni' => $tel, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new ApparatiMobileModel();
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

        $assistenzatecnica = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['SN'])) {
                $assistenzatecnica = $model->getAssistenzaTecnica($res['SN']);
            }
        }



        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['assistenzatecnica'] = $assistenzatecnica;

        return $return;
    }

    public function delete(){
        $res = new ApparatiMobileModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new ApparatiMobileModel();
        $return = $res->saveData();
        return $return;
    }


}
