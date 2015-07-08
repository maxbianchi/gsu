<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class AmministrazioneSoftwareModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');

        $sql = <<<EOF
            SELECT
            ID_OS,
            NOME
            FROM SISTEMI_OPERATIVI
            WHERE ELIMINATO = 0
EOF;

        $sql .= " ORDER BY NOME";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            ID_OS,
            NOME
            FROM SISTEMI_OPERATIVI
            WHERE 1=1
EOF;

        if(!empty($eliminati))
            $sql .= " AND SISTEMI_OPERATIVI.ELIMINATO = 1";
        else
            $sql .= " AND SISTEMI_OPERATIVI.ELIMINATO = 0";
        $sql .= " ORDER BY NOME";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SISTEMI_OPERATIVI SET ELIMINATO=1 WHERE ID_OS='$id'";
            DB::update($sql);
        }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $nome = Input::get('nome');




        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.SISTEMI_OPERATIVI (NOME,ELIMINATO) VALUES ('$nome',$eliminato)");
            }
            else
                DB::update("UPDATE gsu.dbo.SISTEMI_OPERATIVI SET NOME='$nome',ELIMINATO=$eliminato  WHERE ID_OS=$id");
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new IpstaticiModel();
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

