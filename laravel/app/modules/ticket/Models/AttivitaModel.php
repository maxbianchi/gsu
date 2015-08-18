<?php namespace App\Modules\Ticket\Models;

use App\Modules\Gsu\Utility;
use App\Utenti;
use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class AttivitaModel extends Model {

   public function getAllTecnici(){
       $sql = "SELECT * FROM GSU.dbo.TECNICI ORDER BY DESCRIZIONE";
       $request  = DB::select($sql);
       return $request;
   }

    public function getAllStati(){
        $sql = "SELECT * FROM GSU.dbo.STATI ORDER BY IDSTATO";
        $request  = DB::select($sql);
        return $request;
    }

    public function generateIDAttivita(){
        $sql = "SELECT MAX(IDATTIVITA) IDATTIVITA FROM gsu.dbo.ATTIVITA";
        $request  = DB::select($sql);
        $date = date("Ymd");
        if(isset($request[0]['IDATTIVITA'])) {
            $request = $request[0]['IDATTIVITA'];
            $idattivita = substr_replace($request, "", strlen($request) - 2);
            if($date == $idattivita){
                $idattivita = substr($request, strlen($request) - 2, strlen($request));
                $idattivita++;
                if($idattivita < 10)
                    $idattivita = "0".$idattivita;
                $date .= $idattivita;
            }else{
                $date .= "01";
            }

        }else{
            $date .= "01";
        }
        return $date;
    }

    public function salvaattivita(){
        $idattivita = Input::get("idattivita");
        $descrizione = Input::get("attivita");
        $descrizione = str_replace("'", "",$descrizione);
        $tempo = Input::get("tempo");
        $incaricoa = Input::get("incaricoa_attivita");
        $inseritoil = date('Y-m-d H:i:s');
        $sql = "INSERT INTO GSU.dbo.SINGOLE_ATTIVITA (idattivita, descrizione, tempo, incaricoa, inseritoil) VALUES ('$idattivita', '$descrizione', '$tempo', '$incaricoa', '$inseritoil' )";
        DB::insert($sql);
    }

    public function salvaticket(){
        $idattivita = Input::get("idattivita");
        $tickettelecom = Input::get("tickettelecom");
        $apertoda = Input::get("apertoda");
        $incaricoa = Input::get("incaricoa");
        $tgu = Input::get("tgu");
        $titolo = Input::get("titolo");
        $titolo = str_replace("'", "",$titolo);
        $motivo = Input::get("motivo");
        $motivo = str_replace("'", "",$motivo);
        $stato = Input::get("stato");
        $soggetto = Input::get("cliente");
        $ubicazione = Input::get("ubicazione_impianto");
        $apertail = date('Y-m-d H:i:s');
        $email = Input::get("email");

        $sql = "SELECT * FROM GSU.dbo.ATTIVITA where IDATTIVITA=$idattivita";
        $request  = DB::select($sql);
        if(count($request) == 0) {
            $sql = "INSERT INTO GSU.dbo.ATTIVITA (idattivita, tickettelecom, apertoda, incaricoa, tgu, titolo, motivo, stato, soggetto, ubicazione, apertail, email) VALUES ('$idattivita', '$tickettelecom', '$apertoda', '$incaricoa','$tgu', '$titolo','$motivo', '$stato', '$soggetto', '$ubicazione', '$apertail', '$email' )";
            DB::insert($sql);
        }
        else {
            $sql = "UPDATE GSU.dbo.ATTIVITA SET tickettelecom='$tickettelecom', apertoda='$apertoda', incaricoa='$incaricoa', tgu='$tgu', titolo='$titolo', motivo='$motivo', stato='$stato', soggetto='$soggetto', ubicazione='$ubicazione', apertail='$apertail', email='$email' WHERE idattivita='$idattivita'";
            DB::update($sql);
        }

    }


    public function getTickets(){
        $soggetto = Input::get("soggetto");
        $stato = Input::get("stato");
        $tecnico = Input::get("tecnico");
        $tgu = Input::get("tgu");
        $tickettelecom = Input::get("tickettelecom");

        $sql =<<<EOF
SELECT
        A.IDATTIVITA,
        TICKETTELECOM,
        T1.DESCRIZIONE APERTODA,
        T2.DESCRIZIONE INCARICOA,
        TGU,
        CONVERT(VARCHAR(10),A.APERTAIL,105 ) APERTAIL,
        CONVERT(VARCHAR(10),A.APERTAIL,108 ) APERTAIL_ORA,
        A.APERTODA IDAPERTODA,
        A.INCARICOA IDINCARICOA,
        TITOLO,
        MOTIVO,
        STATI.IDSTATO,
        STATI.STATO,
        A.SOGGETTO SOGGETTO_CODICE,
        A.UBICAZIONE DESTINATARIOABITUALE_CODICE,
        REPLACE(LTRIM(RTRIM(A1.DESCRIZIONE)),'''','') AS SOGGETTO_NOME,
        REPLACE(LTRIM(RTRIM(A2.DESCRIZIONE)),'''','') AS UBICAZIONE,
        A1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
        A1.LOCALITA		AS SOGGETTO_LOCALITA,
        A1.PROVINCIA		AS SOGGETTO_PROVINCIA,
        A1.EMAIL,
        A2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
        A2.LOCALITA		AS CLIENTE_LOCALITA,
        A2.PROVINCIA		AS CLIENTE_PROVINCIA,
        A.SOGGETTO,
        A.UBICAZIONE,
        S.DESCRIZIONE,
        T3.DESCRIZIONE INCARICOA_ATTIVITA,
        S.TEMPO,
        CONVERT(VARCHAR(10),S.INSERITOIL,105 ) INSERITOIL
        FROM GSU.dbo.ATTIVITA A LEFT JOIN SINGOLE_ATTIVITA S ON A.IDATTIVITA = S.IDATTIVITA
        LEFT JOIN STATI ON A.STATO = STATI.IDSTATO
        LEFT JOIN TECNICI T1 ON A.apertoda = T1.IDTECNICO
        LEFT JOIN TECNICI T2 ON A.incaricoa = T2.IDTECNICO
		LEFT JOIN TECNICI T3 ON S.incaricoa = T3.IDTECNICO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON A.SOGGETTO = A1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON A.UBICAZIONE = A2.SOGGETTO
        WHERE 1 = 1
EOF;
      if(!empty($soggetto))
          $sql .= " AND A.SOGGETTO = $soggetto";
      if(!empty($stato))
          $sql .= " AND A.STATO = $stato";
      if(!empty($tecnico))
          $sql .= " AND A.INCARICOA = $tecnico";
      if(!empty($tgu))
          $sql .= " AND A.TGU = $tgu";
      if(!empty($tickettelecom))
          $sql .= " AND A.TICKETTELECOM = $tickettelecom";

      $request = DB::select($sql);
      return $request;

    }

}

