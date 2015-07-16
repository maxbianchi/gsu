<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\IpstaticiModel;
use App\Modules\Gsu\Models\AmministrazioneSimPianiTariffariDatiModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class AmministrazioneSimPianiTariffariDatiController extends MainController {

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
        $res = new AmministrazioneSimPianiTariffariDatiModel();
        $res = $res->getAllRequest();
        return view("gsu::$this->view_folder.amministrazione.sim-piani-tariffari-dati.sim-piani-tariffari-dati", ['request' => $res]);
    }

    public function search(){
        $model = new AmministrazioneSimPianiTariffariDatiModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        return view("gsu::$this->view_folder.amministrazione.sim-piani-tariffari-dati.sim-piani-tariffari-dati", ['request' => $res]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.amministrazione.sim-piani-tariffari-dati.sim-piani-tariffari-dati-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.amministrazione.sim-piani-tariffari-dati.sim-piani-tariffari-dati-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $res = new AmministrazioneSimPianiTariffariDatiModel();
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
        $res = new AmministrazioneSimPianiTariffariDatiModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new AmministrazioneSimPianiTariffariDatiModel();
        $return = $res->saveData();
        return $return;
    }

}
