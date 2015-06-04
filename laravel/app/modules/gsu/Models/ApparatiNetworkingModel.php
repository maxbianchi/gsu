<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class ApparatiNetworkingModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');
        $prodotto = Input::get('prodotto');

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
            APPARATI.ID,
            APPARATI.CODICE_R,
            APPARATI.DATA_R,
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
            APPARATI.SCADENZAGARANZIA,
            APPARATI.SCARINNGARANZIA,
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
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";

        if(!empty($prodotto))
            $sql .= " AND APPARATI.PRODOTTO like '%$prodotto%'";

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
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $seriale = Input::get('seriale');
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
            APPARATI.ID,
            APPARATI.CODICE_R,
            APPARATI.DATA_R,
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
            APPARATI.SCADENZAGARANZIA,
            APPARATI.SCARINNGARANZIA,
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

        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione_impianto = Input::get('ubicazione_impianto');
        $marca = Input::get('marca');
        $modello = Input::get('modello');
        $seriale = Input::get('seriale');





        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.APPARATI (CODICE_R,TIPO_LINEA,LINEA_FORNITORE,NUMERO_TELEFONO,TGU,IP_STATICI,IPSUB,GATEWAY_WAN_PUNTO_A_PUNTO,WANSUB,GATEWAY_INTERFACCIA_LAN,LANSUB,IP_STATICO_ROUTER,RUTSUB,NUM_IP_STATICI,MODALITA,DNS_PRIMARIO,DNS_SECONDARIO,N_VERDE,VPI,VCI,INSTALLAZIONE_MODEM,INCAPSULAMENTO,MULTIPLEX,UTENTE_RADIUS,PASS_RADIUS, ELIMINATO) VALUES ('$manutenzione','$tipo_linea','$linea_fornitore','$numero_telefono','$tgu','$ip_statici','$ipsub','$gateway_wan_punto_a_punto','$wansub','$gateway_interfaccia_lan','$lansub','$ip_statico_router','$rutsub','$numero_ip_statici','$modalita','$dns_primario','$dns_secondario','$numero_verde','$vpi','$vci','$installazione_modem','$incapsulamento','$multiplex','$utente_radius','$pass_radius',$eliminato)");


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
                DB::update("UPDATE gsu.dbo.APPARATI SET Codice_R='$manutenzione',TIPO_LINEA='$tipo_linea',LINEA_FORNITORE='$linea_fornitore',NUMERO_TELEFONO='$numero_telefono',TGU='$tgu',IP_STATICI='$ip_statici',IPSUB='$ipsub',GATEWAY_WAN_PUNTO_A_PUNTO='$gateway_wan_punto_a_punto',WANSUB='$wansub',GATEWAY_INTERFACCIA_LAN='$gateway_interfaccia_lan',LANSUB='$lansub',IP_STATICO_ROUTER='$ip_statico_router',RUTSUB='$rutsub',NUM_IP_STATICI='$numero_ip_statici',MODALITA='$modalita',DNS_PRIMARIO='$dns_primario',DNS_SECONDARIO='$dns_secondario',N_VERDE='$numero_verde',VPI='$vpi',VCI='$vci',INSTALLAZIONE_MODEM='$installazione_modem',INCAPSULAMENTO='$incapsulamento',MULTIPLEX='$multiplex',UTENTE_RADIUS='$utente_radius',PASS_RADIUS='$pass_radius', ELIMINATO=$eliminato WHERE ID=$id");
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

}

