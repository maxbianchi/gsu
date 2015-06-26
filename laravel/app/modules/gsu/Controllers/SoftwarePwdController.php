<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\SoftwarePwdModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class SoftwarePwdController extends MainController {

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
        $res = new SoftwarePwdModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.software-pwd.software-pwd", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new SoftwarePwdModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.software-pwd.software-pwd", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzatecnica = $return['assistenzatecnica'];
        $post_warranty = $return['post_warranty'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.software-pwd.software-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users,'assistenzatecnica' => $assistenzatecnica, 'post_warranty' => $post_warranty]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $assistenzatecnica = $return['assistenzatecnica'];
        $post_warranty = $return['post_warranty'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.software-pwd.software-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users, 'assistenzatecnica' => $assistenzatecnica, 'post_warranty' => $post_warranty]);
    }

    private function manageShow(){
        $model = new SoftwarePwdModel();
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
        $post_warranty = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['SN'])) {
                $assistenzatecnica = $model->getAssistenzaTecnica($res['SN']);
                $post_warranty = $model->getPostWarranty($res['SN']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['assistenzatecnica'] = $assistenzatecnica;
        $return['post_warranty'] = $post_warranty;

        return $return;
    }

    public function delete(){
        $res = new SoftwarePwdModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new SoftwarePwdModel();
        $return = $res->saveData();
        return $return;
    }


}
