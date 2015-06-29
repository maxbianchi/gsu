<?php namespace App\Modules\Gsu\Models;

use App\Modules\Gsu\Utility;
use App\Utenti;
use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class GsuModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');
        $daattivare = Input::get('daattivare');
        $attivati = Input::get('attivati');
        $dadisattivare = Input::get('dadisattivare');
        $disattivati = Input::get('disattivati');

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
        LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)) AS SOGGETTO,
        LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)) AS CLIENTE,
        LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)) AS DESTINATARIOABITUALE,
        ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU
        FROM
        gsu.dbo.RICHIESTE_EVASE
        RIGHT OUTER JOIN UNIWEB.dbo.AOF70 RICHIESTE ON RICHIESTE_EVASE.CODICE_R = RICHIESTE.MANUTENZIONE
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA1 ON RICHIESTE.SOGGETTO = ANAGRAFICA1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA2 ON RICHIESTE.CLIENTE = ANAGRAFICA2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA3 ON RICHIESTE.DESTINATARIOABITUALE = ANAGRAFICA3.SOGGETTO
        WHERE (NOT ( RICHIESTE.OGGETTO LIKE 'TRF%') AND NOT ( RICHIESTE.OGGETTO LIKE 'OR%') AND NOT ( RICHIESTE.OGGETTO LIKE 'NR%') AND NOT ( RICHIESTE.OGGETTO = '' ))
EOF;

        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";

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
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione = Input::get('ubicazione');
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');
        $descrizione = Input::get('descrizione');
        $descrizione2 = Input::get('descrizione2');
        $daattivare = Input::get('daattivare');
        $attivati = Input::get('attivati');
        $dadisattivare = Input::get('dadisattivare');
        $disattivati = Input::get('disattivati');


        $sql = <<<EOF
        SELECT RICHIESTE.STATO,
        RICHIESTE.MANUTENZIONE,
        RICHIESTE_EVASE.CODICE_R,
		CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
        RICHIESTE.OGGETTO CANONE,
        RICHIESTE.DESCRIZIONE AS DESCRCANONE,
        RICHIESTE.DESCRIZIONE2 AS DESCRCANONE2,
        RICHIESTE.QUANTITA AS QTAAOF70,
        LTRIM(RTRIM(ANAGRAFICA1.DESCRIZIONE)) AS SOGGETTO,
        LTRIM(RTRIM(ANAGRAFICA2.DESCRIZIONE)) AS CLIENTE,
        LTRIM(RTRIM(ANAGRAFICA3.DESCRIZIONE)) AS DESTINATARIOABITUALE,
        ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU
        FROM
        gsu.dbo.RICHIESTE_EVASE
        RIGHT OUTER JOIN UNIWEB.dbo.AOF70 RICHIESTE ON RICHIESTE_EVASE.CODICE_R = RICHIESTE.MANUTENZIONE
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA1 ON RICHIESTE.SOGGETTO = ANAGRAFICA1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA2 ON RICHIESTE.CLIENTE = ANAGRAFICA2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 ANAGRAFICA3 ON RICHIESTE.DESTINATARIOABITUALE = ANAGRAFICA3.SOGGETTO
        WHERE (NOT ( RICHIESTE.OGGETTO LIKE 'TRF%') AND NOT ( RICHIESTE.OGGETTO LIKE 'OR%') AND NOT ( RICHIESTE.OGGETTO LIKE 'NR%') AND NOT ( RICHIESTE.OGGETTO = '' ))
EOF;

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
        if(!empty($descrizione))
            $sql .= " AND RICHIESTE.DESCRIZIONE like '%$descrizione%'";
        if(!empty($descrizione2))
            $sql .= " AND RICHIESTE.DESCRIZIONE2 like '%$descrizione2%'";

        if(!empty($data_contratto)) {
            $data_contratto = explode("-", $data_contratto);
            $data_contratto = $data_contratto[2]."-".$data_contratto[1]."-".$data_contratto[0];
            $sql .= " AND RICHIESTE.DATADOCUMENTO like '%$data_contratto%'";
        }

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
        $res = DB::select("SELECT DISTINCT DESCRIZIONE FROM UNIWEB.dbo.AGE10");

        foreach($res as $key => $value)
            foreach($value as $key2 => $value2)
                $result[] = utf8_encode($value2);
        return $result;
    }


    public function getAllAnagrafica(){
        $res = DB::select("SELECT * FROM UNIWEB.dbo.AGE10");
        return $res;
    }

    public function getAnagraficaByName(){
        $q = Input::get('term');
        $res = DB::select("SELECT DISTINCT DESCRIZIONE FROM UNIWEB.dbo.AGE10 WHERE DESCRIZIONE like '%$q%'");
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

