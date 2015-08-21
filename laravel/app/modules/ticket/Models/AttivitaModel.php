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

    public function getTecnico(){
        $idtecnico = Input::get('incaricoa');
        $sql = "SELECT * FROM GSU.dbo.TECNICI WHERE IDTECNICO=$idtecnico";
        $request  = DB::select($sql);
        return $request[0]['DESCRIZIONE'];
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
        $id = Input::get("id");
        if(empty($id)) {
            $sql = "INSERT INTO GSU.dbo.SINGOLE_ATTIVITA (idattivita, descrizione, tempo, incaricoa, inseritoil) VALUES ('$idattivita', '$descrizione', '$tempo', '$incaricoa', '$inseritoil' )";
            DB::insert($sql);
        }
        else{
            $sql = "UPDATE GSU.dbo.SINGOLE_ATTIVITA SET descrizione='$descrizione', tempo='$tempo', incaricoa='$incaricoa' WHERE IDATTIVITA=$idattivita AND ID=$id";
            DB::update($sql);
        }

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
            $sql = "INSERT INTO GSU.dbo.ATTIVITA (idattivita, TICKETTELECOM, apertoda, incaricoa, tgu, titolo, motivo, stato, soggetto, ubicazione, apertail, email) VALUES ('$idattivita', '$tickettelecom', '$apertoda', '$incaricoa','$tgu', '$titolo','$motivo', '$stato', '$soggetto', '$ubicazione', '$apertail', '$email' )";
            DB::insert($sql);
        }
        else {
            $sql = "UPDATE GSU.dbo.ATTIVITA SET TICKETTELECOM='$tickettelecom', apertoda='$apertoda', incaricoa='$incaricoa', tgu='$tgu', titolo='$titolo', motivo='$motivo', stato='$stato', soggetto='$soggetto', ubicazione='$ubicazione', apertail='$apertail', email='$email' WHERE idattivita='$idattivita'";
            DB::update($sql);
        }

    }


    public function getTickets(){
        $soggetto = Input::get("soggetto");
        $stato = Input::get("stato");
        $tecnico = Input::get("tecnico");
        $tgu = Input::get("tgu");
        $tickettelecom = Input::get("tickettelecom");
        $idattivita = Input::get('idattivita');

        $sql =<<<EOF
SELECT
        A.IDATTIVITA,
        TICKETTELECOM,
        T1.DESCRIZIONE APERTODA,
        T2.DESCRIZIONE INCARICOA,
        TGU,
        CONVERT(VARCHAR(10),A.APERTAIL,105 ) APERTAIL,
        CONVERT(VARCHAR(10),A.APERTAIL,108 ) APERTAIL_ORA,
        CONVERT(VARCHAR(10),A.CHIUSAIL,105 ) CHIUSAIL,
        CONVERT(VARCHAR(10),A.CHIUSAIL,108 ) CHIUSAIL_ORA,
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
        A.EMAIL,
        A2.INDIRIZZO		AS CLIENTE_INDIRIZZO,
        A2.LOCALITA		AS CLIENTE_LOCALITA,
        A2.PROVINCIA		AS CLIENTE_PROVINCIA,
        A.SOGGETTO,
        A.UBICAZIONE,
        S.DESCRIZIONE,
        T3.DESCRIZIONE INCARICOA_ATTIVITA,
        S.TEMPO,
        CONVERT(VARCHAR(10),S.INSERITOIL,105 ) INSERITOIL,
        CONVERT(VARCHAR(10),S.INSERITOIL,108 ) INSERITOIL_ORA
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
      if(!empty($idattivita))
          $sql .= " AND A.IDATTIVITA = $idattivita";

      $request = DB::select($sql);
      return $request;

    }

    public function getEmailCliente(){
        $cliente = Input::get('cliente');
        $sql = "SELECT EMAIL FROM UNIWEB.dbo.AGE10 A1 WHERE SOGGETTO='$cliente'";
        $res = DB::select($sql);
        return json_encode($res);
    }

    public function getStato($stato_int){
        $sql = "SELECT STATO FROM STATI WHERE IDSTATO=$stato_int";
        $res = DB::select($sql);
        $stato_text = $res[0]['STATO'];
        return $stato_text;
    }

    public function chiudiTicket(){
        $idattivita = Input::get('idattivita');
        $chiusail = date('Y-m-d H:i:s');
        $sql = "UPDATE ATTIVITA SET STATO = 4, CHIUSAIL='$chiusail' WHERE IDATTIVITA=$idattivita";
        DB::update($sql);
    }

    public function getAttivita(){
        $idattivita =  Input::get('idattivita');
        $sql = "SELECT * FROM SINGOLE_ATTIVITA WHERE IDATTIVITA='$idattivita' ORDER BY ID";
        $res = DB::select($sql);
        return $res;
    }

    public function salvaVerbalino(){
        $idattivita = Input::get('idattivita');
        $cliente = Input::get('cliente');
        $ubicazione = Input::get('ubicazione');
        $riferimento = Input::get('riferimento');
        $telefono = Input::get('telefono');
        $email = Input::get('email');
        $matricola = Input::get('matricola');
        $modello = Input::get('modello');
        $tot_bn = Input::get('tot_bn');
        $tot_colore = Input::get('tot_colore');
        $motivo = Input::get('motivo');
        $motivo = str_replace("'", "",$motivo);
        $descrizione = Input::get('descrizione');
        $descrizione = str_replace("'", "",$descrizione);
        $codice1 = Input::get('codice1');
        $descrizione1 = Input::get('descrizione1');
        $descrizione1 = str_replace("'", "",$descrizione1);
        $qta1 = Input::get('qta1');
        $note1 = Input::get('note1');
        $note1 = str_replace("'", "",$note1);
        $codice2 = Input::get('codice2');
        $descrizione2 = Input::get('descrizione2');
        $descrizione2 = str_replace("'", "",$descrizione2);
        $qta2 = Input::get('qta2');
        $note2 = Input::get('note2');
        $note2 = str_replace("'", "",$note2);
        $codice3 = Input::get('codice3');
        $descrizione3 = Input::get('descrizione3');
        $descrizione3 = str_replace("'", "",$descrizione3);
        $qta3 = Input::get('qta3');
        $note3 = Input::get('note3');
        $note3 = str_replace("'", "",$note3);
        $data_intervento = Input::get('data_intervento');
        $intervento_remoto = isset($_POST['intervento_remoto']) ? 1 : 0;
        $tempo = Input::get('tempo');
        $tempo_viaggio = Input::get('tempo_viaggio');
        $ora_inizio = Input::get('ora_inizio');
        $ora_fine = Input::get('ora_fine');
        $tempo_viaggio2 = Input::get('tempo_viaggio2');
        $ora_inizio2 = Input::get('ora_inizio2');
        $ora_fine2 = Input::get('ora_fine2');
        $note = Input::get('note');
        $note = str_replace("'", "",$note);
        $intervento_risolutivo = isset($_POST['intervento_risolutivo_si']) ? 1 : 0;
        $garanzia = isset($_POST['garanzia_si'])  ? 1 : 0;
        $macchina_funzione = isset($_POST['macchina_funzione_si']) ? 1 : 0;
        $incaricoa = Input::get('incaricoa');

        $sql = "SELECT * FROM VERBALINI WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        if(count($res) == 0) {
            $sql = "INSERT INTO VERBALINI (IDATTIVITA,CLIENTE,UBICAZIONE,RIFERIMENTO,TELEFONO,EMAIL,MATRICOLA,MODELLO,LETTURA_BN,LETTURA_COLORE,MOTIVO,DESCRIZIONE,CODICE_1,DESCRIZIONE_1,QTA_1,NOTE_1,CODICE_2,DESCRIZIONE_2,QTA_2,NOTE_2,CODICE_3,DESCRIZIONE_3,QTA_3,NOTE_3,DATA_INTERVENTO,INTERVENTO_REMOTO,TEMPO_TOTALE,TEMPO_VIAGGIO_1,ORA_INIZIO_1,ORA_FINE_1,TEMPO_VIAGGIO_2,ORA_INIZIO_2,ORA_FINE_2,NOTE,INTERVENTO_RISOLUTIVO,IN_GARANZIA,MACCHINA_FUNZIONE,TECNICO) VALUES ('$idattivita','$cliente','$ubicazione','$riferimento','$telefono','$email','$matricola','$modello','$tot_bn','$tot_colore','$motivo','$descrizione','$codice1','$descrizione1','$qta1','$note1','$codice2','$descrizione2','$qta2','$note2','$codice3','$descrizione3','$qta3','$note3','$data_intervento','$intervento_remoto','$tempo','$tempo_viaggio','$ora_inizio','$ora_fine','$tempo_viaggio2','$ora_inizio2','$ora_fine2','$note','$intervento_risolutivo','$garanzia','$macchina_funzione','$incaricoa')";
            DB::insert($sql);
        } else {
            $sql = "UPDATE VERBALINI SET CLIENTE='$cliente',UBICAZIONE='$ubicazione',RIFERIMENTO='$riferimento',TELEFONO='$telefono',EMAIL='$email',MATRICOLA='$matricola',MODELLO='$modello',LETTURA_BN='$tot_bn',LETTURA_COLORE='$tot_colore',MOTIVO='$motivo',DESCRIZIONE='$descrizione',CODICE_1='$codice1',DESCRIZIONE_1='$descrizione1',QTA_1='$qta1',NOTE_1='$note1',CODICE_2='$codice2',DESCRIZIONE_2='$descrizione2',QTA_2='$qta2',NOTE_2='$note2',CODICE_3='$codice3',DESCRIZIONE_3='$descrizione3',QTA_3='$qta3',NOTE_3='$note3',DATA_INTERVENTO='$data_intervento',INTERVENTO_REMOTO='$intervento_remoto',TEMPO_TOTALE='$tempo',TEMPO_VIAGGIO_1='$tempo_viaggio',ORA_INIZIO_1='$ora_inizio',ORA_FINE_1='$ora_fine',TEMPO_VIAGGIO_2='$tempo_viaggio2',ORA_INIZIO_2='$ora_inizio2',ORA_FINE_2='$ora_fine2',NOTE='$note',INTERVENTO_RISOLUTIVO='$intervento_risolutivo',IN_GARANZIA='$garanzia',MACCHINA_FUNZIONE='$macchina_funzione',TECNICO='$incaricoa' WHERE IDATTIVITA = '$idattivita'";
            DB::update($sql);
        }

    }

}

