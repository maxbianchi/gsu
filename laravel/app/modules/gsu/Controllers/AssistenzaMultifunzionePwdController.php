<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\AssistenzaMultifunzionePwdModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class AssistenzaMultifunzionePwdController extends MainController {

    private $tableName = "ASSISTENZAM MULTIFUNZIONE PWD";

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
        $res = new AssistenzaMultifunzionePwdModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.assistenza-tecnica-multifunzione-pwd.assistenza-tecnica-multifunzione-pwd", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new AssistenzaMultifunzionePwdModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.assistenza-tecnica-multifunzione-pwd.assistenza-tecnica-multifunzione-pwd", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $urlfiltering = $return['urlfiltering'];
        $smartnet = $return['smartnet'];
        $vpn = $return['vpn'];
        $ipmultimedia = $return['ipmultimedia'];
        $gestioneapparati = $return['gestioneapparati'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.assistenza-tecnica-multifunzione-pwd.assistenza-tecnica-multifunzione-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users,'urlfiltering' => $urlfiltering, 'smartnet' => $smartnet, 'vpn' => $vpn, 'ipmultimedia' => $ipmultimedia, 'gestioneapparato' => $gestioneapparati, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $urlfiltering = $return['urlfiltering'];
        $smartnet = $return['smartnet'];
        $vpn = $return['vpn'];
        $ipmultimedia = $return['ipmultimedia'];
        $gestioneapparati = $return['gestioneapparati'];
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.assistenza-tecnica-multifunzione-pwd.assistenza-tecnica-multifunzione-pwd-detail", ['request' => $res, 'btn' => $btn, 'users' => $users, 'urlfiltering' => $urlfiltering, 'smartnet' => $smartnet, 'vpn' => $vpn, 'ipmultimedia' => $ipmultimedia, 'gestioneapparato' => $gestioneapparati, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $model = new AssistenzaMultifunzionePwdModel();
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

        $urlfiltering = "NO";
        $smartnet = "NO";
        $vpn = "NO";
        $ipmultimedia = "NO";
        $gestioneapparati = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['SN'])) {
                $urlfiltering = $model->getUrlFiltering($res['SN']);
                $smartnet = $model->getSmartNet($res['SN']);
                $vpn = $model->getVpn($res['SN']);
                $ipmultimedia = $model->getIpMultimedia($res['SN']);
                $gestioneapparati = $model->getGestioneApparati($res['SN']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['urlfiltering'] = $urlfiltering;
        $return['smartnet'] = $smartnet;
        $return['vpn'] = $vpn;
        $return['ipmultimedia'] = $ipmultimedia;
        $return['gestioneapparati'] = $gestioneapparati;

        return $return;
    }

    public function delete(){
        $res = new AssistenzaMultifunzionePwdModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new AssistenzaMultifunzionePwdModel();
        $return = $res->saveData();
        return $return;
    }

}
