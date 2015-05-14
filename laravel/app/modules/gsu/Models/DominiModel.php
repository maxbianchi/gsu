<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class DominiModel extends Model {

    public function getAllRequest(){

        $tipo_dominio = Input::get('tipo_dominio');

        $sql = <<<EOF
        SELECT
			richieste.OGGETTO			AS CANONE,
			richieste.DATADOCUMENTO	AS DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica.DESCRIZIONE		AS SOGGETTO,
			anagrafica.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica2.DESCRIZIONE	AS CLIENTE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			DOMINI.IDDOMINIO,
			CONVERT(VARCHAR(10),DOMINI.DATAR,105) DATAR,
			DOMINI.NOMEDOMINIO,
			CONVERT(VARCHAR(10),DOMINI.SCADENZA,105) SCADENZA,
			CONVERT(VARCHAR(10),DOMINI.SCADENZAEFFETTIVA,105) SCADENZAEFFETTIVA,
			DOMINI.TIPODOMINIO,
			DOMINI.NOVIRUSNOSPAM,
			DOMINI.CODICE_R
			FROM		gsu.dbo.DOMINI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON DOMINI.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica	ON richieste.SOGGETTO				= anagrafica.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
            WHERE 1 = 1
EOF;

        if(!empty($tipo_dominio))
            $sql .= " AND DOMINI.TIPODOMINIO like '%$tipo_dominio%'";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $id = Input::get('id');
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione = Input::get('ubicazione');
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');

        $data_registrazione = Input::get('data_registrazione');
        $nome_dominio = Input::get('nome_dominio');
        $scadenza = Input::get('scadenza');
        $scadenza_effettiva = Input::get('scadenza_effettiva');
        $tipo_dominio = Input::get('tipo_dominio');
        $novirusnospam = Input::get('novirusnospam');


        $sql = <<<EOF
           SELECT
			richieste.OGGETTO			AS CANONE,
			richieste.DATADOCUMENTO	AS DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica.DESCRIZIONE		AS SOGGETTO,
			anagrafica.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica2.DESCRIZIONE	AS CLIENTE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			DOMINI.IDDOMINIO,
			CONVERT(VARCHAR(10),DOMINI.DATAR,105) DATAR,
			DOMINI.NOMEDOMINIO,
			CONVERT(VARCHAR(10),DOMINI.SCADENZA,105) SCADENZA,
			CONVERT(VARCHAR(10),DOMINI.SCADENZAEFFETTIVA,105) SCADENZAEFFETTIVA,
			DOMINI.TIPODOMINIO,
			DOMINI.NOVIRUSNOSPAM,
			DOMINI.CODICE_R
			FROM		gsu.dbo.DOMINI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON DOMINI.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica	ON richieste.SOGGETTO				= anagrafica.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
			WHERE 1 = 1
EOF;

        if(!empty($id))
            $sql .= " AND DOMINI.IDDOMINIO = '$id'";
        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND ANAGRAFICA2.DESCRIZIONE like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND ANAGRAFICA3.DESCRIZIONE like '%$ubicazione%'";

        if(!empty($canone))
            $sql .= " AND RICHIESTE.OGGETTO like '%$canone%'";
        if(!empty($manutenzione))
            $sql .= " AND RICHIESTE.MANUTENZIONE like '%$manutenzione%'";

        if(!empty($data_contratto)) {
            $data_contratto = explode("-", $data_contratto);
            $data_contratto = $data_contratto[2]."-".$data_contratto[1]."-".$data_contratto[0];
            $sql .= " AND RICHIESTE.DATADOCUMENTO like '%$data_contratto%'";
        }

        if(!empty($data_registrazione))
            $sql .= " AND DOMINI.DATAR = convert(datetime, '$data_registrazione', 105)";
        if(!empty($nome_dominio))
            $sql .= " AND DOMINI.NOMEDOMINIO like '%$nome_dominio%'";
        if(!empty($scadenza))
            $sql .= " AND DOMINI.SCADENZA = convert(datetime, '$scadenza', 105)";
        if(!empty($scadenza_effettiva))
            $sql .= " AND DOMINI.SCADENZAEFFETTIVA = convert(datetime, '$scadenza_effettiva', 105)";
        if(!empty($tipo_dominio))
            $sql .= " AND DOMINI.TIPODOMINIO like '%$tipo_dominio%'";
        if(!empty($novirusnospam))
            $sql .= " AND DOMINI.NOVIRUSNOSPAM like '%$novirusnospam%'";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;
    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "DELETE FROM gsu.dbo.DOMINI WHERE IDDOMINIO='$id'";
            DB::delete($sql);

            $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
            $richieste_evase = DB::select($sql);
            if(count($richieste_evase) > 0){
                $richieste_evase = $richieste_evase[0];
                $qta = $richieste_evase['QUANTITA'] - 1;
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
            }


            }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $data_registrazione = Input::get('data_registrazione');
        $nome_dominio = Input::get('nome_dominio');
        $scadenza = Input::get('scadenza');
        $scadenza_effettiva = Input::get('scadenza_effettiva');
        $tipo_dominio = Input::get('tipo_dominio');
        $novirusnospam = Input::get('novirusnospam');
        $manutenzione = Input::get('manutenzione');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.DOMINI (Codice_R, DATAR, NOMEDOMINIO, SCADENZA, SCADENZAEFFETTIVA, TIPODOMINIO,NOVIRUSNOSPAM) VALUES ('$manutenzione',convert(datetime, '$data_registrazione', 105),'$nome_dominio',convert(datetime, '$scadenza', 105),convert(datetime, '$scadenza_effettiva', 105),'$tipo_dominio','$novirusnospam')");
                $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
                $richieste_evase = DB::select($sql);
                if(count($richieste_evase) > 0) {
                    $richieste_evase = $richieste_evase[0];
                    $qta = $richieste_evase['QUANTITA'] + 1;
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
                }
                else{
                    DB::insert("INSERT INTO gsu.dbo.RICHIESTE_EVASE (CODICE_R, QUANTITA) VALUES ('$manutenzione','1')");
                }
            }
            else
                DB::update("UPDATE gsu.dbo.DOMINI SET Codice_R='$manutenzione', DATAR=convert(datetime, '$data_registrazione', 105), NOMEDOMINIO='$nome_dominio', SCADENZA=convert(datetime, '$scadenza', 105), SCADENZAEFFETTIVA=convert(datetime, '$scadenza_effettiva', 105), TIPODOMINIO='$tipo_dominio',NOVIRUSNOSPAM='$novirusnospam' WHERE IDDOMINIO=$id");

        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new DialUpModel();
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
