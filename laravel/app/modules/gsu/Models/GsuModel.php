<?php namespace App\Modules\Gsu\Models;

use App\Modules\Gsu\Utility;
use App\Utenti;
use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class GsuModel extends Model {

    public function getAllRequest(){
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $daattivare = Input::get('daattivare');
        $attivati = Input::get('attivati');
        $dadisattivare = Input::get('dadisattivare');
        $disattivati = Input::get('disattivati');
        $nrcontratto = Input::get('nrcontratto');

        $sql = <<<EOF
        SELECT
        RICHIESTE.STATO,
        RICHIESTE.MANUTENZIONE,
        RICHIESTE_EVASE.CODICE_R,
        CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
        RICHIESTE.OGGETTO CANONE,
        RICHIESTE.DESCRIZIONE AS DESCRCANONE,
        RICHIESTE.DESCRIZIONE2 AS DESCRCANONE2,
        RICHIESTE.QUANTITA AS QTAAOF70,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
        ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
        RICHIESTE.NRCONTRATTO,
        CONVERT(VARCHAR(10),RICHIESTE.DATASCADENZA,105) DATASCADENZA
        FROM
        gsu.dbo.RICHIESTE_EVASE
        RIGHT OUTER JOIN UNIWEB.dbo.AOF70 RICHIESTE ON RICHIESTE_EVASE.CODICE_R = RICHIESTE.MANUTENZIONE
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA1 ON RICHIESTE.SOGGETTO = ANAGRAFICA1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA2 ON RICHIESTE.CLIENTE = ANAGRAFICA2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA3 ON RICHIESTE.DESTINATARIOABITUALE = ANAGRAFICA3.SOGGETTO
        WHERE (NOT ( RICHIESTE.OGGETTO LIKE 'TRF%') AND NOT ( RICHIESTE.OGGETTO LIKE 'OR%') AND NOT ( RICHIESTE.OGGETTO LIKE 'NR%') AND NOT ( RICHIESTE.OGGETTO = '' ))
EOF;

        if(!empty($cliente))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') like '%$ubicazione%'";

        if(!empty($nrcontratto))
            $sql .= " AND RICHIESTE.NRCONTRATTO like '%$nrcontratto%'";

        $stati = [];
        if(!empty($daattivare))
            $stati[] = " (RICHIESTE.STATO = 'A' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) = 0 OR ISNULL(RICHIESTE_EVASE.QUANTITA, 0) < RICHIESTE.QUANTITA))";

        if(!empty($attivati))
            $stati[] = " (RICHIESTE.STATO = 'A' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) >=  RICHIESTE.QUANTITA))";

        if(!empty($dadisattivare))
            $stati[] = " (RICHIESTE.STATO = 'D' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) >  0))";

        if(!empty($disattivati))
            $stati[] = " (RICHIESTE.STATO = 'D' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) <=  0))";


        if(count($stati) > 0){
            $stati = implode(" OR ", $stati);
            $stati = " AND ( ".$stati." )";
            $sql .= $stati;
        }


        $sql .= " ORDER BY RICHIESTE.STATO, RICHIESTE_EVASE.QUANTITA";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){
        $cliente = trim(Input::get('cliente'));
        $cliente_finale = trim(Input::get('cliente_finale'));
        $ubicazione = trim(Input::get('ubicazione'));
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');
        $descrizione = Input::get('descrizione');
        $descrizione2 = Input::get('descrizione2');
        $daattivare = Input::get('daattivare');
        $attivati = Input::get('attivati');
        $dadisattivare = Input::get('dadisattivare');
        $disattivati = Input::get('disattivati');
        $nrcontratto = Input::get('nrcontratto');


        $sql = <<<EOF
        SELECT RICHIESTE.STATO,
        RICHIESTE.MANUTENZIONE,
        RICHIESTE_EVASE.CODICE_R,
		CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
        RICHIESTE.OGGETTO CANONE,
        RICHIESTE.DESCRIZIONE AS DESCRCANONE,
        RICHIESTE.DESCRIZIONE2 AS DESCRCANONE2,
        RICHIESTE.QUANTITA AS QTAAOF70,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)),'''','') AS SOGGETTO,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)),'''','') AS CLIENTE,
        REPLACE(LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)),'''','') AS DESTINATARIOABITUALE,
        ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
        RICHIESTE.NRCONTRATTO,
        CONVERT(VARCHAR(10),RICHIESTE.DATASCADENZA,105) DATASCADENZA
        FROM
        gsu.dbo.RICHIESTE_EVASE
        RIGHT OUTER JOIN UNIWEB.dbo.AOF70 RICHIESTE ON RICHIESTE_EVASE.CODICE_R = RICHIESTE.MANUTENZIONE
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA1 ON RICHIESTE.SOGGETTO = ANAGRAFICA1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA2 ON RICHIESTE.CLIENTE = ANAGRAFICA2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA3 ON RICHIESTE.DESTINATARIOABITUALE = ANAGRAFICA3.SOGGETTO
        WHERE (NOT ( RICHIESTE.OGGETTO LIKE 'TRF%') AND NOT ( RICHIESTE.OGGETTO LIKE 'OR%') AND NOT ( RICHIESTE.OGGETTO LIKE 'NR%') AND NOT ( RICHIESTE.OGGETTO = '' ))
EOF;

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
        if(!empty($descrizione))
            $sql .= " AND RICHIESTE.DESCRIZIONE like '%$descrizione%'";
        if(!empty($descrizione2))
            $sql .= " AND RICHIESTE.DESCRIZIONE2 like '%$descrizione2%'";

        if(!empty($data_contratto)) {
            $data_contratto = explode("-", $data_contratto);
            $data_contratto = $data_contratto[2]."-".$data_contratto[1]."-".$data_contratto[0];
            $sql .= " AND RICHIESTE.DATADOCUMENTO like '%$data_contratto%'";
        }

        if(!empty($nrcontratto))
            $sql .= " AND RICHIESTE.NRCONTRATTO like '%$nrcontratto%'";

        $stati = [];
        if(!empty($daattivare))
            $stati[] = " (RICHIESTE.STATO = 'A' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) = 0 OR ISNULL(RICHIESTE_EVASE.QUANTITA, 0) < RICHIESTE.QUANTITA))";

        if(!empty($attivati))
            $stati[] = " (RICHIESTE.STATO = 'A' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) >=  RICHIESTE.QUANTITA))";

        if(!empty($dadisattivare))
            $stati[] = " (RICHIESTE.STATO = 'D' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) >  0))";

        if(!empty($disattivati))
            $stati[] = " (RICHIESTE.STATO = 'D' AND (ISNULL(RICHIESTE_EVASE.QUANTITA, 0) <=  0))";


        if(count($stati) > 0){
            $stati = implode(" OR ", $stati);
            $stati = " AND ( ".$stati." )";
            $sql .= $stati;
        }


        $sql .= " ORDER BY RICHIESTE.STATO, RICHIESTE_EVASE.QUANTITA";

        $request  = DB::select($sql);
        return $request;


    }

    public function getNameAnagrafica(){
        $res = DB::select("SELECT DISTINCT LTRIM(RTRIM(DESCRIZIONE)) FROM UNIWEB.dbo.AGE10");

        foreach($res as $key => $value)
            foreach($value as $key2 => $value2)
                $result[] = utf8_encode($value2);
        return $result;
    }


    public function getAllAnagrafica(){
        $name = Input::get("search_anagrafica");
        $sql = "SELECT * FROM UNIWEB.dbo.AGE10";
        if(!empty($name))
            $sql .= " WHERE DESCRIZIONE like '%$name%'";

        $res = DB::select($sql);
        return $res;
    }

    public function getAnagraficaByName(){
        $q = Input::get('term');
        $res = DB::select("SELECT DISTINCT REPLACE(LTRIM(RTRIM(DESCRIZIONE)),'''','') AS DESCRIZIONE FROM UNIWEB.dbo.AGE10 WHERE DESCRIZIONE like '%$q%'");
        $result = "";
        foreach($res as $keys => $values){
            foreach($values as $key => $value)
                $result[] = trim($value);
        }
        return $result;
    }

    public function getClientiByRivenditore(){
        $q = Input::get('term');
        $soggetto = Session::get('user')['SOGGETTO'];
        $model = new Utenti();
        $res = $model->getAllRiferimenti($soggetto,$q);

        $result = "";
        foreach($res as $keys => $value){
            if(empty($value))
                continue;
            $result[] = trim($value['CLIENTE_FINALE']);
        }
        return $result;
    }

}

