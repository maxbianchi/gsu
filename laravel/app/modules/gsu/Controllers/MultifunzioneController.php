<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\MultifunzioneModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Utenti;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class MultifunzioneController extends MainController {

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
        $res = new MultifunzioneModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.multifunzione.multifunzione", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $model = new MultifunzioneModel();
        $res = $model->getFilteredRequest();
        $addnew = $model->checkAddNew();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::$this->view_folder.multifunzione.multifunzione", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $manutenzioneapparato = $return['manutenzioneapparato'];
        $consumabile_nero = $return['consumabile_nero'];
        $consumabile_colori = $return['consumabile_colori'];

        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.multifunzione.multifunzione-detail", ['request' => $res, 'btn' => $btn, 'users' => $users,'manutenzioneapparato' => $manutenzioneapparato, 'consumabile_nero' => $consumabile_nero, 'consumabile_colori' => $consumabile_colori]);
    }

    public function edit(){
        $return = $this->manageShow();
        $res = $return['res'];
        $btn = $return['btn'];
        $manutenzioneapparato = $return['manutenzioneapparato'];
        $consumabile_nero = $return['consumabile_nero'];
        $consumabile_colori = $return['consumabile_colori'];

        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("gsu::$this->view_folder.multifunzione.multifunzione-detail", ['request' => $res, 'btn' => $btn, 'users' => $users, 'manutenzioneapparato' => $manutenzioneapparato, 'consumabile_nero' => $consumabile_nero, 'consumabile_colori' => $consumabile_colori]);
    }

    private function manageShow(){
        $model = new MultifunzioneModel();
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

        $manutenzioneapparato = "NO";
        $consumabile_nero = "NO";
        $consumabile_colori = "NO";
        if(count($res) == 0) {
            $res = ['MANUTENZIONE' => Input::get('manutenzione')];
        }
        else {
            if(isset($res['SN'])) {
                $manutenzioneapparato = $model->getManutenzione($res['SN']);
                $consumabile_nero = $model->getConsumabileNero($res['SN']);
                $consumabile_colori = $model->getConsumabileColori($res['SN']);
            }
        }

        $return['res'] = $res;
        $return['btn'] = $btn;
        $return['manutenzioneapparato'] = $manutenzioneapparato;
        $return['consumabile_nero'] = $consumabile_nero;
        $return['consumabile_colori'] = $consumabile_colori;

        return $return;
    }

    public function delete(){
        $res = new MultifunzioneModel();
        $res = $res->deleteByID();
    }

    public function save(){
        $res = new MultifunzioneModel();
        $return = $res->saveData();
        return $return;
    }

}
