<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class MplsDirectAccessModel extends Model {

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
	        MPLSDIRECTACCESS.IDMPLSDIRECTACCESS,
			MPLSDIRECTACCESS.LINEA_FORNITORE,
			MPLSDIRECTACCESS.TIPO_LINEA,
			MPLSDIRECTACCESS.TGU,
			MPLSDIRECTACCESS.IP_STATICO_ROUTER,
			MPLSDIRECTACCESS.GATEWAY_WAN_PUNTO_PUNTO,
			MPLSDIRECTACCESS.GATEWAY_INTERFACCIA_LAN,
			MPLSDIRECTACCESS.NUMERO_IP_STATICI,
			MPLSDIRECTACCESS.CODICE_R,
			MPLSDIRECTACCESS.ELIMINATO
			FROM gsu.dbo.MPLSDIRECTACCESS
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON MPLSDIRECTACCESS.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE MPLSDIRECTACCESS.ELIMINATO = 0
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

        $tgu = Input::get('tgu');
        $ip_router = Input::get('ip_router');
        $numero_telefono = Input::get('numero_telefono');
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
	        MPLSDIRECTACCESS.IDMPLSDIRECTACCESS,
			MPLSDIRECTACCESS.LINEA_FORNITORE,
			MPLSDIRECTACCESS.TIPO_LINEA,
			MPLSDIRECTACCESS.TGU,
			MPLSDIRECTACCESS.IP_STATICO_ROUTER,
			MPLSDIRECTACCESS.GATEWAY_WAN_PUNTO_PUNTO,
			MPLSDIRECTACCESS.GATEWAY_INTERFACCIA_LAN,
			MPLSDIRECTACCESS.NUMERO_IP_STATICI,
			MPLSDIRECTACCESS.MODALITA,
			MPLSDIRECTACCESS.DLCI,
            MPLSDIRECTACCESS.NUMERO_TELEFONO,
			MPLSDIRECTACCESS.LMI_TYPE,
			MPLSDIRECTACCESS.IP_STATICI_SUBNET,
            MPLSDIRECTACCESS.DNS_PRIMARIO,
			MPLSDIRECTACCESS.DNS_SECONDARIO,
			MPLSDIRECTACCESS.N_VERDE,
			MPLSDIRECTACCESS.VPI,
			MPLSDIRECTACCESS.VCI,
            MPLSDIRECTACCESS.INSTALLAZIONE_MODEM,
			MPLSDIRECTACCESS.INCAPSULAMENTO,
            MPLSDIRECTACCESS.IPSUB,
			MPLSDIRECTACCESS.WANSUB,
			MPLSDIRECTACCESS.LANSUB,
			MPLSDIRECTACCESS.RUTSUB,
			MPLSDIRECTACCESS.CODICE_R,
			MPLSDIRECTACCESS.ELIMINATO
			FROM gsu.dbo.MPLSDIRECTACCESS
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON MPLSDIRECTACCESS.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND MPLSDIRECTACCESS.IDMPLSDIRECTACCESS = '$id'";
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

        if(!empty($tgu))
            $sql .= " AND MPLSDIRECTACCESS.TGU like '%$tgu%'";
        if(!empty($ip_router))
            $sql .= " AND MPLSDIRECTACCESS.IP_STATICO_ROUTER like '%$ip_router%'";
        if(!empty($numero_telefono))
            $sql .= " AND MPLSDIRECTACCESS.NUMERO_TELEFONO like '%$numero_telefono%'";

        if(!empty($eliminati))
            $sql .= " AND MPLSDIRECTACCESS.ELIMINATO = 1";
        else
            $sql .= " AND MPLSDIRECTACCESS.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.MPLSDIRECTACCESS SET ELIMINATO=1 WHERE IDMPLSDIRECTACCESS='$id'";
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
        $tipo_linea = Input::get('tipo_linea');
        $linea_fornitore = Input::get('linea_fornitore');
        $numero_telefono = Input::get('numero_telefono');
        $tgu = Input::get('tgu');
        $ip_statici_subnet = Input::get('ip_statici');
        $ipsub = Input::get('ipsub');
        $gateway_wan_punto_punto = Input::get('gateway_wan_punto_punto');
        $wansub = Input::get('wansub');
        $gateway_interfaccia_lan = Input::get('gateway_interfaccia_lan');
        $lansub = Input::get('lansub');
        $ip_statico_router = Input::get('ip_statico_router');
        $rutsub = Input::get('rutsub');
        $numero_ip_statici = Input::get('numero_ip_statici');
        $modalita = Input::get('modalita');
        $dns_primario = Input::get('dns_primario');
        $dns_secondario = Input::get('dns_secondario');
        $numero_verde = Input::get('numero_verde');
        $vpi = Input::get('vpi');
        $vci = Input::get('vci');
        $installazione_modem = Input::get('installazione_modem');
        $incapsulamento = Input::get('incapsulamento');
        $dlci = Input::get('dlci');
        $lmi_type = Input::get('lmi_type');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.MPLSDIRECTACCESS (CODICE_R,TIPO_LINEA,LINEA_FORNITORE,NUMERO_TELEFONO,TGU,NUMERO_IP_STATICI,IP_STATICI_SUBNET,IPSUB,GATEWAY_WAN_PUNTO_PUNTO,WANSUB,GATEWAY_INTERFACCIA_LAN,LANSUB,IP_STATICO_ROUTER,RUTSUB,MODALITA,DNS_PRIMARIO,DNS_SECONDARIO,N_VERDE,VPI,VCI,INSTALLAZIONE_MODEM,INCAPSULAMENTO,DLCI,LMI_TYPE,ELIMINATO) VALUES ('$manutenzione','$tipo_linea','$linea_fornitore','$numero_telefono','$tgu','$numero_ip_statici','$ip_statici_subnet','$ipsub','$gateway_wan_punto_punto','$wansub','$gateway_interfaccia_lan','$lansub','$ip_statico_router','$rutsub','$modalita','$dns_primario','$dns_secondario','$numero_verde','$vpi','$vci','$installazione_modem','$incapsulamento','$dlci','$lmi_type',$eliminato)");

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
                DB::update("UPDATE gsu.dbo.MPLSDIRECTACCESS SET Codice_R='$manutenzione',TIPO_LINEA='$tipo_linea',LINEA_FORNITORE='$linea_fornitore',NUMERO_TELEFONO='$numero_telefono',TGU='$tgu',NUMERO_IP_STATICI='$numero_ip_statici',IP_STATICI_SUBNET='$ip_statici_subnet',IPSUB='$ipsub',GATEWAY_WAN_PUNTO_PUNTO='$gateway_wan_punto_punto',WANSUB='$wansub',GATEWAY_INTERFACCIA_LAN='$gateway_interfaccia_lan',LANSUB='$lansub',IP_STATICO_ROUTER='$ip_statico_router',RUTSUB='$rutsub',MODALITA='$modalita',DNS_PRIMARIO='$dns_primario',DNS_SECONDARIO='$dns_secondario',N_VERDE='$numero_verde',VPI='$vpi',VCI='$vci',INSTALLAZIONE_MODEM='$installazione_modem',INCAPSULAMENTO='$incapsulamento',DLCI='$dlci',LMI_TYPE='$lmi_type',ELIMINATO=$eliminato WHERE IDMPLSDIRECTACCESS=$id");
                if($stato_precedente == 1 && $eliminato == 0){
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
                }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getServiziPlus($TGU){
        $sql = "SELECT * FROM SERVIZI_PLUS WHERE (TGU_1= '" . $TGU . "' OR TGU_2='" . $TGU . "' OR TGU_3='" . $TGU . "' OR TGU_4='" . $TGU . "' OR TGU_5='" . $TGU . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getServiziAccess($TGU){
        $sql = "SELECT * FROM servizi_access WHERE (TGU_PRIMARIA= '" . $TGU . "' OR TGU_SECONDARIA='" . $TGU . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function checkAddNew(){
        $model = new MplsDirectAccessModel();
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

