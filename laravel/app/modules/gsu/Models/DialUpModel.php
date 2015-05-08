<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class DialUpModel extends Model {

    public function getAllRequest(){
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
			DIAL_UP.IDDIALUP,
			DIAL_UP.CONNESSIONE,
			DIAL_UP.TIPO_CONNESSIONE,
			DIAL_UP.ACCOUNT,
			DIAL_UP.PASSWORD,
			DIAL_UP.IP,
			DIAL_UP.NOTE,
			DIAL_UP.CODICE_R
			FROM		gsu.dbo.DIAL_UP
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON DIAL_UP.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica	ON richieste.SOGGETTO				= anagrafica.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
            ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE
EOF;

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
        $connessione = Input::get('connessione');
        $tipo_connessione = Input::get('tipo_connessione');
        $ip = Input::get('ip');


        $sql = <<<EOF
            SELECT
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
			DIAL_UP.IDDIALUP,
			DIAL_UP.CONNESSIONE,
			DIAL_UP.TIPO_CONNESSIONE,
			DIAL_UP.ACCOUNT,
			DIAL_UP.PASSWORD,
			DIAL_UP.IP,
			DIAL_UP.NOTE,
			DIAL_UP.CODICE_R
			FROM		gsu.dbo.DIAL_UP
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON DIAL_UP.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			WHERE 1 = 1
EOF;

        if(!empty($id))
            $sql .= " AND DIAL_UP.IDDIALUP = '$id'";
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

        if(!empty($connessione))
            $sql .= " AND DIAL_UP.CONNESSIONE like '%$connessione%'";
        if(!empty($tipo_connessione))
            $sql .= " AND DIAL_UP.TIPO_CONNESSIONE like '%$tipo_connessione%'";
        if(!empty($ip))
            $sql .= " AND DIAL_UP.IP like '%$ip%'";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }


}

