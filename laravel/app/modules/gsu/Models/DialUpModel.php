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

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "DELETE FROM gsu.dbo.DIAL_UP WHERE IDDIALUP='$id'";
            DB::delete($sql);

            $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
            $richieste_evase = DB::select($sql);
            if(count($richieste_evase) > 0){
                $richieste_evase = $richieste_evase[0];
                $qta = $richieste_evase['QUANTITA'] - 1;
                DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = $qta where CODICE_R = '$manutenzione'");
            }


            }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $connessione = Input::get('connessione');
        $tipo_connessione = Input::get('tipo_connessione');
        $account = Input::get('account');
        $password = Input::get('password');
        $ip = Input::get('ip');
        $note = Input::get('note');
        $manutenzione = Input::get('manutenzione');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.DIAL_UP (Codice_R, Connessione, Tipo_Connessione, Account, Password, Ip,Note) VALUES ('$manutenzione','$connessione','$tipo_connessione','$account','$password','$ip','$note')");
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
                DB::update("UPDATE gsu.dbo.DIAL_UP SET Codice_R='$manutenzione', Connessione='$connessione', Tipo_Connessione='$tipo_connessione', Account='$account', Password='$password', Ip='$ip',Note='$note' WHERE IDDIALUP=$id");

        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


    }

}
