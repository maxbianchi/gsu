<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class HardwareModel extends Model {

    public function getAllRequest(){
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));

        $sql = <<<EOF
        SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
            CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
            SERVER.IDSERVER,
            SERVER.CODICE_R,
            SERVER.ACQUISTO_NOLEGGIO,
            SERVER.MODELLO,
            SERVER.PN,
            SERVER.SN,
            SERVER.PIN,
            CONVERT(VARCHAR(10),SERVER.DATAACQUISTO,105) DATAACQUISTO,
            CONVERT(VARCHAR(10),SERVER.SCADGARANZIAINIZ,105) SCADGARANZIAINIZ,
            CONVERT(VARCHAR(10),SERVER.RINNOVOGARANZIA,105) RINNOVOGARANZIA,
            SERVER.ACERADVANTAGE,
            SERVER.PSWACER,
            SERVER.NUMEROENERGYCARD,
            SERVER.SOSCLIENTE,
            SERVER.SOSCONTRATTO,
            SERVER.PREZZORINNOVO,
            CONVERT(VARCHAR(10),SERVER.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            CONVERT(VARCHAR(10),SERVER.SCADRINNOVOGARANZIA,105) SCADRINNOVOGARANZIA,
            SERVER.ASSISTENZA,
            SERVER.WARRANTY,
            SERVER.MARCA,
            CONVERT(VARCHAR(10),SERVER.DATA_R,105) DATA_R,
            SERVER.OGGETTO,
            SERVER.ELIMINATO
            FROM gsu.dbo.SERVER
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVER.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(SERVER.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(SERVER.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(SERVER.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE SERVER.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') like '%$ubicazione%'";

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

        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $pn = Input::get('pn');
        $sn = Input::get('sn');

        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
            CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.SOGGETTO AS SOGGETTO_CODICE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
            REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.CAP		        AS SOGGETTO_CAP,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			ISNULL(anagrafica1.PARTITAIVA,anagrafica1.CODICEFISCALE) AS SOGGETTO_PIVA,
            anagrafica2.SOGGETTO        AS CLIENTE_CODICE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
            anagrafica2.CAP		        AS CLIENTE_CAP,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			ISNULL(anagrafica2.PARTITAIVA,anagrafica2.CODICEFISCALE) AS CLIENTE_PIVA,
            anagrafica3.SOGGETTO        AS DESTINATARIOABITUALE_CODICE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.CAP		        AS DESTINATARIOABITUALE_CAP,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			ISNULL(anagrafica3.PARTITAIVA,anagrafica3.CODICEFISCALE) AS DESTINATARIOABITUALE_PIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
            SERVER.IDSERVER,
            SERVER.CODICE_R,
            SERVER.ACQUISTO_NOLEGGIO,
            SERVER.MODELLO,
            SERVER.PN,
            SERVER.SN,
            SERVER.PIN,
            CONVERT(VARCHAR(10),SERVER.DATAACQUISTO,105) DATAACQUISTO,
            CONVERT(VARCHAR(10),SERVER.SCADGARANZIAINIZ,105) SCADGARANZIAINIZ,
            SERVER.RINNOVOGARANZIA,
            SERVER.ACERADVANTAGE,
            SERVER.PSWACER,
            SERVER.NUMEROENERGYCARD,
            SERVER.SOSCLIENTE,
            SERVER.SOSCONTRATTO,
            SERVER.PREZZORINNOVO,
            CONVERT(VARCHAR(10),SERVER.SCADRINNOVOGARANZIA,105) SCADRINNOVOGARANZIA,
            CONVERT(VARCHAR(10),SERVER.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            SERVER.ASSISTENZA,
            SERVER.WARRANTY,
            SERVER.MARCA,
            CONVERT(VARCHAR(10),SERVER.DATA_R,105) DATA_R,
            SERVER.OGGETTO,
            SERVER.ELIMINATO
            FROM gsu.dbo.SERVER
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVER.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(SERVER.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(SERVER.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(SERVER.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND SERVER.IDSERVER = '$id'";
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
            $sql .= " AND RICHIESTE.DATADOCUMENTO like '%$data_contratto%'";
        }

        if(!empty($pn))
            $sql .= " AND SERVER.PN like '%$pn%'";
        if(!empty($marca))
            $sql .= " AND SERVER.MARCA like '%$marca%'";
        if(!empty($modello))
            $sql .= " AND SERVER.MODELLO like '%$modello%'";
        if(!empty($sn))
            $sql .= " AND SERVER.SN like '%$sn%'";


        if(!empty($eliminati))
            $sql .= " AND SERVER.ELIMINATO = 1";
        else
            $sql .= " AND SERVER.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SERVER SET ELIMINATO=1 WHERE IDSERVER='$id'";
            DB::update($sql);

            $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
            $richieste_evase = DB::select($sql);
            if(count($richieste_evase) > 0 && !empty($manutenzione)){
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
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $manutenzione = Input::get('manutenzione');

        $soggetto = Input::get('cliente');
        $cliente = Input::get('cliente_finale');
        $destinatarioabituale = Input::get('ubicazione_impianto');
        $data_r = empty(Input::get('data_r')) ? "00-00-0000" : Input::get('data_r');
        $acquisto_noleggio = Input::get('acquisto_noleggio');
        $dataacquisto =  empty(Input::get('dataacquisto')) ? "00-00-0000" : Input::get('dataacquisto');
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $pn = Input::get('pn');
        $sn = Input::get('sn');
        $pin = Input::get('pin');
        $scadegaranziainiz =  empty(Input::get('scadegaranziainiz')) ? "00-00-0000" : Input::get('scadegaranziainiz');
        $rinnovogaranzia = Input::get('rinnovogaranzia');
        $scadrinnovogaranzia = empty(Input::get('scadrinnovogaranzia')) ? "00-00-0000" : Input::get('scadrinnovogaranzia');
        $aceradvantage = Input::get('aceradvantage');
        $pswacer = Input::get('pswacer');
        $numeroenergycard = Input::get('numeroenergycard');
        $soscliente = Input::get('soscliente');
        $soscontratto = Input::get('soscontratto');
        $data_inserimento = $date = date('Y-m-d H:i:s');

        try {
            if(empty($id)) {
                DB::insert("insert into SERVER (SERVER.SOGGETTO	,SERVER.CLIENTE	,SERVER.DESTINATARIOABITUALE,SERVER.ACQUISTO_NOLEGGIO,SERVER.MODELLO,SERVER.PN,SERVER.SN,SERVER.PIN,SERVER.DATAACQUISTO,SERVER.SCADGARANZIAINIZ,SERVER.RINNOVOGARANZIA,SERVER.ACERADVANTAGE,SERVER.PSWACER,SERVER.NUMEROENERGYCARD,SERVER.SOSCLIENTE,SERVER.SOSCONTRATTO,SERVER.SCADRINNOVOGARANZIA,SERVER.MARCA,SERVER.DATA_R,DATA_INSERIMENTO,ELIMINATO) values ('$soggetto','$cliente','$destinatarioabituale','$acquisto_noleggio','$modello','$pn','$sn','$pin','$dataacquisto','$scadegaranziainiz','$rinnovogaranzia','$aceradvantage','$pswacer','$numeroenergycard','$soscliente','$soscontratto','$scadrinnovogaranzia','$marca','$data_r','$data_inserimento',$eliminato)");


                $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
                $richieste_evase = DB::select($sql);
                if(count($richieste_evase) > 0 && !empty($manutenzione)) {
                    $richieste_evase = $richieste_evase[0];
                    $qta = $richieste_evase['QUANTITA'] + 1;
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
                }
                else{
                    DB::insert("INSERT INTO gsu.dbo.RICHIESTE_EVASE (CODICE_R, QUANTITA) VALUES ('$manutenzione','1')");
                }
            }
            else
                DB::update("Update SERVER  Set SERVER.SOGGETTO	 = '$soggetto', SERVER.CLIENTE = '$cliente', SERVER.DESTINATARIOABITUALE = '$destinatarioabituale', SERVER.ACQUISTO_NOLEGGIO = '$acquisto_noleggio', SERVER.MODELLO = '$modello', SERVER.PN = '$pn', SERVER.SN = '$sn', SERVER.PIN = '$pin', SERVER.DATAACQUISTO = '$dataacquisto', SERVER.SCADGARANZIAINIZ = '$scadegaranziainiz', SERVER.RINNOVOGARANZIA = '$rinnovogaranzia', SERVER.ACERADVANTAGE = '$aceradvantage', SERVER.PSWACER = '$pswacer', SERVER.NUMEROENERGYCARD = '$numeroenergycard', SERVER.SOSCLIENTE = '$soscliente', SERVER.SOSCONTRATTO = '$soscontratto', SERVER.SCADRINNOVOGARANZIA = '$scadrinnovogaranzia', SERVER.MARCA = '$marca', SERVER.DATA_R = '$data_r',ELIMINATO = $eliminato WHERE IDSERVER=$id");
            if($stato_precedente == 1 && $eliminato == 0 && !empty($manutenzione)){
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new HardwareModel();
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

    public function getAssistenzaTecnica($SN){
        $sql = "SELECT * FROM TELEASSISTENZA WHERE (SERIALE= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getPostWarranty($SN){
        $sql = "SELECT * FROM POSTWARRANTY WHERE (SERIALE= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }



}


