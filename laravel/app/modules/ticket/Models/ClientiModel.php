<?php namespace App\Modules\Ticket\Models;

use App\Modules\Gsu\Utility;
use App\Utenti;
use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class ClientiModel extends Model {

   public function getAllStorico($idattivita){
       $sql = "SELECT *, CONVERT(VARCHAR(15),TICKET.dbo.STORICO.DATA,105) DATACAMBIOSTATO, CONVERT(VARCHAR(15),TICKET.dbo.STORICO.DATA,108) ORACAMBIOSTATO FROM TICKET.dbo.STORICO INNER JOIN TICKET.dbo.STATI ON TICKET.dbo.STORICO.IDSTATO = TICKET.dbo.STATI.IDSTATO WHERE TICKET.dbo.STORICO.IDATTIVITA='$idattivita' ORDER BY ID ASC";
       $request  = DB::select($sql);
       return $request;
   }

    public function getAttivita($idattivita){
        $sql = "SELECT *,CONVERT(VARCHAR(15),TICKET.dbo.ATTIVITA.APERTAIL,105) APERTAIL,CONVERT(VARCHAR(15),TICKET.dbo.ATTIVITA.APERTAIL,108) ORAAPERTAIL FROM TICKET.dbo.ATTIVITA WHERE IDATTIVITA='$idattivita'";
        $request  = DB::select($sql);
        return $request[0];
    }

    public function getAllUserFromMagoBySoggetto($soggetto){
        $soggetto = $soggetto['DESCRIZIONE'];
        $sql = "SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA, A.EMAIL,A.PARTITAIVA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE LIKE '%$soggetto%' ORDER BY DESCRIZIONE";
        $utenti  = DB::select($sql);
        $utente = [];
        foreach($utenti as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }

    public function salvaticket(){
        $idattivita = Input::get("idattivita");
        $tgu = Input::get("tgu");
        $titolo = Input::get("titolo");
        $titolo = str_replace("'", "",$titolo);
        $motivo = Input::get("motivo");
        $motivo = str_replace("'", "",$motivo);
        $stato = Input::get("stato");
        $soggetto = Input::get("soggetto");
        $ubicazione = Input::get("ubicazione_impianto");
        $apertail = date('Y-m-d H:i:s');
        $idcategoria = Input::get("categoria");
        $email = Input::get("email");
        $email_referente = Input::get("email_referente");
        $nome_referente = Input::get("nome_referente");
        $telefono_referente = Input::get("telefono_referente");


        $sql = "SELECT * FROM TICKET.dbo.ATTIVITA where IDATTIVITA=$idattivita";
        $request  = DB::select($sql);
        if(count($request) == 0) {
            $sql = "INSERT INTO TICKET.dbo.ATTIVITA (idattivita, tgu, titolo, motivo, stato, soggetto, ubicazione, apertail, email, idcategoria,nome_referente, email_referente, telefono_referente) VALUES ('$idattivita', '$tgu', '$titolo','$motivo', '$stato', '$soggetto', '$ubicazione', '$apertail', '$email','$idcategoria','$nome_referente','$email_referente','$telefono_referente')";
            DB::insert($sql);
        }
        else {
            $sql = "UPDATE TICKET.dbo.ATTIVITA SET tgu='$tgu', titolo='$titolo', motivo='$motivo', stato='$stato', soggetto='$soggetto', ubicazione='$ubicazione', email='$email', idcategoria='$idcategoria',nome_referente='$nome_referente', email_referente='$email_referente', telefono_referente='$telefono_referente' WHERE idattivita='$idattivita'";
            DB::update($sql);
        }
        $this->salvaStorico($idattivita,$stato);
    }

    public function getDataCliente($soggetto){
        $soggetto = $soggetto['SOGGETTO'];
        $sql = "SELECT EMAIL, TELEFONO FROM UNIWEB.dbo.AGE10 A1 WHERE SOGGETTO='$soggetto'";
        $res = DB::select($sql);
        return json_encode($res);
    }

    public function salvaStorico($idattivita,$idstato){
        $data = date('Y-m-d H:i:s');
        $sql = "INSERT INTO TICKET.dbo.STORICO (IDATTIVITA, IDSTATO, DATA) VALUES ('$idattivita','$idstato','$data')";
        DB::insert($sql);
    }

    public function elaborato(){
        $idattivita = Input::get("idattivita");
        $sql = "UPDATE TICKET.dbo.ATTIVITA SET ELABORATO=1 WHERE IDATTIVITA='$idattivita'";
        DB::update($sql);
    }

    public function getNumeroCarnet($cliente,$categoria){
        $sql = "SELECT Seriale,DataCreazione,ValoreInOre,NrCarnet,RigaCarnet,NrOrdine FROM ".MAGO.".dbo.JBS_GestioneCarnet WHERE Esaurito='0' AND Categoria='$categoria' AND CustSupp='$cliente'";
        $request  = DB::select($sql);
        return $request;
    }

    public function getTicketDisponibile($cliente,$categoria){
        $sql = "SELECT JBS_ValoreTotaleEuro FROM ".MAGO.".dbo.MA_CustSupp WHERE CustSupp='$cliente'";
        $request  = DB::select($sql);
        return $request;
    }

    public function updateTicketDisponibile($cliente, $importo){
        $sql = "UPDATE ".MAGO.".dbo.MA_CustSupp SET JBS_ValoreTotaleEuro='$importo' WHERE CustSupp='$cliente'";
        $request  = DB::update($sql);
        return $request;
    }

}

