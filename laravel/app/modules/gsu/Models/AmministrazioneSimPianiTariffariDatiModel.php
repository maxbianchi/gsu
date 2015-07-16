<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class AmministrazioneSimPianiTariffariDatiModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');

        $sql = <<<EOF
            SELECT
            ID_PIANO,
            NOME_PIANO,
            DES_PIANO,
            NOTE_PIANO
            FROM SIM_PIANI_TARIFFARI_DATI
            WHERE ELIMINATO = 0
EOF;

        $sql .= " ORDER BY NOME_PIANO";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            ID_PIANO,
            NOME_PIANO,
            DES_PIANO,
            NOTE_PIANO
            FROM SIM_PIANI_TARIFFARI_DATI
            WHERE 1=1
EOF;

        if(!empty($eliminati))
            $sql .= " AND SIM_PIANI_TARIFFARI_DATI.ELIMINATO = 1";
        else
            $sql .= " AND SIM_PIANI_TARIFFARI_DATI.ELIMINATO = 0";
        $sql .= " ORDER BY NOME_PIANO";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SIM_PIANI_TARIFFARI_DATI SET ELIMINATO=1 WHERE ID_PIANO='$id'";
            DB::update($sql);
        }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $nome_piano = Input::get('nome_piano');
        $des_piano = Input::get('des_piano');
        $note_piano = Input::get('note_piano');




        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.SIM_PIANI_TARIFFARI_DATI (NOME_PIANO,DES_PIANO,NOTE_PIANO,ELIMINATO) VALUES ('$nome_piano','$des_piano','$note_piano',$eliminato)");
            }
            else
                DB::update("UPDATE gsu.dbo.SIM_PIANI_TARIFFARI_DATI SET NOME_PIANO='$nome_piano',DES_PIANO='$des_piano',NOTE_PIANO='$note_piano',ELIMINATO=$eliminato  WHERE ID_PIANO=$id");
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new AmministrazioneSimPianiTariffariDatiModel();
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

