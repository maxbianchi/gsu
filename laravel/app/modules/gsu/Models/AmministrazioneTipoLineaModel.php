<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class AmministrazioneTipoLineaModel extends Model {

    public function getAllRequest(){

        $sql = <<<EOF
            SELECT
            IDLINEA,
            LINEA_UNIWEB,
            LINEA_FORNITORE
            FROM ADSL_TIPO_LINEA
EOF;

        $sql .= " ORDER BY LINEA_UNIWEB";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $id = Input::get('id');
        $sql = <<<EOF
            SELECT
            IDLINEA,
            LINEA_UNIWEB,
            LINEA_FORNITORE
            FROM ADSL_TIPO_LINEA
            WHERE 1 = 1
EOF;
        if(!empty($id))
            $sql .=" AND IDLINEA=$id";


        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.ADSL_TIPO_LINEA SET ELIMINATO=1 WHERE IDLINEA='$id'";
            DB::update($sql);
        }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $linea_uniweb = Input::get('linea_uniweb');
        $linea_fornitore = Input::get('linea_fornitore');




        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.ADSL_TIPO_LINEA (LINEA_UNIWEB,LINEA_FORNITORE) VALUES ('$linea_uniweb','$linea_fornitore')");
            }
            else
                DB::update("UPDATE gsu.dbo.ADSL_TIPO_LINEA SET LINEA_UNIWEB='$linea_uniweb',LINEA_FORNITORE='$linea_fornitore'  WHERE IDLINEA=$id");
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

