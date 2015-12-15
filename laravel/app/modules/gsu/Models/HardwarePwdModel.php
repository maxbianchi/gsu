<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class HardwarePwdModel extends Model {

    public function getAllRequest(){
        $apparato_id = Input::get('apparato_id');
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));

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
            SERVER.SN SERIALE,
            SERVERPWD.IDSERVERPWD,
            SERVERPWD.SERVER_ID,
            SERVERPWD.SN,
            SERVERPWD.NOME,
            SERVERPWD.ACCESSO,
            SERVERPWD.USERNAME,
            SERVERPWD.PWD,
            SERVERPWD.PWDPRIVILEGIATA,
            SERVERPWD.ELIMINATO
            FROM gsu.dbo.SERVER
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVER.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(SERVER.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(SERVER.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(SERVER.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            FULL OUTER JOIN dbo.SERVERPWD ON dbo.SERVER.IDSERVER = dbo.SERVERPWD.SERVER_ID
            WHERE SERVERPWD.ELIMINATO = 0
EOF;

        $sql .= " AND SERVERPWD.SERVER_ID = '$apparato_id'";

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

        $apparato_id = Input::get('apparato_id');
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');
        $id = Input::get('id');
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
            SERVER.SN SERIALE,
            SERVER.PIN,
            CONVERT(VARCHAR(10),SERVER.DATAACQUISTO,105) DATAACQUISTO,
            CONVERT(VARCHAR(10),SERVER.SCADGARANZIAINIZ,105) SCADGARANZIAINIZ,
            SERVERPWD.IDSERVERPWD,
            SERVERPWD.SERVER_ID,
            SERVERPWD.SN,
            SERVERPWD.NOME,
            SERVERPWD.ACCESSO,
            SERVERPWD.USERNAME,
            SERVERPWD.PWD,
            SERVERPWD.PWDPRIVILEGIATA,
            SERVERPWD.ELIMINATO
            FROM gsu.dbo.SERVER
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVER.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(SERVER.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(SERVER.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(SERVER.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            FULL OUTER JOIN dbo.SERVERPWD ON dbo.SERVER.IDSERVER = dbo.SERVERPWD.SERVER_ID
            WHERE 1=1
EOF;

        $sql .= " AND SERVERPWD.SERVER_ID = '$apparato_id'";

        if(!empty($id))
            $sql .= " AND SERVERPWD.IDSERVERPWD = '$id'";
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

        if(!empty($eliminati))
            $sql .= " AND SERVERPWD.ELIMINATO = 1";
        else
            $sql .= " AND SERVERPWD.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SERVERPWD SET ELIMINATO=1 WHERE IDSERVERPWD='$id'";
            DB::update($sql);
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
        $accesso = Input::get('accesso');
        $username = Input::get('username');
        $pwd = Input::get('pwd');
        $pwdprivilegiata = Input::get('pwdprivilegiata');
        $apparato_id = Input::get('apparato_id');
        $sn = Input::get('sn');


        try {
            if(empty($id)) {
                $sql = "insert into SERVERPWD (SN,SERVER_ID,ACCESSO,USERNAME,PWD,PWDPRIVILEGIATA,ELIMINATO) values ('$sn','$apparato_id','$accesso','$username','$pwd','$pwdprivilegiata',$eliminato)";
                DB::insert($sql);
            }
            else
                DB::update("Update SERVERPWD  Set SN='$sn', ACCESSO='$accesso',USERNAME='$username',PWD='$pwd',PWDPRIVILEGIATA='$pwdprivilegiata',ELIMINATO = $eliminato WHERE IDSERVERPWD=$id");
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


