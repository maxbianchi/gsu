<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class UnigateModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');

        $sql = <<<EOF
			SELECT
			RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.DESCRIZIONE 	AS CLIENTE,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			UNIGATE.IDUNIGATE,
            UNIGATE.CODICE_R,
			UNIGATE.APPARECCHIO,
			UNIGATE.SN,
			UNIGATE.APPARECCHIOSUPPLEMENTARE,
			UNIGATE.ADAPTERSN,
            UNIGATE.NUMEROTELEFONICO,
            UNIGATE.IP_STATICO_ROUTER,
			UNIGATE.RUTSUB,
			UNIGATE.GATEWAY_INTERFACCIA_LAN,
            UNIGATE.LANSUB,
			UNIGATE.IP_STATICI,
			UNIGATE.IPSUB,
			UNIGATE.GATEWAY_WAN_PUNTO_A_PUNTO,
			UNIGATE.WANSUB,
			UNIGATE.ELIMINATO
			FROM gsu.dbo.UNIGATE
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON UNIGATE.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE UNIGATE.ELIMINATO = 0
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

        $sn = Input::get('sn');
        $apparecchio = Input::get('apparecchio');
        $numero_telefono = Input::get('numero_telefono');
        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.DESCRIZIONE 	AS CLIENTE,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			UNIGATE.IDUNIGATE,
            UNIGATE.CODICE_R,
			UNIGATE.APPARECCHIO,
			UNIGATE.SN,
			UNIGATE.APPARECCHIOSUPPLEMENTARE,
			UNIGATE.ADAPTERSN,
            UNIGATE.NUMEROTELEFONICO,
            UNIGATE.IP_STATICO_ROUTER,
			UNIGATE.RUTSUB,
			UNIGATE.GATEWAY_INTERFACCIA_LAN,
            UNIGATE.LANSUB,
			UNIGATE.IP_STATICI,
			UNIGATE.IPSUB,
			UNIGATE.GATEWAY_WAN_PUNTO_A_PUNTO,
			UNIGATE.WANSUB,
			UNIGATE.ELIMINATO
			FROM gsu.dbo.UNIGATE
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON UNIGATE.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
			WHERE 1 = 1
EOF;

        if(!empty($id))
            $sql .= " AND UNIGATE.IDUNIGATE = '$id'";
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

        if(!empty($sn))
            $sql .= " AND UNIGATE.SN like '%$sn%'";
        if(!empty($apparecchio))
            $sql .= " AND UNIGATE.APPARECCHIO like '%$apparecchio%'";
        if(!empty($numero_telefono))
            $sql .= " AND UNIGATE.NUMEROTELEFONICO like '%$numero_telefono%'";

        if(!empty($eliminati))
            $sql .= " AND UNIGATE.ELIMINATO = 1";
        else
            $sql .= " AND UNIGATE.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.UNIGATE SET ELIMINATO=1 WHERE IDUNIGATE='$id'";
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
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');

        $manutenzione = Input::get('manutenzione');
        $apparecchio = Input::get('apparecchio');
        $sn = Input::get('sn');
        $apparecchiosupplementare = Input::get('apparecchiosupplementare');
        $adaptersn = Input::get('adaptersn');
        $numerotelefonico = Input::get('numerotelefonico');
        $ip_statico_router = Input::get('ip_statico_router');
        $rutsub = Input::get('rutsub');
        $gateway_interfaccia_lan = Input::get('gateway_interfaccia_lan');
        $lansub = Input::get('lansub');
        $ip_statici = Input::get('ip_statici');
        $ipsub = Input::get('ipsub');
        $gateway_wan_punto_a_punto = Input::get('gateway_wan_punto_a_punto');
        $wansub = Input::get('wansub');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.UNIGATE (CODICE_R,APPARECCHIO,SN,APPARECCHIOSUPPLEMENTARE,ADAPTERSN,NUMEROTELEFONICO,IP_STATICO_ROUTER,RUTSUB,GATEWAY_INTERFACCIA_LAN,LANSUB,IP_STATICI,IPSUB,GATEWAY_WAN_PUNTO_A_PUNTO,WANSUB, ELIMINATO) VALUES ('$manutenzione','$apparecchio','$sn','$apparecchiosupplementare','$adaptersn','$numerotelefonico','$ip_statico_router','$rutsub','$gateway_interfaccia_lan','$lansub','$ip_statici','$ipsub','$gateway_wan_punto_a_punto','$wansub',$eliminato)");


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
                DB::update("UPDATE gsu.dbo.UNIGATE SET Codice_R='$manutenzione',APPARECCHIO='$apparecchio',SN='$sn',APPARECCHIOSUPPLEMENTARE='$apparecchiosupplementare',ADAPTERSN='$adaptersn',NUMEROTELEFONICO='$numerotelefonico',IP_STATICO_ROUTER='$ip_statico_router',RUTSUB='$rutsub',GATEWAY_INTERFACCIA_LAN='$gateway_interfaccia_lan',LANSUB='$lansub',IP_STATICI='$ip_statici',IPSUB='$ipsub',GATEWAY_WAN_PUNTO_A_PUNTO='$gateway_wan_punto_a_punto',WANSUB='$wansub', ELIMINATO=$eliminato WHERE IDUNIGATE=$id");
                if($stato_precedente == 1 && $eliminato == 0){
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
                }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function checkAddNew(){
        $model = new UnigateModel();
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

    public function getAllApparecchi(){
        $sql = "SELECT * FROM dbo.APPARATI_UNIGATE ORDER BY APPARATO";
        $apparecchi = DB::select($sql);
        return $apparecchi;
    }

}

