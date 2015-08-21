<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class CmsModel extends Model {

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
            WEBHAT.IDWEBHAT,
			WEBHAT.SERVIZIO,
			WEBHAT.INDIRIZZO,
			WEBHAT.TIPO_ACCOUNT,
			WEBHAT.USERNAME,
			WEBHAT.PASSWORD,
			WEBHAT.CODICE_R,
			WEBHAT.STATS,
			WEBHAT.E_COMMERCE,
			WEBHAT.NEWSLETTER,
			WEBHAT.NEWS,
			WEBHAT.CALENDARIO,
			WEBHAT.BANNER,
			WEBHAT.ADDRESS,
			WEBHAT.DOWNLOAD,
			WEBHAT.PHP,
			WEBHAT.FORUM,
			WEBHAT.GENERACTION,
			WEBHAT.FAQ,
			WEBHAT.IMMOBILIARE,
			WEBHAT.MAGAZINE,
			WEBHAT.MOTORE_RICERCA,
			WEBHAT.ON_LINE_USERS,
			WEBHAT.SMS,
			WEBHAT.SONDAGGIO,
			WEBHAT.FOTO_GALLERY,
			WEBHAT.LIVE_HELP_MESSENGER,
			WEBHAT.SPIDER_MAKER_VERIFIER,
			WEBHAT.TUTTI,
			WEBHAT.SERVER_,
			WEBHAT.ELIMINATO
			FROM		gsu.dbo.WEBHAT
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON WEBHAT.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE WEBHAT.ELIMINATO = 0
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
        $servizio = Input::get('servizio');
        $indirizzo = Input::get('indirizzo');
        $tipo_account = Input::get('tipo_account');
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
            WEBHAT.IDWEBHAT,
			WEBHAT.SERVIZIO,
			WEBHAT.INDIRIZZO,
			WEBHAT.TIPO_ACCOUNT,
			WEBHAT.USERNAME,
			WEBHAT.PASSWORD,
			WEBHAT.CODICE_R,
			WEBHAT.STATS,
			WEBHAT.E_COMMERCE,
			WEBHAT.NEWSLETTER,
			WEBHAT.NEWS,
			WEBHAT.CALENDARIO,
			WEBHAT.BANNER,
			WEBHAT.ADDRESS,
			WEBHAT.DOWNLOAD,
			WEBHAT.PHP,
			WEBHAT.FORUM,
			WEBHAT.GENERACTION,
			WEBHAT.FAQ,
			WEBHAT.IMMOBILIARE,
			WEBHAT.MAGAZINE,
			WEBHAT.MOTORE_RICERCA,
			WEBHAT.ON_LINE_USERS,
			WEBHAT.SMS,
			WEBHAT.SONDAGGIO,
			WEBHAT.FOTO_GALLERY,
			WEBHAT.LIVE_HELP_MESSENGER,
			WEBHAT.SPIDER_MAKER_VERIFIER,
			WEBHAT.TUTTI,
			WEBHAT.SERVER_,
			WEBHAT.ELIMINATO
			FROM		gsu.dbo.WEBHAT
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON WEBHAT.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND WEBHAT.IDWEBHAT = '$id'";
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

        if(!empty($servizio))
            $sql .= " AND WEBHAT.SERVIZIO like '%$servizio%'";
        if(!empty($indirizzo))
            $sql .= " AND WEBHAT.INDIRIZZO like '%$indirizzo%'";
        if(!empty($tipo_account))
            $sql .= " AND WEBHAT.TIPO_ACCOUNT like '%$tipo_account%'";

        if(!empty($eliminati))
            $sql .= " AND WEBHAT.ELIMINATO = 1";
        else
            $sql .= " AND WEBHAT.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');

        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.WEBHAT SET ELIMINATO=1 WHERE IDWEBHAT='$id'";
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
        $password = Input::get('password');
        $manutenzione = Input::get('manutenzione');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $servizio = Input::get('servizio');
        $indirizzo = Input::get('indirizzo');
        $tipo_account = Input::get('tipo_account');
        $username = Input::get('username');
        $password = Input::get('password');
        $stats = Input::get('stats');
        $e_commerce = Input::get('e_commerce');
        $newsletter = Input::get('newsletter');
        $news = Input::get('news');
        $calendario = Input::get('calendario');
        $banner = Input::get('banner');
        $address = Input::get('address');
        $download = Input::get('download');
        $php = Input::get('php');
        $forum = Input::get('forum');
        $generaction = Input::get('generaction');
        $faq = Input::get('faq');
        $immobiliare = Input::get('immobiliare');
        $magazine = Input::get('magazine');
        $motore_ricerca = Input::get('motore_ricerca');
        $on_line_users = Input::get('on_line_users');
        $sms = Input::get('sms');
        $sondaggio = Input::get('sondaggio');
        $foto_gallery = Input::get('foto_gallery');
        $live_help_messenger = Input::get('live_help_messenger');
        $spider_maker_verifier = Input::get('spider_maker_verifier');
        $tutti = Input::get('tutti');
        $server = Input::get('server');


        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.WEBHAT (Codice_R, SERVIZIO,INDIRIZZO,TIPO_ACCOUNT,USERNAME,PASSWORD,STATS,E_COMMERCE,NEWSLETTER,NEWS,CALENDARIO,BANNER,ADDRESS,DOWNLOAD,PHP,FORUM,GENERACTION,FAQ,IMMOBILIARE,MAGAZINE,MOTORE_RICERCA,ON_LINE_USERS,SMS,SONDAGGIO,FOTO_GALLERY,LIVE_HELP_MESSENGER,SPIDER_MAKER_VERIFIER,TUTTI,SERVER_,ELIMINATO) VALUES ('$manutenzione','$servizio','$indirizzo','$tipo_account','$username','$password','$stats','$e_commerce','$newsletter','$news','$calendario','$banner','$address','$download','$php','$forum','$generaction','$faq','$immobiliare','$magazine','$motore_ricerca','$on_line_users','$sms','$sondaggio','$foto_gallery','$live_help_messenger','$spider_maker_verifier','$tutti','$server',$eliminato)");
                $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
                $richieste_evase = DB::select($sql);
                if(count($richieste_evase) > 0) {
                    $richieste_evase = $richieste_evase[0];
                    //$qta = $richieste_evase['QUANTITA'] + 1;
                    //DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
                }
                else{
                    DB::insert("INSERT INTO gsu.dbo.RICHIESTE_EVASE (CODICE_R, QUANTITA) VALUES ('$manutenzione','1')");
                }
            }
            else
                DB::update("UPDATE gsu.dbo.WEBHAT SET Codice_R='$manutenzione', SERVIZIO='$servizio',INDIRIZZO='$indirizzo',TIPO_ACCOUNT='$tipo_account',USERNAME='$username',PASSWORD='$password',STATS='$stats',E_COMMERCE='$e_commerce',NEWSLETTER='$newsletter',NEWS='$news',CALENDARIO='$calendario',BANNER='$banner',ADDRESS='$address',DOWNLOAD='$download',PHP='$php',FORUM='$forum',GENERACTION='$generaction',FAQ='$faq',IMMOBILIARE='$immobiliare',MAGAZINE='$magazine',MOTORE_RICERCA='$motore_ricerca',ON_LINE_USERS='$on_line_users',SMS='$sms',SONDAGGIO='$sondaggio',FOTO_GALLERY='$foto_gallery',LIVE_HELP_MESSENGER='$live_help_messenger',SPIDER_MAKER_VERIFIER='$spider_maker_verifier',TUTTI='$tutti',SERVER_='$server',ELIMINATO=$eliminato WHERE IDWEBHAT=$id");
                if($stato_precedente == 1 && $eliminato == 0){
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
                }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new CmsModel();
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
            //if ($res[0]['QTAAOF70'] > $res[0]['QTAGSU'])
                Input::merge(array('add' => '1'));
        }
    }

}

