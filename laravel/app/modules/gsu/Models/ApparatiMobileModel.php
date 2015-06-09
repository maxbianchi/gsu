<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class ApparatiMobileModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');

        $sql = <<<EOF
        SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			richieste.DATADOCUMENTO	AS DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
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
            APPARATI_MOBILE.ID,
            APPARATI_MOBILE.CODICE_R,
            APPARATI_MOBILE.ACQUISTO_NOLEGGIO,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.DATAACQUISTO,105) DATAACQUISTO,
            APPARATI_MOBILE.MARCA,
            APPARATI_MOBILE.MODELLO,
            APPARATI_MOBILE.PN,
            APPARATI_MOBILE.SN,
            APPARATI_MOBILE.PIN,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.SCADGARANZIAINIZ,105) SCADGARANZIAINIZ,
            APPARATI_MOBILE.NTELEFONO,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.SCADRINNOVOGARANZIA,105) SCADRINNOVOGARANZIA,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.DATA_R,105) DATA_R,
            APPARATI_MOBILE.OGGETTO
			FROM		gsu.dbo.APPARATI_MOBILE
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON APPARATI_MOBILE.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(APPARATI_MOBILE.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(APPARATI_MOBILE.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(APPARATI_MOBILE.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE APPARATI_MOBILE.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";

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
        $pn = Input::get('pn');
        $modello = Input::get('modello');
        $imei = Input::get('imei');
        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			richieste.DATADOCUMENTO	AS DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,

			anagrafica1.SOGGETTO AS SOGGETTO_CODICE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.CAP		        AS SOGGETTO_CAP,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			ISNULL(anagrafica1.PARTITAIVA,anagrafica1.CODICEFISCALE) AS SOGGETTO_PIVA,

            anagrafica2.SOGGETTO        AS CLIENTE_CODICE,
			anagrafica2.DESCRIZIONE	    AS CLIENTE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
            anagrafica2.CAP		        AS CLIENTE_CAP,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			ISNULL(anagrafica2.PARTITAIVA,anagrafica2.CODICEFISCALE) AS CLIENTE_PIVA,

            anagrafica3.SOGGETTO        AS DESTINATARIOABITUALE_CODICE,
			anagrafica3.DESCRIZIONE	    AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.CAP		        AS DESTINATARIOABITUALE_CAP,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			ISNULL(anagrafica3.PARTITAIVA,anagrafica3.CODICEFISCALE) AS DESTINATARIOABITUALE_PIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
            APPARATI_MOBILE.ID,
            APPARATI_MOBILE.CODICE_R,
            APPARATI_MOBILE.ACQUISTO_NOLEGGIO,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.DATAACQUISTO,105) DATAACQUISTO,
            APPARATI_MOBILE.MARCA,
            APPARATI_MOBILE.MODELLO,
            APPARATI_MOBILE.PN,
            APPARATI_MOBILE.SN,
            APPARATI_MOBILE.PIN,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.SCADGARANZIAINIZ,105) SCADGARANZIAINIZ,
            APPARATI_MOBILE.NTELEFONO,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.SCADRINNOVOGARANZIA,105) SCADRINNOVOGARANZIA,
            CONVERT(VARCHAR(10),APPARATI_MOBILE.DATA_R,105) DATA_R,
            APPARATI_MOBILE.OGGETTO
			FROM		gsu.dbo.APPARATI_MOBILE
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON APPARATI_MOBILE.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(APPARATI_MOBILE.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(APPARATI_MOBILE.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(APPARATI_MOBILE.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND APPARATI_MOBILE.ID = '$id'";
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

        if(!empty($pn))
            $sql .= " AND APPARATI_MOBILE.PN like '%$pn%'";
        if(!empty($imei))
            $sql .= " AND APPARATI_MOBILE.SN like '%$imei%'";
        if(!empty($modello))
            $sql .= " AND APPARATI_MOBILE.VERSIONE like '%$modello%'";


        if(!empty($eliminati))
            $sql .= " AND APPARATI_MOBILE.ELIMINATO = 1";
        else
            $sql .= " AND APPARATI_MOBILE.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.APPARATI_MOBILE SET ELIMINATO=1 WHERE ID='$id'";
            DB::delete($sql);

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
        $scadgaranziainiz =  empty(Input::get('scadgaranziainiz')) ? "00-00-0000" : Input::get('scadgaranziainiz');
        $ntelefono = Input::get('ntelefono');
        $scadrinnovogaranzia = empty(Input::get('scadrinnovogaranzia')) ? "00-00-0000" : Input::get('scadrinnovogaranzia');
        $oggetto = Input::get('oggetto');

        try {
            if(empty($id)) {
                DB::insert("insert into APPARATI_MOBILE (SOGGETTO,CLIENTE,DESTINATARIOABITUALE,DATA_R,ACQUISTO_NOLEGGIO,DATAACQUISTO,MARCA,MODELLO,PN,SN,PIN,SCADGARANZIAINIZ,NTELEFONO,SCADRINNOVOGARANZIA,OGGETTO,ELIMINATO) values ('$soggetto','$cliente','$destinatarioabituale','$data_r','$acquisto_noleggio','$dataacquisto','$marca','$modello','$pn','$sn','$pin','$scadgaranziainiz','$ntelefono','$scadrinnovogaranzia','$oggetto',$eliminato)");


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
                DB::update("Update APPARATI_MOBILE Set SOGGETTO='$soggetto',CLIENTE='$cliente',DESTINATARIOABITUALE='$destinatarioabituale', DATA_R = '$data_r', ACQUISTO_NOLEGGIO = '$acquisto_noleggio', DATAACQUISTO='$dataacquisto',MARCA='$marca', MODELLO='$modello',PN='$pn', SN='$sn',PIN='$pin',SCADGARANZIAINIZ='$scadgaranziainiz',NTELEFONO='$ntelefono',SCADRINNOVOGARANZIA='$scadrinnovogaranzia',OGGETTO='$oggetto',ELIMINATO = $eliminato WHERE ID=$id");
            if($stato_precedente == 1 && $eliminato == 0 && !empty($manutenzione)){
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new ApparatiMobileModel();
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
        $sql = "SELECT * FROM SIM WHERE (SERIALE_TEL= '" . $SN . "')";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getAllTelefoni(){
        $sql = "SELECT * FROM dbo.SIM_TELEFONI ORDER BY NOME_TEL";
        $res = DB::select($sql);
        return $res;
    }



}


