<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class AmministrazioneUnigateModel extends Model {

    public function getAllRequest(){

        $sql = <<<EOF
            SELECT
            IDAPPARATO,
            APPARATO
            FROM APPARATI_UNIGATE
            WHERE ELIMINATO = 0
EOF;

        $sql .= " ORDER BY APPARATO";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $eliminati = Input::get('eliminati');
        $id = Input::get('id');
        $sql = <<<EOF
            SELECT
            IDAPPARATO,
            APPARATO
            FROM APPARATI_UNIGATE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .=" AND IDAPPARATO=$id";

        if(!empty($eliminati))
            $sql .= " AND APPARATI_UNIGATE.ELIMINATO = 1";
        else
            $sql .= " AND APPARATI_UNIGATE.ELIMINATO = 0";
        $sql .= " ORDER BY APPARATO";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.APPARATI_UNIGATE SET ELIMINATO=1 WHERE IDAPPARATO='$id'";
            DB::update($sql);
        }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $apparato = Input::get('apparato');




        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.APPARATI_UNIGATE (APPARATO,ELIMINATO) VALUES ('$apparato',$eliminato)");
            }
            else
                DB::update("UPDATE gsu.dbo.APPARATI_UNIGATE SET APPARATO='$apparato',ELIMINATO=$eliminato  WHERE IDAPPARATO=$id");
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new AmministrazioneUnigateModel();
        $res = $model->getFilteredRequest();
        $codici_manutenzione = [];
        $cod_manutenzione = "";
        foreach ($res as $key => $value){
            if($cod_manutenzione != $value['MANUTENZIONE']) {
                $cod_manutenzione = $value['MANUTENZIONE'];
                $codici_manutenzione[] = $value['MANUTENZIONE'];
            }
        }
        Input::merge(array('add' => '0'));
        if(count($res) > 0 && count($codici_manutenzione) == 1) {
            if ($res[0]['QTAAOF70'] > $res[0]['QTAGSU'])
                Input::merge(array('add' => '1'));
        }
    }

}

