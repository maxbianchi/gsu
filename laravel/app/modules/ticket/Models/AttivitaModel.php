<?php namespace App\Modules\Ticket\Models;

use App\Modules\Gsu\Utility;
use App\Utenti;
use Illuminate\Database\Eloquent\Model;
use Input;
use League\Flysystem\Util;
use Session;
use DB;


class AttivitaModel extends Model
{

    public function getAllSedieOperative(){
        $sql = "SELECT * FROM ".MAGO.".dbo.JBS_SEDEOPERATIVA ORDER BY CompanyName";
        $request = DB::select($sql);
        $request = [];
        foreach($request as $key => $value){
            foreach($value as $key2 => $value2){
                $request[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
        return $request;
    }

    public function getAllTecnici()
    {
        $sql = "SELECT * FROM TICKET.dbo.TECNICI ORDER BY DESCRIZIONE";
        $request = DB::select($sql);
        return $request;
    }

    public function getAllCategorie()
    {
        $sql = "SELECT * FROM TICKET.dbo.CATEGORIE ORDER BY DESCRIZIONE";
        $request = DB::select($sql);
        return $request;
    }

    public function getTecnico()
    {
        $idtecnico = Input::get('incaricoa');
        $sql = "SELECT * FROM TICKET.dbo.TECNICI WHERE IDTECNICO=$idtecnico";
        $request = DB::select($sql);
        return $request[0]['DESCRIZIONE'];
    }

    public function getAllStati()
    {
        $sql = "SELECT * FROM TICKET.dbo.STATI ORDER BY IDSTATO";
        $request = DB::select($sql);
        return $request;
    }

    public function generateIDAttivita()
    {
        $sql = "SELECT MAX(IDATTIVITA) IDATTIVITA FROM TICKET.dbo.ATTIVITA";
        $request = DB::select($sql);
        $date = date("Ymd");
        $tmp = "";
        if (isset($request[0]['IDATTIVITA'])) {
            $request = $request[0]['IDATTIVITA'];
            $idattivita = substr_replace($request, "", strlen($request) - 2);
            if ($date == $idattivita) {
                $idattivita = $this->increaseID($request);
                $tmp = $date;
                $date .= $idattivita;
            } else {
                $tmp = $date;
                $date .= "01";
            }

        } else {
            $tmp = $date;
            $date .= "01";
        }

        $idOK = false;
        while (!$idOK) {
            $idOK = $this->checkConcurrency($date);
            if ($idOK == false)
                $date = $tmp . $this->increaseID($date);
        }

        DB::insert("INSERT INTO TICKET.dbo.IDATTIVITA (IDATTIVITA) VALUES ('$date')");
        return $date;
    }

    public function increaseID($request)
    {
        $idattivita = substr($request, strlen($request) - 2, strlen($request));
        $idattivita++;
        if ($idattivita < 10)
            $idattivita = "0" . $idattivita;
        return $idattivita;
    }

    public function checkConcurrency($idattivita)
    {
        $sql = "SELECT IDATTIVITA FROM TICKET.dbo.IDATTIVITA WHERE IDATTIVITA='$idattivita'";
        $request = DB::select($sql);
        if (count($request) > 0)
            return false;
        return true;
    }

    public function salvaattivita()
    {
        $idattivita = Input::get("idattivita");
        $descrizione = Input::get("attivita");
        $descrizione = str_replace("'", "", $descrizione);
        $tempo = Input::get("tempo");
        $incaricoa = Input::get("incaricoa_attivita");
        $inseritoil = date('Y-m-d H:i:s');
        $id = Input::get("id");
        if (empty($id)) {
            $sql = "INSERT INTO TICKET.dbo.SINGOLE_ATTIVITA (idattivita, descrizione, tempo, incaricoa, inseritoil) VALUES ('$idattivita', '$descrizione', '$tempo', '$incaricoa', '$inseritoil' )";
            DB::insert($sql);
        } else {
            $sql = "UPDATE TICKET.dbo.SINGOLE_ATTIVITA SET descrizione='$descrizione', tempo='$tempo', incaricoa='$incaricoa' WHERE IDATTIVITA=$idattivita AND ID=$id";
            DB::update($sql);
        }

    }

    public function eliminaattivita()
    {
        $id = Input::get("id");
        DB::delete("DELETE FROM TICKET.dbo.SINGOLE_ATTIVITA WHERE ID='$id'");
    }

    public function salvaticket()
    {
        $idattivita = Input::get("idattivita");
        $tickettelecom = Input::get("tickettelecom");
        $apertoda = Input::get("apertoda");
        $incaricoa = Input::get("incaricoa");
        $tgu = Input::get("tgu");
        $titolo = Input::get("titolo");
        $titolo = str_replace("'", "", $titolo);
        $motivo = Input::get("motivo");
        $motivo = str_replace("'", "", $motivo);
        $stato = Input::get("stato");
        $soggetto = Input::get("cliente");
        $cliente_finale = Input::get("cliente_finale");
        $ubicazione = Input::get("ubicazione_impianto");
        $apertail = date('Y-m-d H:i:s');
        $email = Input::get("email");
        $idcategoria = Input::get("categoria");
        $email_referente = Input::get("email_referente");
        $nome_referente = Input::get("nome_referente");
        $telefono_referente = Input::get("telefono_referente");
        $conferma_ordine = Input::get("conferma_ordine");
        $cod_servizio = Input::get("cod_servizio");
        $in_garanzia = Input::get("ingaranzia");
        $ordine_fornitore = Input::get("ordinefornitore");
        $nome_fornitore = Input::get("nomefornitore");
        $telefono_fornitore = Input::get("telefonofornitore");
        $fornitore = Input::get("fornitore");
        $sedeoperativa = Input::get("sedeoperativa");

        $sql = "SELECT * FROM TICKET.dbo.ATTIVITA where IDATTIVITA=$idattivita";
        $request = DB::select($sql);
        if (count($request) == 0) {
            $sql = "INSERT INTO TICKET.dbo.ATTIVITA (idattivita, TICKETTELECOM, apertoda, incaricoa, tgu, titolo, motivo, stato, soggetto, ubicazione, apertail, email, idcategoria,nome_referente, email_referente, telefono_referente,cliente_finale,conferma_ordine,cod_servizio,elaborato,in_garanzia,ordine_fornitore,nome_fornitore,telefono_fornitore,fornitore,sede_operativa) VALUES ('$idattivita', '$tickettelecom', '$apertoda', '$incaricoa','$tgu', '$titolo','$motivo', '$stato', '$soggetto', '$ubicazione', '$apertail', '$email','$idcategoria','$nome_referente','$email_referente','$telefono_referente','$cliente_finale','$conferma_ordine','$cod_servizio', 0 ,$in_garanzia,'$ordine_fornitore','$nome_fornitore','$telefono_fornitore','$fornitore','$sedeoperativa' )";
            DB::insert($sql);
        } else {
            $sql = "UPDATE TICKET.dbo.ATTIVITA SET TICKETTELECOM='$tickettelecom', apertoda='$apertoda', incaricoa='$incaricoa', tgu='$tgu', titolo='$titolo', motivo='$motivo', stato='$stato', soggetto='$soggetto', ubicazione='$ubicazione', email='$email', idcategoria='$idcategoria',nome_referente='$nome_referente', email_referente='$email_referente', telefono_referente='$telefono_referente', cliente_finale='$cliente_finale', conferma_ordine='$conferma_ordine', cod_servizio='$cod_servizio', in_garanzia=$in_garanzia, ordine_fornitore='$ordine_fornitore',nome_fornitore='$nome_fornitore',telefono_fornitore='$telefono_fornitore',fornitore='$fornitore',sede_operativa='$sedeoperativa' WHERE idattivita='$idattivita'";
            DB::update($sql);
        }

    }

    public function getDataFromAttivita($idattivita)
    {
        $sql = "SELECT * FROM TICKET.dbo.ATTIVITA WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        if (is_array($res) && count($res) > 0)
            $res = $res[0];
        return $res;
    }

    public function getTestataTickets()
    {
        $utility = new Utility();
        $soggetto = Input::get("cliente");
        $stato = Input::get("stato");
        $tecnico = Input::get("tecnico");
        $tgu = Input::get("tgu");
        $tickettelecom = Input::get("tickettelecom");
        $idattivita = Input::get('idattivita');
        $categoria = Input::get('categoria');
        $titolo = Input::get('titolo');
        $conferma_ordine = Input::get('conferma_ordine');
        $data_intervento_da = Input::get("data_intervento_da");
        if (!empty($data_intervento_da)) {
            $data_intervento_da = $utility->convertDate($data_intervento_da);
            $data_intervento_da = date('Y-m-d H:i:s', strtotime($data_intervento_da));
        }
        $data_intervento_a = Input::get("data_intervento_a");
        if (!empty($data_intervento_a)) {
            $data_intervento_a = Input::get("data_intervento_a");
            $data_intervento_a = $utility->convertDate($data_intervento_a);
            $data_intervento_a .= " 23:59:59";
        }

        $sql = <<<EOF
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
        C.DESCRIZIONE,
        A.TITOLO,
        A.MOTIVO,
        ST.IDSTATO,
        ST.STATO,
        A.SOGGETTO SOGGETTO_CODICE,
        A.CLIENTE_FINALE CLIENTE_FINALE_CODICE,
        A.UBICAZIONE DESTINATARIOABITUALE_CODICE,
        REPLACE(LTRIM(RTRIM(A1.DESCRIZIONE)),'''','') AS SOGGETTO_NOME,
        REPLACE(LTRIM(RTRIM(A3.DESCRIZIONE)),'''','') AS CLIENTE_FINALE_NOME,
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
        A.NOME_REFERENTE,
        A.EMAIL_REFERENTE,
        A.TELEFONO_REFERENTE,
        A.IDCATEGORIA,
        A.CONFERMA_ORDINE,
        A.COD_SERVIZIO,
        A.ELABORATO,
        A.IN_GARANZIA,
        A.ORDINE_FORNITORE,
        A.NOME_FORNITORE,
        A.TELEFONO_FORNITORE,
        A.FORNITORE,
        A.SEDE_OPERATIVA,
        CONVERT(VARCHAR(10),V.DATA_INTERVENTO,105 ) DATA_INTERVENTO
        FROM TICKET.dbo.ATTIVITA A
        LEFT JOIN TICKET.dbo.STATI ST ON A.STATO = ST.IDSTATO
        LEFT JOIN TICKET.dbo.CATEGORIE C ON A.IDCATEGORIA = C.IDCATEGORIA
        LEFT JOIN TICKET.dbo.TECNICI T1 ON A.apertoda = T1.IDTECNICO
        LEFT JOIN TICKET.dbo.TECNICI T2 ON A.incaricoa = T2.IDTECNICO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON A.SOGGETTO = A1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A3 ON A.CLIENTE_FINALE = A3.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON A.UBICAZIONE = A2.SOGGETTO
        LEFT OUTER JOIN TICKET.dbo.VERBALINI V ON V.IDATTIVITA = A.IDATTIVITA
        WHERE 1 = 1
EOF;
        if (!empty($soggetto))
            $sql .= " AND REPLACE(A1.DESCRIZIONE,'''', '') like '%$soggetto%'";
        if (!empty($stato) && $stato != "") {
            if ($stato == -1)
                $sql .= " AND A.INCARICOA IS NULL OR A.INCARICOA = 0 AND A.ELABORATO != 1";
            elseif ($stato == -2)
                $sql .= " AND A.ELABORATO = 1";
            else
                $sql .= " AND A.ELABORATO != 1 AND A.STATO = '$stato'";
        } else {
            $sql .= "AND A.ELABORATO != 1";
        }
        if (!empty($tecnico))
            $sql .= " AND A.INCARICOA = '$tecnico'";
        if (!empty($tgu))
            $sql .= " AND A.TGU = '$tgu'";
        if (!empty($tickettelecom))
            $sql .= " AND A.TICKETTELECOM = $tickettelecom";
        if (!empty($idattivita))
            $sql .= " AND A.IDATTIVITA = $idattivita";
        if (!empty($categoria))
            $sql .= " AND A.IDCATEGORIA = '$categoria'";
        if (!empty($titolo))
            $sql .= " AND A.TITOLO LIKE '%$titolo%'";
        if (!empty($conferma_ordine))
            $sql .= " AND A.CONFERMA_ORDINE LIKE '%$conferma_ordine%'";

        if (!empty($data_intervento_da))
            $sql .= " AND V.DATA_INTERVENTO >= '$data_intervento_da'";
        if (!empty($data_intervento_a))
            $sql .= " AND V.DATA_INTERVENTO <= '$data_intervento_a'";

        $sql .= " ORDER BY A.STATO, A1.DESCRIZIONE";

        $request = DB::select($sql);
        return $request;

    }

    public function getTickets()
    {
        $soggetto = Input::get("cliente");
        $stato = Input::get("stato");
        $tecnico = Input::get("tecnico");
        $tgu = Input::get("tgu");
        $tickettelecom = Input::get("tickettelecom");
        $idattivita = Input::get('idattivita');
        $categoria = Input::get('categoria');

        $sql = <<<EOF
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
        C.DESCRIZIONE,
        TITOLO,
        MOTIVO,
        ST.IDSTATO,
        ST.STATO,
        A.SOGGETTO SOGGETTO_CODICE,
        A.CLIENTE_FINALE CLIENTE_FINALE_CODICE,
        A.UBICAZIONE DESTINATARIOABITUALE_CODICE,
        REPLACE(LTRIM(RTRIM(A1.DESCRIZIONE)),'''','') AS SOGGETTO_NOME,
        REPLACE(LTRIM(RTRIM(A3.DESCRIZIONE)),'''','') AS CLIENTE_FINALE_NOME,
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
        A.NOME_REFERENTE,
        A.EMAIL_REFERENTE,
        A.TELEFONO_REFERENTE,
        A.IDCATEGORIA,
        A.CONFERMA_ORDINE,
        A.COD_SERVIZIO,
        A.ELABORATO,
        A.IN_GARANZIA,
        A.ORDINE_FORNITORE,
        A.NOME_FORNITORE,
        A.TELEFONO_FORNITORE,
        A.FORNITORE,
        A.SEDE_OPERATIVA,
        CONVERT(VARCHAR(10),S.INSERITOIL,105 ) INSERITOIL,
        CONVERT(VARCHAR(10),S.INSERITOIL,108 ) INSERITOIL_ORA
        FROM TICKET.dbo.ATTIVITA A LEFT JOIN TICKET.dbo.SINGOLE_ATTIVITA S ON A.IDATTIVITA = S.IDATTIVITA
        LEFT JOIN TICKET.dbo.STATI ST ON A.STATO = ST.IDSTATO
        LEFT JOIN TICKET.dbo.CATEGORIE C ON A.IDCATEGORIA = C.IDCATEGORIA
        LEFT JOIN TICKET.dbo.TECNICI T1 ON A.apertoda = T1.IDTECNICO
        LEFT JOIN TICKET.dbo.TECNICI T2 ON A.incaricoa = T2.IDTECNICO
		LEFT JOIN TICKET.dbo.TECNICI T3 ON S.incaricoa = T3.IDTECNICO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON A.SOGGETTO = A1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A3 ON A.CLIENTE_FINALE = A3.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON A.UBICAZIONE = A2.SOGGETTO
        WHERE 1 = 1
EOF;
        if (!empty($soggetto))
            $sql .= " AND REPLACE(A1.DESCRIZIONE,'''', '') like '%$soggetto%'";
        if (!empty($stato) && $stato != "") {
            if ($stato == -1)
                $sql .= " AND A.INCARICOA IS NULL OR A.INCARICOA = 0";
            else
                $sql .= " AND A.STATO = '$stato'";
        }
        if (!empty($tecnico))
            $sql .= " AND A.INCARICOA = '$tecnico'";
        if (!empty($tgu))
            $sql .= " AND A.TGU = '$tgu'";
        if (!empty($tickettelecom))
            $sql .= " AND A.TICKETTELECOM = $tickettelecom";
        if (!empty($idattivita))
            $sql .= " AND A.IDATTIVITA = $idattivita";
        if (!empty($categoria))
            $sql .= " AND A.IDCATEGORIA = '$categoria''";

        $sql .= " ORDER BY A.STATO, A1.DESCRIZIONE";

        $request = DB::select($sql);
        return $request;

    }

    public function getEmailCliente()
    {
        $cliente = Input::get('cliente');
        $sql = "SELECT EMAIL, TELEFONO FROM UNIWEB.dbo.AGE10 A1 WHERE SOGGETTO='$cliente'";
        $res = DB::select($sql);
        return json_encode($res);
    }

    public function getStato($stato_int)
    {
        if (!isset($stato_int))
            return 0;
        $sql = "SELECT STATO FROM TICKET.dbo.STATI WHERE IDSTATO=$stato_int";
        $res = DB::select($sql);
        if (is_array($res) && count($res) > 0)
            $stato_text = $res[0]['STATO'];
        return $stato_text;
    }

    public function getCurrentStato()
    {
        $idattivita = Input::get("idattivita");
        $sql = "SELECT STATO FROM TICKET.dbo.ATTIVITA WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        try {
            if (isset($res) > 0)
                $stato_text = $res[0]['STATO'];
            else
                $stato_text = 1;
            return $stato_text;
        } catch (Exception $e) {
        }
    }

    public function getDataApertura()
    {
        $idattivita = Input::get("idattivita");
        $sql = "SELECT CONVERT(VARCHAR(15),TICKET.dbo.ATTIVITA.APERTAIL,105) APERTAIL FROM TICKET.dbo.ATTIVITA WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        return $res[0]['APERTAIL'];
    }

    public function chiudiTicket()
    {
        $idattivita = Input::get('idattivita');
        $chiusail = date('Y-m-d H:i:s');
        $sql = "UPDATE TICKET.dbo.ATTIVITA SET STATO = 4, CHIUSAIL='$chiusail' WHERE IDATTIVITA=$idattivita";
        DB::update($sql);
    }

    public function getAttivita()
    {
        $idattivita = Input::get('idattivita');
        $sql = "SELECT * FROM TICKET.dbo.SINGOLE_ATTIVITA WHERE IDATTIVITA='$idattivita' ORDER BY ID";
        $res = DB::select($sql);
        return $res;
    }

    public function getTecnicoByID($idtecnico)
    {
        $sql = "SELECT DESCRIZIONE FROM TICKET.dbo.TECNICI WHERE IDTECNICO='$idtecnico'";
        $res = DB::select($sql);
        if (count($res) > 0)
            return $res[0]['DESCRIZIONE'];
        return "";
    }

    public function getEmailTecnicoByID($idtecnico)
    {
        $sql = "SELECT EMAIL FROM TICKET.dbo.TECNICI WHERE IDTECNICO='$idtecnico'";
        $res = DB::select($sql);
        if (count($res) > 0)
            return $res[0]['EMAIL'];
        return "";
    }

    public function getAllAttivitaByID($idattivita)
    {
        $sql = "SELECT IDATTIVITA, S.DESCRIZIONE, TEMPO, T.DESCRIZIONE AS INCARICOA_ATTIVITA, CONVERT(VARCHAR(10),S.INSERITOIL,105 ) INSERITOIL, CONVERT(VARCHAR(10),S.INSERITOIL,108 ) INSERITOIL_ORA  FROM TICKET.dbo.SINGOLE_ATTIVITA S LEFT JOIN TICKET.dbo.TECNICI T ON S.INCARICOA=T.IDTECNICO WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        return $res;
    }

    public function salvaVerbalino()
    {
        $idattivita = Input::get('idattivita');
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione = Input::get('ubicazione');
        $riferimento = Input::get('riferimento');
        $telefono = Input::get('telefono');
        $email = Input::get('email');
        $matricola = Input::get('matricola');
        $modello = Input::get('modello');
        $tot_bn = Input::get('tot_bn');
        $tot_colore = Input::get('tot_colore');
        $motivo = Input::get('motivo');
        $motivo = str_replace("'", "", $motivo);
        $descrizione = Input::get('descrizione');
        $descrizione = str_replace("'", "", $descrizione);
        $codice1 = Input::get('codice1');
        $descrizione1 = Input::get('descrizione1');
        $descrizione1 = str_replace("'", "", $descrizione1);
        $qta1 = Input::get('qta1');
        $note1 = Input::get('note1');
        $note1 = str_replace("'", "", $note1);
        $codice2 = Input::get('codice2');
        $descrizione2 = Input::get('descrizione2');
        $descrizione2 = str_replace("'", "", $descrizione2);
        $qta2 = Input::get('qta2');
        $note2 = Input::get('note2');
        $note2 = str_replace("'", "", $note2);
        $codice3 = Input::get('codice3');
        $descrizione3 = Input::get('descrizione3');
        $descrizione3 = str_replace("'", "", $descrizione3);
        $qta3 = Input::get('qta3');
        $note3 = Input::get('note3');
        $note3 = str_replace("'", "", $note3);
        $data_intervento = Input::get('data_intervento');
        $data_intervento = explode("-", $data_intervento);
        $data_intervento = $data_intervento[2] . "-" . $data_intervento[1] . "-" . $data_intervento[0];
        $intervento_remoto = isset($_POST['intervento_remoto']) ? 1 : 0;
        $tempo = Input::get('tempo');
        $tempo_viaggio = Input::get('tempo_viaggio');
        $tempo_viaggio_minuti = Input::get('tempo_viaggio_minuti');
        $ora_inizio = Input::get('ora_inizio');
        $ora_inizio_minuti = Input::get('ora_inizio_minuti');
        $ora_fine = Input::get('ora_fine');
        $ora_fine_minuti = Input::get('ora_fine_minuti');
        $tempo_viaggio2 = Input::get('tempo_viaggio2');
        $tempo_viaggio2_minuti = Input::get('tempo_viaggio2_minuti');
        $ora_inizio2 = Input::get('ora_inizio2');
        $ora_inizio2_minuti = Input::get('ora_inizio2_minuti');
        $ora_fine2 = Input::get('ora_fine2');
        $ora_fine2_minuti = Input::get('ora_fine2_minuti');
        $note = Input::get('note');
        $note = str_replace("'", "", $note);
        $intervento_risolutivo = isset($_POST['intervento_risolutivo_si']) ? 1 : 0;
        $garanzia = isset($_POST['garanzia_si']) ? 1 : 0;
        $macchina_funzione = isset($_POST['macchina_funzione_si']) ? 1 : 0;
        $incaricoa = Input::get('incaricoa');
        $carnet_mattina = $_POST['carnet_mattina'];
        $carnet_pomeriggio = $_POST['carnet_pomeriggio'];
        $tipologia_intervento = Input::get("tipologia_intervento");

        $sql = "SELECT * FROM TICKET.dbo.VERBALINI WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        if (count($res) == 0) {
            $sql = "INSERT INTO TICKET.dbo.VERBALINI (IDATTIVITA,CLIENTE,UBICAZIONE,RIFERIMENTO,TELEFONO,EMAIL,MATRICOLA,MODELLO,LETTURA_BN,LETTURA_COLORE,MOTIVO,DESCRIZIONE,CODICE_1,DESCRIZIONE_1,QTA_1,NOTE_1,CODICE_2,DESCRIZIONE_2,QTA_2,NOTE_2,CODICE_3,DESCRIZIONE_3,QTA_3,NOTE_3,DATA_INTERVENTO,INTERVENTO_REMOTO,TEMPO_TOTALE,TEMPO_VIAGGIO_1,ORA_INIZIO_1,ORA_FINE_1,TEMPO_VIAGGIO_2,ORA_INIZIO_2,ORA_FINE_2,NOTE,INTERVENTO_RISOLUTIVO,IN_GARANZIA,MACCHINA_FUNZIONE,TECNICO, CLIENTE_FINALE, TEMPO_VIAGGIO_1_MINUTI,ORA_INIZIO_1_MINUTI,ORA_FINE_1_MINUTI,TEMPO_VIAGGIO_2_MINUTI,ORA_INIZIO_2_MINUTI,ORA_FINE_2_MINUTI,CARNET_MATTINA,CARNET_POMERIGGIO, TIPOLOGIA_INTERVENTO) VALUES ('$idattivita','$cliente','$ubicazione','$riferimento','$telefono','$email','$matricola','$modello','$tot_bn','$tot_colore','$motivo','$descrizione','$codice1','$descrizione1','$qta1','$note1','$codice2','$descrizione2','$qta2','$note2','$codice3','$descrizione3','$qta3','$note3','$data_intervento','$intervento_remoto','$tempo','$tempo_viaggio','$ora_inizio','$ora_fine','$tempo_viaggio2','$ora_inizio2','$ora_fine2','$note','$intervento_risolutivo','$garanzia','$macchina_funzione','$incaricoa', '$cliente_finale','$tempo_viaggio_minuti','$ora_inizio_minuti','$ora_fine_minuti','$tempo_viaggio2_minuti','$ora_inizio2_minuti','$ora_fine2_minuti','$carnet_mattina','$carnet_pomeriggio','$tipologia_intervento')";
            DB::insert($sql);
        } else {
            $sql = "UPDATE TICKET.dbo.VERBALINI SET CLIENTE='$cliente',UBICAZIONE='$ubicazione',RIFERIMENTO='$riferimento',TELEFONO='$telefono',EMAIL='$email',MATRICOLA='$matricola',MODELLO='$modello',LETTURA_BN='$tot_bn',LETTURA_COLORE='$tot_colore',MOTIVO='$motivo',DESCRIZIONE='$descrizione',CODICE_1='$codice1',DESCRIZIONE_1='$descrizione1',QTA_1='$qta1',NOTE_1='$note1',CODICE_2='$codice2',DESCRIZIONE_2='$descrizione2',QTA_2='$qta2',NOTE_2='$note2',CODICE_3='$codice3',DESCRIZIONE_3='$descrizione3',QTA_3='$qta3',NOTE_3='$note3',DATA_INTERVENTO='$data_intervento',INTERVENTO_REMOTO='$intervento_remoto',TEMPO_TOTALE='$tempo',TEMPO_VIAGGIO_1='$tempo_viaggio',ORA_INIZIO_1='$ora_inizio',ORA_FINE_1='$ora_fine',TEMPO_VIAGGIO_2='$tempo_viaggio2',ORA_INIZIO_2='$ora_inizio2',ORA_FINE_2='$ora_fine2',NOTE='$note',INTERVENTO_RISOLUTIVO='$intervento_risolutivo',IN_GARANZIA='$garanzia',MACCHINA_FUNZIONE='$macchina_funzione',TECNICO='$incaricoa', CLIENTE_FINALE='$cliente_finale',TEMPO_VIAGGIO_1_MINUTI='$tempo_viaggio_minuti',ORA_INIZIO_1_MINUTI='$ora_inizio_minuti',ORA_FINE_1_MINUTI='$ora_fine_minuti',TEMPO_VIAGGIO_2_MINUTI='$tempo_viaggio2_minuti', ORA_INIZIO_2_MINUTI='$ora_inizio2_minuti',ORA_FINE_2_MINUTI='$ora_fine2_minuti', CARNET_MATTINA='$carnet_mattina', CARNET_POMERIGGIO='$carnet_pomeriggio', TIPOLOGIA_INTERVENTO='$tipologia_intervento' WHERE IDATTIVITA = '$idattivita'";
            DB::update($sql);
        }

    }


    public function salvaStorico($idattivita, $idstato)
    {
        $data = date('Y-m-d H:i:s');
        $sql = "INSERT INTO TICKET.dbo.STORICO (IDATTIVITA, IDSTATO, DATA) VALUES ('$idattivita','$idstato','$data')";
        DB::insert($sql);
    }

    public function getVerbalino()
    {
        $idattivita = Input::get('idattivita');
        $sql = "SELECT V.*, V.DESCRIZIONE DESCRIZIONE_INTERVENTO, CONVERT(VARCHAR(10),DATA_INTERVENTO,105) DATA_INTERVENTO_CONV, T.DESCRIZIONE TECNICO_FIRMA FROM TICKET.dbo.VERBALINI V INNER JOIN TICKET.dbo.TECNICI  T ON T.IDTECNICO = TECNICO WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        if (is_array($res) && isset($res[0])) {
            $res = $res[0];
        }
        return $res;
    }

    public function getClientiByRivenditore()
    {
        $q = Input::get('term');
        $res = DB::select("SELECT DISTINCT REPLACE(LTRIM(RTRIM(DESCRIZIONE)),'''','') AS DESCRIZIONE FROM UNIWEB.dbo.AGE10 WHERE DESCRIZIONE like '%$q%'");
        $result = "";
        foreach ($res as $keys => $values) {
            foreach ($values as $key => $value)
                $result[] = trim($value);
        }
        return $result;
    }

    public function getSedeOperativaByRivenditore()
    {
        $q = Input::get('term');
        $res = DB::select("SELECT DISTINCT REPLACE(LTRIM(RTRIM(COMPANYNAME)),'''','') AS DESCRIZIONE FROM ".MAGO.".dbo.JBS_SEDEOPERATIVA WHERE COMPANYNAME like '%$q%'");
        $result = "";
        foreach ($res as $keys => $values) {
            foreach ($values as $key => $value)
                $result[] = trim($value);
        }
        return $result;
    }

    public function getClientiById($id)
    {
        $res = DB::select("SELECT DISTINCT REPLACE(LTRIM(RTRIM(DESCRIZIONE)),'''','') AS DESCRIZIONE FROM UNIWEB.dbo.AGE10 WHERE SOGGETTO = '$id'");
        $result = "";
        foreach ($res as $keys => $values) {
            foreach ($values as $key => $value)
                $result[] = trim($value);
        }
        return $result[0];
    }

    public function getCategorie()
    {
        $cliente = Input::get('cliente');
        $sql = "SELECT R.Codice, R.Descrizione FROM " . MAGO . ".dbo.JBS_RIGHECONTRATTI R INNER JOIN " . MAGO . ".dbo.JBS_TESTACONTRATTI T ON R.NrContratto=T.NrContratto LEFT JOIN " . MAGO . ".dbo.MA_Items I ON I.Item = R.Codice WHERE I.CommodityCtg = 'SERV' AND T.Cliente = '$cliente'";
        $res = DB::select($sql);
        return $res;
    }

    public function checkBlocked()
    {
        $cliente = Input::get('cliente');
        $sql = "SELECT Blocked FROM " . MAGO . ".dbo.MA_CustSuppCustomerOptions WHERE Customer = '$cliente'";
        $res = DB::select($sql);
        return $res;
    }

    public function getTipologiaContratto()
    {
        $cliente = Input::get('cliente');
        $categoria = Input::get('categoria');
        $sql = "SELECT TipologiaAssistenza FROM " . MAGO . ".dbo.JBS_GestioneAssistenza WHERE CustSupp = '$cliente' AND Categoria='$categoria'";
        $res = DB::select($sql);
        return $res;
    }

    public function getAllFromAttivita($idattivita)
    {
        $sql = "SELECT A.*,CONVERT(VARCHAR(10),A.CHIUSAIL,105 ) CHIUSURA,CONVERT(VARCHAR(10),A.CHIUSAIL,108 ) CHIUSURA_ORA,CONVERT(VARCHAR(10),A.APERTAIL,105 ) APERTURA, T.DESCRIZIONE TECNICO FROM TICKET.dbo.ATTIVITA A INNER JOIN TICKET.dbo.TECNICI T ON A.INCARICOA = T.IDTECNICO WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        return $res;
    }

    public function getAllFromVerbalino($idattivita)
    {
        $sql = "SELECT * FROM TICKET.dbo.VERBALINI WHERE IDATTIVITA='$idattivita'";
        $res = DB::select($sql);
        return $res;
    }

    public function storeStoricoJBS($attivita, $verbalino)
    {
        $sql = "INSERT INTO " . MAGO . ".dbo.JBS_StoricoInterventi (CustSuppType,CustSupp,NrIntervento,DataIntervento,OraIntervento,CategoriaIntervento,DescrizioneIntervento,StatoIntervento,Incaricato,DataAperturaTicket,DataChiusuraTicket,ClienteFinale,UbicazioneImpianto) VALUES ('3211264','" . $attivita['SOGGETTO'] . "','" . $attivita['IDATTIVITA'] . "',CONVERT(datetime,'" . $attivita['CHIUSURA'] . "',105),'" . $attivita['CHIUSURA_ORA'] . "','" . $attivita['IDCATEGORIA'] . "','" . $verbalino['MOTIVO'] . "','CHIUSO','" . $attivita['TECNICO'] . "',CONVERT(datetime,'" . $attivita['APERTURA'] . "',105),CONVERT(datetime,'" . $attivita['CHIUSURA'] . "',105),'" . $attivita['CLIENTE_FINALE'] . "','" . $attivita['UBICAZIONE'] . "')";
        DB::insert($sql);
    }

    public function storeOrdiniRigheJBS($attivita,$qta,$val)
    {
        $sql = "SELECT MAX(Riga) Riga FROM " . MAGO . ".dbo.JBS_StoricoTicket";
        $res = DB::select($sql);
        $progressivoriga = $this->calculateProgressivoRiga($res);
        $sql = "INSERT INTO " . MAGO . ".dbo.JBS_ImportazioneOrdiniRighe (ID,Riga,NrAssistenza,Cliente,Categoria,Descrizione,Qta,ValUnit,Sel,Importato) VALUES ('1','$progressivoriga','" . $attivita['IDATTIVITA'] . "','" . $attivita['SOGGETTO'] . "','" . $attivita['IDCATEGORIA'] . "','" . $attivita['MOTIVO'] . "','$qta','$val','0','0')";
        DB::insert($sql);
    }

    public function storeTicket($attivita, $verbalino, $importo)
    {
        $sql = "SELECT MAX(Riga) Riga FROM " . MAGO . ".dbo.JBS_StoricoTicket";
        $res = DB::select($sql);
        $progressivoriga = $this->calculateProgressivoRiga($res);
        $sql = "INSERT INTO " . MAGO . ".dbo.JBS_StoricoTicket (CustSuppType, CustSupp,Riga,DataMovimento,TipoMovimento,Importo,NrAssistenza) VALUES ('3211264','" . $attivita['SOGGETTO'] . "','$progressivoriga',CONVERT(datetime,'" . $attivita['CHIUSURA'] . "',105),'544604161','$importo','" . $attivita['IDATTIVITA'] . "')";
        DB::insert($sql);

    }

    public function storeConsuntivo($attivita, $verbalino, $tempo,$valore)
    {
        $sql = "SELECT MAX(Riga) Riga FROM " . MAGO . ".dbo.JBS_ImportazioneOrdiniRighe";
        $res = DB::select($sql);
        $progressivoriga = $this->calculateProgressivoRiga($res);
        $sql = "INSERT INTO " . MAGO . ".dbo.JBS_ImportazioneOrdiniRighe (ID,Riga,NrAssistenza,Cliente,Categoria,Descrizione,Qta,ValUnit,Sel,Importato,DataAperturaTicket,DataChiusuraTicket,ClienteFinale,UbicazioneImpianto) VALUES ('1','$progressivoriga','" . $attivita['IDATTIVITA'] . "','" . $attivita['SOGGETTO'] . "','" . $attivita['IDCATEGORIA'] . "','" . $verbalino['MOTIVO'] . "','$tempo','$valore','0','0',CONVERT(datetime,'" . $attivita['APERTURA'] . "',105),CONVERT(datetime,'" . $attivita['CHIUSURA'] . "',105),'" . $attivita['CLIENTE_FINALE'] . "','" . $attivita['UBICAZIONE'] . "')";
        DB::insert($sql);
    }

    public function getTipologiaContrattoByCliente($cliente, $categoria)
    {
        $sql = "SELECT TipologiaAssistenza,TempoMinimo,DirittoFisso FROM " . MAGO . ".dbo.JBS_GestioneAssistenza WHERE CustSupp = '$cliente' AND Categoria='$categoria'";
        $res = DB::select($sql);
        return $res;

    }

    public function getPrice($categoria){
        $sql = "SELECT PREZZO_FINALE FROM ".MAGO.".dbo.JBS_PREZZI WHERE ITEM='$categoria'";
        $res = DB::select($sql);
        return $res;
    }

    public function getNumeroCarnet($cliente, $categoria){
        $sql = "SELECT COUNT(*) FROM ".MAGO.".dbo.JBS_GestioneCarnet WHERE CustSupp='$cliente' AND categoria='$categoria'";
        $res = DB::select($sql);
        return $res;
    }

    public function getCarnetDisponibili($cliente, $categoria){
        $sql = "SELECT * FROM ".MAGO.".dbo.JBS_GestioneCarnet WHERE CustSupp='$cliente' AND categoria='$categoria' AND Esaurito='0'";
        $res = DB::select($sql);
        return $res;
    }

    public function setCarnetEsaurito($seriale){
        $sql = "UPDATE ".MAGO.".dbo.JBS_GestioneCarnet SET Esaurito = '1' WHERE Seriale = '$seriale'";
        $res = DB::update($sql);
    }

    private function calculateProgressivoRiga($row){
        $value = $row[0]['Riga'];
        if(is_null($value) or empty($value)) {
            $progressivoriga = 1;
        }else{
            $progressivoriga = $value + 1;
        }
        return $progressivoriga;
    }

}