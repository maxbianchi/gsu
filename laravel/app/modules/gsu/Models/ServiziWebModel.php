<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class ServiziWebModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');
        $tipo_servizio = Input::get('tipo_servizio');

        $sql = <<<EOF
        SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
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
            SERVIZIWEB.IDSERVIZIOWEB,
            SERVIZIWEB.TIPO_SERVIZIO,
            SERVIZIWEB.SERVER_,
            SERVIZIWEB.DIRECTORY,
            SERVIZIWEB.LOGIN,
            SERVIZIWEB.PASSWORD,
            SERVIZIWEB.ANALISI_LOG
			FROM		gsu.dbo.SERVIZIWEB
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVIZIWEB.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON SERVIZIWEB.CLIENTE				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON SERVIZIWEB.CLIENTE_FINALE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON SERVIZIWEB.UBICAZIONE_IMPIANTO	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE SERVIZIWEB.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";

        if(!empty($tipo_servizio))
            $sql .= " AND SERVIZIWEB.TIPO_SERVIZIO like '%$tipo_servizio%'";

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
        $server = Input::get('server');
        $tipo_servizio = Input::get('tipo_servizio');
        $eliminati = Input::get('eliminati');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
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
            SERVIZIWEB.IDSERVIZIOWEB,
            SERVIZIWEB.TIPO_SERVIZIO,
            SERVIZIWEB.SERVER_,
            SERVIZIWEB.DIRECTORY,
            SERVIZIWEB.LOGIN,
            SERVIZIWEB.PASSWORD,
            SERVIZIWEB.ANALISI_LOG
			FROM		gsu.dbo.SERVIZIWEB
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON SERVIZIWEB.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON SERVIZIWEB.CLIENTE				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON SERVIZIWEB.CLIENTE_FINALE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON SERVIZIWEB.UBICAZIONE_IMPIANTO	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND SERVIZIWEB.IDSERVIZIOWEB = '$id'";
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

        if(!empty($server))
            $sql .= " AND SERVIZIWEB.SERVER like '%$server%'";
        if(!empty($tipo_servizio))
            $sql .= " AND SERVIZIWEB.TIPO_SERVIZIO like '%$tipo_servizio%'";

        if(!empty($eliminati))
            $sql .= " AND SERVIZIWEB.ELIMINATO = 1";
        else
            $sql .= " AND SERVIZIWEB.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.SERVIZIWEB SET ELIMINATO=1 WHERE IDSERVIZIOWEB='$id'";
            DB::update($sql);
            }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $connessione = Input::get('connessione');
        $tipo_connessione = Input::get('tipo_connessione');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');

        $tipo_servizio = Input::get('tipo_servizio');
        $server = Input::get('server');
        $directory = Input::get('directory');
        $login = Input::get('login');
        $password = Input::get('password');
        $analisi_log = Input::get('analisi_log');
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione_impianto = Input::get('ubicazione_impianto');

        $manutenzione = Input::get('manutenzione');



        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.SERVIZIWEB (Codice_R, CLIENTE, CLIENTE_FINALE, UBICAZIONE_IMPIANTO, TIPO_SERVIZIO, SERVER_,DIRECTORY,LOGIN, PASSWORD,ANALISI_LOG, ELIMINATO) VALUES ('$manutenzione','$cliente','$cliente_finale','$ubicazione_impianto','$tipo_servizio','$server','$directory','$login','$password','$analisi_log',$eliminato)");
            }
            else
                DB::update("UPDATE gsu.dbo.SERVIZIWEB SET Codice_R='$manutenzione', CLIENTE='$cliente', CLIENTE_FINALE='$cliente_finale', UBICAZIONE_IMPIANTO='$ubicazione_impianto', TIPO_SERVIZIO='$tipo_servizio', SERVER_='$server',DIRECTORY='$directory',LOGIN='$login',PASSWORD='$password',ANALISI_LOG='$analisi_log', ELIMINATO=$eliminato WHERE IDSERVIZIOWEB=$id");
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new ServiziWebModel();
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

