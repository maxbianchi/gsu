<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class CaselleModel extends Model {

    public function getAllRequest(){

        $canone = Input::get('canone');
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));

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
            CASELLE.IDCASELLA,
			CASELLE.ACCOUNT,
			CASELLE.PASSWORD,
			CASELLE.MEGABYTE,
			CASELLE.TIPO,
			CASELLE.CODICE_R,
			CASELLE.EMAIL,
			CASELLE.ELIMINATO
			FROM		gsu.dbo.CASELLE
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON CASELLE.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
            LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE CASELLE.ELIMINATO = 0
EOF;

        if(!empty($canone))
            $sql .= " AND richieste.OGGETTO like '%$canone%'";
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
        $account = Input::get('account');
        $email = Input::get('email');
        $megabyte = Input::get('megabyte');
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
            CASELLE.IDCASELLA,
			CASELLE.ACCOUNT,
			CASELLE.EMAIL,
			CASELLE.PASSWORD,
			CASELLE.MEGABYTE,
			CASELLE.TIPO,
			CASELLE.CODICE_R,
			CASELLE.TIPO_UTENTE,
            CASELLE.POP3,
			CASELLE.SMTP,
			CASELLE.NOTE,
			CASELLE.ALIAS_1,
			CASELLE.ALIAS_2,
			CASELLE.ALIAS_3,
			CASELLE.ALIAS_4,
			CASELLE.ALIAS_5,
			CASELLE.ALIAS_6,
			CASELLE.ALIAS_7,
			CASELLE.ALIAS_8,
            CASELLE.ALIAS_9,
            CASELLE.ALIAS_10,
            CASELLE.ALIAS_11,
            CASELLE.ALIAS_12,
            CASELLE.FORWARD,
            CASELLE.COPIA,
            CASELLE.ELIMINATO
			FROM		gsu.dbo.CASELLE
			LEFT OUTER JOIN			UNIWEB.dbo.AOF70	richieste	ON CASELLE.codice_r				= richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE 1=1
EOF;

        if(!empty($id))
            $sql .= " AND CASELLE.IDCASELLA = '$id'";
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

        if(!empty($account))
            $sql .= " AND CASELLE.ACCOUNT like '%$account%'";
        if(!empty($email))
            $sql .= " AND CASELLE.EMAIL like '%$email%'";
        if(!empty($megabyte))
            $sql .= " AND CASELLE.MEGABYTE like '%$megabyte%'";

        if(!empty($eliminati))
            $sql .= " AND CASELLE.ELIMINATO = 1";
        else
            $sql .= " AND CASELLE.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.CASELLE SET ELIMINATO=1 WHERE IDCASELLA='$id'";
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

        $tipo_utente = Input::get('tipo_utente');
        $tipo_casella = Input::get('tipo');
        $megabyte = Input::get('megabyte');
        $account = Input::get('account');
        $password = Input::get('password');
        $email = Input::get('email');
        $pop3 = Input::get('pop3');
        $smtp = Input::get('smtp');
        $note = Input::get('note');
        $alias_1 = Input::get('alias_1');
        $alias_2 = Input::get('alias_2');
        $alias_3 = Input::get('alias_3');
        $alias_4 = Input::get('alias_4');
        $alias_5 = Input::get('alias_5');
        $alias_6 = Input::get('alias_6');
        $alias_7 = Input::get('alias_7');
        $alias_8 = Input::get('alias_8');
        $alias_9 = Input::get('alias_9');
        $alias_10 = Input::get('alias_10');
        $alias_11 = Input::get('alias_11');
        $alias_12 = Input::get('alias_12');
        $forward = Input::get('forward');
        $copia = Input::get('copia');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.CASELLE (Codice_R, TIPO_UTENTE, TIPO,MEGABYTE,ACCOUNT,PASSWORD,EMAIL,POP3,SMTP,NOTE,ALIAS_1,ALIAS_2,ALIAS_3,ALIAS_4,ALIAS_5,ALIAS_6,ALIAS_7,ALIAS_8,ALIAS_9,ALIAS_10,ALIAS_11,ALIAS_12,FORWARD,COPIA,ELIMINATO) VALUES ('$manutenzione','$tipo_utente','$tipo_casella','$megabyte','$account','$password','$email','$pop3','$smtp','$note','$alias_1','$alias_2','$alias_3','$alias_4','$alias_5','$alias_6','$alias_7','$alias_8','$alias_9','$alias_10','$alias_11','$alias_12','$forward','$copia',$eliminato)");
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
            else {
                DB::update("UPDATE gsu.dbo.CASELLE SET Codice_R='$manutenzione', TIPO_UTENTE='$tipo_utente', TIPO='$tipo_casella', MEGABYTE='$megabyte', ACCOUNT='$account', PASSWORD='$password',EMAIL='$email',POP3='$pop3',SMTP='$smtp',NOTE='$note',ALIAS_1='$alias_1',ALIAS_2='$alias_2',ALIAS_3='$alias_3',ALIAS_4='$alias_4',ALIAS_5='$alias_5',ALIAS_6='$alias_6',ALIAS_7='$alias_7',ALIAS_8='$alias_8',ALIAS_9='$alias_9',ALIAS_10='$alias_10',ALIAS_11='$alias_11',ALIAS_12='$alias_12',FORWARD='$forward',COPIA='$copia',ELIMINATO=$eliminato WHERE IDCASELLA=$id");
                if($stato_precedente == 1 && $eliminato == 0){
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
                }
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function checkAddNew(){
        $model = new CaselleModel();
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
            if ($res[0]['QTAAOF70'] > $res[0]['QTAGSU'] ||  $res[0]['TIPO'] == "Relay di Posta")
                Input::merge(array('add' => '1'));
        }
    }



    public function getActivesync($email){
        $sql = "SELECT * FROM ACTIVESYNC WHERE (EMAIL= '" . $email . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }

    public function getOutlookconnector($email){
        $sql = "SELECT * FROM OUTLOOKCONNECTOR WHERE (EMAIL= '" . $email . "')  AND ELIMINATO = 0";
        $res = DB::select($sql);
        if(count($res) > 0)
            return "SI";
        return "NO";
    }


}

