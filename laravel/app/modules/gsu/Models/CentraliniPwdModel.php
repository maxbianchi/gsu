<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class CentraliniPwdModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');
        $prodotto = Input::get('prodotto');

        $sql = <<<EOF
        SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			LTRIM(RTRIM(anagrafica1.DESCRIZIONE))		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			LTRIM(RTRIM(anagrafica2.DESCRIZIONE))	AS CLIENTE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			LTRIM(RTRIM(anagrafica3.DESCRIZIONE))	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
            CENTRALINI_PASSWORD.IDPASSWORD,
            CENTRALINI_PASSWORD.GRUPPOCENTRALINO,
            CENTRALINI_PASSWORD.TIPOPASSWORD,
            CENTRALINI_PASSWORD.PRODUTTORE,
            CENTRALINI_PASSWORD.ACCESSO,
            CENTRALINI_PASSWORD.USERNAME,
            CENTRALINI_PASSWORD.PWD,
            CENTRALINI_PASSWORD.PWD_PRIVILEGIATA,
            CENTRALINI_PASSWORD.NOTE,
            CENTRALINI_PASSWORD.CODICE_R,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_R,105) DATA_R,
            CENTRALINI_PASSWORD.OGGETTO,
            CENTRALINI_PASSWORD.ELIMINATO
			FROM		gsu.dbo.CENTRALINI
			INNER JOIN CENTRALINI_PASSWORD ON CENTRALINI.IDCENTRALINO = CENTRALINI_PASSWORD.GRUPPOCENTRALINO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(CENTRALINI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(CENTRALINI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(CENTRALINI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE CENTRALINI_PASSWORD.ELIMINATO = 0
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

        $id = Input::get('apparato_id');
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione = Input::get('ubicazione');
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
			LTRIM(RTRIM(anagrafica1.DESCRIZIONE))		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.CAP		        AS SOGGETTO_CAP,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			ISNULL(anagrafica1.PARTITAIVA,anagrafica1.CODICEFISCALE) AS SOGGETTO_PIVA,

            anagrafica2.SOGGETTO        AS CLIENTE_CODICE,
			LTRIM(RTRIM(anagrafica2.DESCRIZIONE))	    AS CLIENTE,
			anagrafica2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
            anagrafica2.CAP		        AS CLIENTE_CAP,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			ISNULL(anagrafica2.PARTITAIVA,anagrafica2.CODICEFISCALE) AS CLIENTE_PIVA,

            anagrafica3.SOGGETTO        AS DESTINATARIOABITUALE_CODICE,
			LTRIM(RTRIM(anagrafica3.DESCRIZIONE))	    AS DESTINATARIOABITUALE,
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
            CENTRALINI_PASSWORD.IDPASSWORD,
            CENTRALINI_PASSWORD.GRUPPOCENTRALINO,
            CENTRALINI_PASSWORD.TIPOPASSWORD,
            CENTRALINI_PASSWORD.PRODUTTORE,
            CENTRALINI_PASSWORD.ACCESSO,
            CENTRALINI_PASSWORD.USERNAME,
            CENTRALINI_PASSWORD.PWD,
            CENTRALINI_PASSWORD.PWD_PRIVILEGIATA,
            CENTRALINI_PASSWORD.NOTE,
            CENTRALINI_PASSWORD.CODICE_R,
            CONVERT(VARCHAR(10),CENTRALINI.DATA_R,105) DATA_R,
            CENTRALINI_PASSWORD.OGGETTO,
            CENTRALINI_PASSWORD.ELIMINATO
			FROM		gsu.dbo.CENTRALINI
			INNER JOIN CENTRALINI_PASSWORD ON CENTRALINI.IDCENTRALINO = CENTRALINI_PASSWORD.GRUPPOCENTRALINO
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON CENTRALINI.codice_r				= richieste.MANUTENZIONE
		    LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON ISNULL(CENTRALINI.SOGGETTO, richieste.SOGGETTO)				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON ISNULL(CENTRALINI.CLIENTE, richieste.CLIENTE)				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON ISNULL(CENTRALINI.DESTINATARIOABITUALE, richieste.DESTINATARIOABITUALE)	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        $sql .= " AND CENTRALINI_PASSWORD.GRUPPOCENTRALINO = $id";

        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND ANAGRAFICA2.DESCRIZIONE like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND ANAGRAFICA3.DESCRIZIONE like '%$ubicazione%'";


        if(!empty($eliminati))
            $sql .= " AND CENTRALINI_PASSWORD.ELIMINATO = 1";
        else
            $sql .= " AND CENTRALINI_PASSWORD.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.CENTRALINI_PASSWORD SET ELIMINATO=1 WHERE IDPASSWORD='$id'";
            DB::update($sql);
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
        $tipopassword = Input::get('tipopassword');
        $produttore = Input::get('produttore');
        $accesso = Input::get('accesso');
        $username = Input::get('username');
        $pwd = Input::get('pwd');
        $pwdprivilegiata = Input::get('pwdprivilegiata');
        $note = Input::get('note');
        $apparato_id = Input::get('apparato_id');

        try {
            if(empty($id)) {
                DB::insert("insert into CENTRALINI_PASSWORD (GRUPPOCENTRALINO,SOGGETTO,CLIENTE,DESTINATARIOABITUALE,DATA_R,TIPOPASSWORD,PRODUTTORE,ACCESSO,USERNAME,PWD,PWD_PRIVILEGIATA,NOTE,ELIMINATO) values ('$apparato_id','$soggetto','$cliente','$destinatarioabituale','$data_r','$tipopassword','$produttore','$accesso','$username','$pwd','$pwdprivilegiata','$note',$eliminato)");
            }
            else
                DB::update("Update CENTRALINI_PASSWORD Set GRUPPOCENTRALINO='$apparato_id', SOGGETTO='$soggetto',CLIENTE='$cliente',DESTINATARIOABITUALE='$destinatarioabituale', DATA_R = '$data_r', TIPOPASSWORD = '$tipopassword', PRODUTTORE = '$produttore', ACCESSO = '$accesso', USERNAME = '$username', PWD = '$pwd', PWD_PRIVILEGIATA = '$pwdprivilegiata',NOTE='$note', ELIMINATO = $eliminato WHERE IDPASSWORD=$id");
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


