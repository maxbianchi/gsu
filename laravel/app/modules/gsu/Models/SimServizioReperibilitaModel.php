<?php namespace App\Modules\Gsu\Models;

use App\Modules\Gsu\Utility;
use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class SimServizioReperibilitaModel extends Model {

    public function getAllRequest(){
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $canone = Input::get('canone');

        $sql = <<<EOF
			SELECT
			RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.SOGGETTO AS SOGGETTO_CODICE,
			anagrafica2.SOGGETTO AS CLIENTE_CODICE,
			anagrafica3.SOGGETTO AS DESTINATARIOABITUALE_CODICE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
		    SIM_SERVIZIO_REPERIBILITA.ID,
			SIM_SERVIZIO_REPERIBILITA.CODICE_R,
			SIM_SERVIZIO_REPERIBILITA.TELEFONO,
			SIM_SERVIZIO_REPERIBILITA.SERVIZIO,
			SIM_SERVIZIO_REPERIBILITA.ELIMINATO
			FROM gsu.dbo.SIM_SERVIZIO_REPERIBILITA
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON SIM_SERVIZIO_REPERIBILITA.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE SIM_SERVIZIO_REPERIBILITA.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') like '%$ubicazione%'";
        if(!empty($canone))
            $sql .= " AND richieste.OGGETTO like '%$canone%'";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $id = Input::get('id');
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');

        $telefono = Input::get('ntelefono');
        $servizio = Input::get('servizio');
        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.SOGGETTO AS SOGGETTO_CODICE,
			anagrafica2.SOGGETTO AS CLIENTE_CODICE,
			anagrafica3.SOGGETTO AS DESTINATARIOABITUALE_CODICE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			SIM_SERVIZIO_REPERIBILITA.ID,
			SIM_SERVIZIO_REPERIBILITA.CODICE_R,
			SIM_SERVIZIO_REPERIBILITA.TELEFONO,
			SIM_SERVIZIO_REPERIBILITA.SERVIZIO,
			SIM_SERVIZIO_REPERIBILITA.ELIMINATO
			FROM gsu.dbo.SIM_SERVIZIO_REPERIBILITA
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON SIM_SERVIZIO_REPERIBILITA.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
			WHERE 1 = 1
EOF;

        if(!empty($id))
            $sql .= " AND SIM_SERVIZIO_REPERIBILITA.ID = '$id'";
        if(!empty($cliente))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') like '%$ubicazione%'";

        if(!empty($canone))
            $sql .= " AND RICHIESTE.OGGETTO like '%$canone%'";
        if(!empty($manutenzione))
            $sql .= " AND RICHIESTE.MANUTENZIONE like '%$manutenzione%'";

        if(!empty($data_contratto)) {
            $data_contratto = explode("-", $data_contratto);
            $data_contratto = $data_contratto[2]."-".$data_contratto[1]."-".$data_contratto[0];
            $sql .= " AND RICHIESTE.DATADOCUMENTO = CONVERT(date,'$data_contratto', 102)";
        }

        if(!empty($telefono))
            $sql .= " AND SIM_SERVIZIO_REPERIBILITA.TELEFONO like '%$telefono%'";
        if(!empty($servizio))
            $sql .= " AND SIM_SERVIZIO_REPERIBILITA.SERVIZIO like '%$servizio%'";

        if(!empty($eliminati))
            $sql .= " AND SIM_SERVIZIO_REPERIBILITA.ELIMINATO = 1";
        else
            $sql .= " AND SIM_SERVIZIO_REPERIBILITA.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SIM_SERVIZIO_REPERIBILITA SET ELIMINATO=1 WHERE ID='$id'";
            DB::update($sql);

            $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
            $richieste_evase = DB::select($sql);
            if(count($richieste_evase) > 0){
                $richieste_evase = $richieste_evase[0];
                $qta = $richieste_evase['QUANTITA'] - 1;
                /*if($qta == 0)
                    DB::delete("DELETE FROM gsu.dbo.RICHIESTE_EVASE where CODICE_R = '$manutenzione'");
                else*/
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
            }


        }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $manutenzione = Input::get('manutenzione');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');

        $ntelefono = Input::get('ntelefono');
        $servizio = Input::get('servizio');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.SIM_SERVIZIO_REPERIBILITA (CODICE_R,TELEFONO,SERVIZIO, ELIMINATO) VALUES ('$manutenzione','$ntelefono','$servizio',$eliminato)");


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
                $sql = "UPDATE gsu.dbo.SIM_SERVIZIO_REPERIBILITA SET Codice_R='$manutenzione',TELEFONO='$ntelefono',SERVIZIO='$servizio',ELIMINATO=$eliminato WHERE ID=$id";
            DB::update($sql);
            if($stato_precedente == 1 && $eliminato == 0){
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getOpzioniDati(){
        $sql = "SELECT * FROM SIM_PIANI_TARIFFARI_DATI ORDER BY NOME_PIANO";
        $opz  = DB::select($sql);
        return $opz;
    }

    public function checkAddNew(){
        $model = new SimServizioReperibilitaModel();
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

