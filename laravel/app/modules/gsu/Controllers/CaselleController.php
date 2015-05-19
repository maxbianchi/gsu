<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\CaselleModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class CaselleController extends MainController {

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
        $res = new CaselleModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.caselle.caselle", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new CaselleModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.caselle.caselle", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $activesync = $return['activesync'];
        $outlookconnector = $return['outlookconnector'];
        return view("gsu::admin.caselle.caselle-detail", ['request' => $res, 'btn' => $btn, 'activesync' => $activesync, 'outlookconnector' => $outlookconnector]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $activesync = $return['activesync'];
        $outlookconnector = $return['outlookconnector'];
        return view("gsu::admin.caselle.caselle-detail", ['request' => $res, 'btn' => $btn, 'activesync' => $activesync, 'outlookconnector' => $outlookconnector]);
    }

    private function manageShow(){
        $model = new CaselleModel();
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

        $activesync = "NO";
        $outlookconnector = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['ACCOUNT'])) {
                $activesync = $model->getActivesync($res['ACCOUNT']);
                $outlookconnector = $model->getOutlookconnector($res['ACCOUNT']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['activesync'] = $activesync;
        $return['outlookconnector'] = $outlookconnector;


        return $return;
    }

    public function delete(){
        $res = new CaselleModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new CaselleModel();
        $return = $res->saveData();
        return $return;
    }

}
