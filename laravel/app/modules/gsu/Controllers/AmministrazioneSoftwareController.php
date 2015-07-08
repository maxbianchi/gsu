<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\IpstaticiModel;
use App\Modules\Gsu\Models\AmministrazioneTelefoniModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class AmministrazioneTelefoniController extends MainController {

    private $tableName = "IP STATICI";

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
        $res = new AmministrazioneTelefoniModel();
        $res = $res->getAllRequest();
        return view("gsu::$this->view_folder.amministrazione.telefoni.telefoni", ['request' => $res]);
    }

    public function search(){
        $model = new AmministrazioneTelefoniModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        return view("gsu::$this->view_folder.amministrazione.telefoni.telefoni", ['request' => $res]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.amministrazione.telefoni.telefoni-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.amministrazione.telefoni.telefoni-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $res = new AmministrazioneTelefoniModel();
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
        $res = new AmministrazioneTelefoniModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new AmministrazioneTelefoniModel();
        $return = $res->saveData();
        return $return;
    }

}
