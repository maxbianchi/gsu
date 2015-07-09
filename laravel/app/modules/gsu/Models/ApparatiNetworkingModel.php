<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class ApparatiNetworkingModel extends Model {

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
            APPARATI.ID,
            APPARATI.CODICE_R,
            CONVERT(VARCHAR(10),APPARATI.DATA_R,105) DATA_R,
            APPARATI.CANONE_R,
            APPARATI.PRODOTTO,
            APPARATI.ACQUISTO_NOLEGGIO,
            APPARATI.MARCA,
            APPARATI.MODELLO,
            APPARATI.PN,
            APPARATI.SN,
            APPARATI.RAM,
            APPARATI.FLASH,
            APPARATI.SOFTWARE,
            APPARATI.IOS,
            APPARATI.ASDM_PDM,
            APPARATI.DES_AES,
            CONVERT(VARCHAR(10),APPARATI.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            CONVERT(VARCHAR(10),APPARATI.SCADENZAGARANZIA,105) SCADENZAGARANZIA,
            CONVERT(VARCHAR(10),APPARATI.SCARINNGARANZIA,105) SCARINNGARANZIA,
            APPARATI.IPAPPARATO,
            APPARATI.SMAPPARATO,
            APPARATI.OGGETTO,
            APPARATI.IP_STATICO_ROUTER,
            APPARATI.RUTSUB,
            APPARATI.GATEWAY_INTERFACCIA_LAN,
            APPARATI.LANSUB
			FROM		gsu.dbo.APPARATI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON APPARATI.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(APPARATI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(APPARATI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(APPARATI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE APPARATI.ELIMINATO = 0
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
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $seriale = Input::get('seriale');
        $eliminati = Input::get('eliminati');
        $prodotto = Input::get('prodotto');

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
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.CAP		        AS DESTINATARIOABITUALE_CAP,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			ISNULL(anagrafica3.PARTITAIVA,anagrafica3.CODICEFISCALE) AS DESTINATARIOABITUALE_PIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
            APPARATI.ID,
            APPARATI.CODICE_R,
            CONVERT(VARCHAR(10),APPARATI.DATA_R,105) DATA_R,
            APPARATI.CANONE_R,
            APPARATI.PRODOTTO,
            APPARATI.ACQUISTO_NOLEGGIO,
            APPARATI.MARCA,
            APPARATI.MODELLO,
            APPARATI.PN,
            APPARATI.SN,
            APPARATI.RAM,
            APPARATI.FLASH,
            APPARATI.SOFTWARE,
            APPARATI.IOS,
            APPARATI.ASDM_PDM,
            APPARATI.DES_AES,
            CONVERT(VARCHAR(10),APPARATI.DATA_INSERIMENTO,105) DATA_INSERIMENTO,
            CONVERT(VARCHAR(10),APPARATI.SCADENZAGARANZIA,105) SCADENZAGARANZIA,
            CONVERT(VARCHAR(10),APPARATI.SCARINNGARANZIA,105) SCARINNGARANZIA,
            APPARATI.IPAPPARATO,
            APPARATI.SMAPPARATO,
            APPARATI.OGGETTO,
            APPARATI.IP_STATICO_ROUTER,
            APPARATI.RUTSUB,
            APPARATI.GATEWAY_INTERFACCIA_LAN,
            APPARATI.LANSUB
			FROM		gsu.dbo.APPARATI
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON APPARATI.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(APPARATI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(APPARATI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(APPARATI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND APPARATI.ID = '$id'";
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

        if(!empty($prodotto))
            $sql .= " AND APPARATI.PRODOTTO like '%$prodotto%'";

        if(!empty($marca))
            $sql .= " AND APPARATI.MARCA like '%$marca%'";
        if(!empty($modello))
            $sql .= " AND APPARATI.MODELLO like '%$modello%'";
        if(!empty($seriale))
            $sql .= " AND APPARATI.SN like '%$seriale%'";

        if(!empty($eliminati))
            $sql .= " AND APPARATI.ELIMINATO = 1";
        else
            $sql .= " AND APPARATI.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.APPARATI SET ELIMINATO=1 WHERE ID='$id'";
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

        if(empty($manutenzione))
            $manutenzione = "AGGIUNTO";

        $soggetto = Input::get('cliente');
        $cliente = Input::get('cliente_finale');
        $destinatarioabituale = Input::get('ubicazione_impianto');
        $data_r = Input::get('data_r');
        $canone_r = Input::get('canone_r');
        $prodotto = Input::get('prodotto');
        $acquisto_noleggio = Input::get('acquisto_noleggio');
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $pn = Input::get('pn');
        $sn = Input::get('sn');
        $ram = Input::get('ram');
        $flash = Input::get('flash');
        $software = Input::get('software');
        $ios = Input::get('ios');
        $asdm_pdm = Input::get('asdm_pdm');
        $des_aes = Input::get('des_aes');
        $scadenzagaranzia = empty(Input::get('scadenzagaranzia')) ? "00-00-0000" : Input::get('scadenzagaranzia');
        $scarinngaranzia = empty(Input::get('scarinngaranzia')) ? "00-00-0000" : Input::get('scarinngaranzia');
        $ipapparato = Input::get('ipapparato');
        $smapparato = Input::get('smapparato');
        $oggetto = Input::get('oggetto');
        $ip_statico_router = Input::get('ip_statico_router');
        $rutsub = Input::get('rutsub');
        $gateway_interfaccia_lan = Input::get('gateway_interfaccia_lan');
        $lansub = Input::get('lansub');
        $data_inserimento = $date = date('Y-m-d H:i:s');







        try {
            if(empty($id)) {
                DB::insert("insert into APPARATI (SOGGETTO,CLIENTE,DESTINATARIOABITUALE,DATA_R,CANONE_R,PRODOTTO,ACQUISTO_NOLEGGIO,MARCA,MODELLO,PN,SN,RAM,FLASH,SOFTWARE,IOS,ASDM_PDM,DES_AES,SCADENZAGARANZIA,SCARINNGARANZIA,IPAPPARATO,SMAPPARATO,OGGETTO,IP_STATICO_ROUTER,RUTSUB,GATEWAY_INTERFACCIA_LAN,LANSUB,DATA_INSERIMENTO,ELIMINATO) values ('$soggetto','$cliente','$destinatarioabituale','$data_r','$manutenzione','$prodotto','$acquisto_noleggio','$marca','$modello','$pn','$sn','$ram','$flash','$software','$ios','$asdm_pdm','$des_aes','$scadenzagaranzia','$scarinngaranzia','$ipapparato','$smapparato','$oggetto','$ip_statico_router','$rutsub','$gateway_interfaccia_lan','$lansub','$data_inserimento',$eliminato)");


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
                DB::update("Update APPARATI Set SOGGETTO='$soggetto',CLIENTE='$cliente',DESTINATARIOABITUALE='$destinatarioabituale', DATA_R = '$data_r', CANONE_R = '$manutenzione', PRODOTTO = '$prodotto', ACQUISTO_NOLEGGIO = '$acquisto_noleggio', MARCA = '$marca', MODELLO = '$modello', PN = '$pn', SN = '$sn', RAM = '$ram', FLASH = '$flash', SOFTWARE = '$software', IOS = '$ios', ASDM_PDM = '$asdm_pdm', DES_AES = '$des_aes', SCADENZAGARANZIA = CONVERT(VARCHAR(10),'$scadenzagaranzia',105), SCARINNGARANZIA = '$scarinngaranzia', IPAPPARATO = '$ipapparato', SMAPPARATO = '$smapparato', OGGETTO = '$oggetto', IP_STATICO_ROUTER = '$ip_statico_router', RUTSUB = '$rutsub', GATEWAY_INTERFACCIA_LAN = '$gateway_interfaccia_lan', LANSUB = '$lansub', ELIMINATO=$eliminato WHERE ID=$id");
            if($stato_precedente == 1 && $eliminato == 0 && !empty($manutenzione)){
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new ApparatiNetworkingModel();
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

    public function getUrlFiltering($SN){
        $sql = "SELECT * FROM URLFILTERING WHERE (SN= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getSmartNet($SN){
        $sql = "SELECT * FROM SMARTNET WHERE (SERIALE= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getVpn($SN){
        $sql = "SELECT * FROM VPN WHERE (SEDE1= '" . $SN . "' OR SEDE2='" . $SN . "' OR SEDE3='" . $SN . "' OR SEDE4='" . $SN . "' OR SEDE5='" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getIpMultimedia($SN){
        $sql = "SELECT * FROM IPMULTIMEDIA WHERE (SN= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getGestioneApparati($SN){
        $sql = "SELECT * FROM GESTIONE_APPARATI WHERE (SERIALE= '" . $SN . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

}


