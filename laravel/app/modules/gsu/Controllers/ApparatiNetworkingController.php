<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\ApparatiNetworkingModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class ApparatiNetworkingController extends MainController {

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
        $res = new ApparatiNetworkingModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.apparati-networking.apparati-networking", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new ApparatiNetworkingModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.apparati-networking.apparati-networking", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.apparati-networking.apparati-networking-detail", ['request' => $res, 'btn' => $btn, 'users' => $users]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.apparati-networking.apparati-networking-detail", ['request' => $res, 'btn' => $btn, 'users' => $users]);
    }

    private function manageShow(){
        $res = new ApparatiNetworkingModel();
        $res = $res->getFilteredRequest();

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

        $return['res'] = $res;
        $return['btn'] = $btn;

        return $return;
    }

    public function delete(){
        $res = new ApparatiNetworkingModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new ApparatiNetworkingModel();
        $return = $res->saveData();
        return $return;
    }

}
