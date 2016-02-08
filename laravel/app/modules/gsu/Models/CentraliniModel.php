<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class CentraliniModel extends Model {

    public function getAllRequest(){
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $prodotto = Input::get('prodotto');

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
            CENTRALINI.IDCENTRALINO,
            CENTRALINI.CODICE_R,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_R,105) DATA_R,
            CENTRALINI.ACQUISTO_NOLEGGIO,
            CENTRALINI.DESCRIZIONE,
            CENTRALINI.VERSIONE,
            CENTRALINI.PRODUTTORE,
            CENTRALINI.SERIALE,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            CENTRALINI.OGGETTO,
            CENTRALINI.ELIMINATO
			FROM		gsu.dbo.CENTRALINI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON CENTRALINI.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(CENTRALINI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(CENTRALINI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(CENTRALINI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE CENTRALINI.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') like '%$ubicazione%'";

        if(!empty($prodotto))
            $sql .= " AND APPARATI.PRODOTTO like '%$prodotto%'";

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
        $produttore = Input::get('produttore');
        $modello = Input::get('modello');
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
            CENTRALINI.IDCENTRALINO,
            CENTRALINI.CODICE_R,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_R,105) DATA_R,
            CENTRALINI.ACQUISTO_NOLEGGIO,
            CENTRALINI.DESCRIZIONE,
            CENTRALINI.VERSIONE,
            CENTRALINI.PRODUTTORE,
            CENTRALINI.SERIALE,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            CENTRALINI.OGGETTO,
            CENTRALINI.ELIMINATO
			FROM		gsu.dbo.CENTRALINI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON CENTRALINI.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(CENTRALINI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(CENTRALINI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(CENTRALINI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND CENTRALINI.IDCENTRALINO = '$id'";
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

        if(!empty($produttore))
            $sql .= " AND CENTRALINI.PRODUTTORE like '%$produttore%'";
        if(!empty($marca))
            $sql .= " AND CENTRALINI.DESCRIZIONE like '%$marca%'";
        if(!empty($modello))
            $sql .= " AND CENTRALINI.VERSIONE like '%$modello%'";
        if(!empty($sn))
            $sql .= " AND CENTRALINI.SERIALE like '%$sn%'";

        if(!empty($eliminati))
            $sql .= " AND CENTRALINI.ELIMINATO = 1";
        else
            $sql .= " AND CENTRALINI.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.CENTRALINI SET ELIMINATO=1 WHERE IDCENTRALINO='$id'";
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
        $data_r = Input::get('data_r');
        $acquisto_noleggio = Input::get('acquisto_noleggio');
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $produttore = Input::get('produttore');
        $sn = Input::get('sn');
        $oggetto = Input::get('oggetto');
        $data_inserimento = $date = date('Y-m-d H:i:s');

        try {
            if(empty($id)) {
                DB::insert("insert into CENTRALINI (SOGGETTO,CLIENTE,DESTINATARIOABITUALE,DATA_R,ACQUISTO_NOLEGGIO,DESCRIZIONE,VERSIONE,PRODUTTORE,SERIALE,OGGETTO,DATA_INSERIMENTO,ELIMINATO) values ('$soggetto','$cliente','$destinatarioabituale','$data_r','$acquisto_noleggio','$marca','$modello','$produttore','$sn','$oggetto','$data_inserimento',$eliminato)");


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
                DB::update("Update CENTRALINI Set SOGGETTO='$soggetto',CLIENTE='$cliente',DESTINATARIOABITUALE='$destinatarioabituale', DATA_R = '$data_r', ACQUISTO_NOLEGGIO = '$acquisto_noleggio', DESCRIZIONE = '$marca', VERSIONE = '$modello', PRODUTTORE = '$produttore', SERIALE = '$sn', OGGETTO = '$oggetto', ELIMINATO = $eliminato WHERE IDCENTRALINO=$id");
            if($stato_precedente == 1 && $eliminato == 0 && !empty($manutenzione)){
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new CentraliniModel();
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

    public function getAssistenzaCentralino($SN){
        $sql = "SELECT * FROM ASSISTENZACENTRALINI WHERE (SERIALE= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }





}


