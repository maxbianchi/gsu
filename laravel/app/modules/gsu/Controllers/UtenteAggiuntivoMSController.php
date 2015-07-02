<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\UtenteAggiuntivoMSModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Models\UtenteAggiuntivoModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class UtenteAggiuntivoMSController extends MainController {

    private $tableName = "UTENTE AGGIUNTIVO MS";

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
        $res = new UtenteAggiuntivoMSModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.utente-aggiuntivo-ms.utente-aggiuntivo-ms", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function search(){
        $model = new UtenteAggiuntivoMSModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.utente-aggiuntivo-ms.utente-aggiuntivo-ms", ['request' => $res, 'class' => $class, 'tableName' => $this->tableName]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.utente-aggiuntivo-ms.utente-aggiuntivo-ms-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        return view("gsu::$this->view_folder.utente-aggiuntivo-ms.utente-aggiuntivo-ms-detail", ['request' => $res, 'btn' => $btn, 'tableName' => $this->tableName]);
    }

    private function manageShow(){
        $res = new UtenteAggiuntivoMSModel();
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
        $res = new UtenteAggiuntivoMSModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new UtenteAggiuntivoMSModel();
        $return = $res->saveData();
        return $return;
    }

}
