<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\AdslModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class AdslController extends MainController {

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
        $res = new AdslModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.adsl.adsl", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new AdslModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.adsl.adsl", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $servizi_plus = $return['servizi_plus'];
        $servizi_access = $return['servizi_access'];
        return view("gsu::admin.adsl.adsl-detail", ['request' => $res, 'btn' => $btn, 'servizi_plus' => $servizi_plus, 'servizi_access' => $servizi_access]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $servizi_plus = $return['servizi_plus'];
        $servizi_access = $return['servizi_access'];
        return view("gsu::admin.adsl.adsl-detail", ['request' => $res, 'btn' => $btn, 'servizi_plus' => $servizi_plus, 'servizi_access' => $servizi_access]);
    }

    private function manageShow(){
        $model = new AdslModel();
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
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            $res = $res[0];
            if(isset($res['TGU'])) {
                $servizi_plus = $model->getServiziPlus($res['TGU']);
                $servizi_access = $model->getServiziAccess($res['TGU']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['servizi_plus'] = $servizi_plus;
        $return['servizi_access'] = $servizi_access;

        return $return;
    }

    public function delete(){
        $res = new AdslModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new AdslModel();
        $return = $res->saveData();
        return $return;
    }

}
