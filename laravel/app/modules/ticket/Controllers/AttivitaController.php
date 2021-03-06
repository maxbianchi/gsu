<?php namespace App\Modules\Ticket\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Ticket\Models\AttivitaModel;
use DB;
use Session;
use Redirect;
use Input;
use Knp\Snappy\Pdf;
use App\Utenti;
use Illuminate\Support\Facades\Mail;

class AttivitaController extends MainController {

    private $tableName = "PRINCIPALE";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function creaattivita()
    {
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $sedioperative = $model->getAllSedieOperative();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $sistemisti = $model->getAllCategorie();
        $genere = $model->getAllCategorieTable();
        $idattivita = $model->generateIDAttivita();
        return view("ticket::ticket.attivita", ['users' => $users, 'tecnici' => $tecnici,'stati' => $stati, 'idattivita' => $idattivita,'genere' => $genere,'sedioperative' => $sedioperative,'sistemisti' => $sistemisti]);
    }

    public function salvaattivita(){
        $model = new AttivitaModel();
        $model->salvaattivita();
    }

    public function eliminaattivita(){
        $model = new AttivitaModel();
        $model->eliminaattivita();
    }

    /**
     *
     */
    public function salvaticket(){
        $this->cambiaStato();
        $model = new AttivitaModel();
        $model->salvaticket();
    }

    public function cambiaStato(){
        //Salvo il cambio di stato in storico
        $stato = Input::get("stato");
        $idattivita = Input::get("idattivita");
        $model = new AttivitaModel();
        $model->salvaStorico($idattivita,$stato);

        //Leggo lo stato corrente, se diverso invio mail di cambio stato tranne che per ticket chiuso o aperto
        if($stato != 4 && $stato != 1) {
            $model = new AttivitaModel();
            $stato_corrente = $model->getCurrentStato();
            if($stato_corrente == $stato)
                return false;
            $row['stato'] = $model->getStato($stato);
            $row['titolo'] = Input::has("titolo") ? Input::get("titolo") : "";
            $row['idattivita'] = Input::get("idattivita");
            $row['descrizione'] = "Apertura ticket Uniweb " . $row['idattivita'];
            $row['motivo'] = Input::get("motivo");
            $row['incaricoa'] = Input::has("incaricoa") ? $model->getTecnicoByID(Input::get("incaricoa")) : "";
            $row['email_tecnico'] = Input::has("incaricoa") ? $model->getEmailTecnicoByID(Input::get("incaricoa")) : EMAIL_STAFF;
            $row['ingaranzia'] = Input::get("ingaranzia");
            if(empty($row['email_tecnico']))
                $row['email_tecnico'] = EMAIL_STAFF;
            $row['conferma_ordine'] = Input::get("conferma_ordine");
            $email = Input::get("email");
            $row['cliente'] = Input::has("cliente") ? $model->getClientiById(Input::get("cliente")) : "";
            $row['cliente_finale'] = Input::has("cliente_finale") ? $model->getClientiById(Input::get("cliente_finale")) : "";
            $row['ubicazione_impianto'] = Input::has("ubicazione_impianto") ? $model->getClientiById(Input::get("ubicazione_impianto")) : "";

            $email_referente  = Input::get("email_referente");
            $row['email_referente'] = trim($email_referente);
            $row['email'] = explode(";", $email);


            try {
                if (is_array($row['email']))
                    $row['email'] = $row['email'][0];
                if (!empty(trim($row['email']))  && trim($row['email']) != "") {
                    Mail::send('ticket::email.cambio-stato-ticket', ['stato' => $row['stato'],'conferma_ordine' => $row['conferma_ordine'], 'idattivita' => $row['idattivita'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                        $message->to($row['email'])->subject('Cambio stato ticket ' . $row['idattivita']);
                    });
                }
                if (!empty(trim($row['email_referente'])) && trim($row['email_referente']) != "") {
                    Mail::send('ticket::email.cambio-stato-ticket', ['stato' => $row['stato'],'conferma_ordine' => $row['conferma_ordine'], 'idattivita' => $row['idattivita'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email_referente'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                        $message->to($row['email_referente'])->subject('Cambio stato ticket ' . $row['idattivita']);
                    });
                }
            }
            catch (Exception $e) {}

            $result = $model->getAllAttivitaByID($row['idattivita']);
            $tecnici = $model->getAllTecnici();
            $stati = $model->getAllStati();


            Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => $row['stato'],'incaricoa' => $row['incaricoa'],'conferma_ordine' => $row['conferma_ordine'], 'idattivita' => $row['idattivita'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email'], 'result' => $result, 'tecnici' => $tecnici, 'stati' => $stati,'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                $message->to($row['email_tecnico'], EMAIL_STAFF_DESC)->subject($row['cliente'].' - Cambio stato ticket ' . $row['idattivita']. ' '.$row['titolo']);
            });

        }
        else{
            //Ticket Chiuso nessuna email, devo passare in generazione verbalino
        }
    }


    public function tickets(){
        $idattivita = Input::get("idattivita");
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $sedioperative = $model->getAllSedieOperative();
        $result = $model->getTickets($idattivita);
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $sistemisti = $model->getAllCategorie();
        $singole_attivita = $model->getSingoleAttivita($idattivita);
        $genere = $model->getAllCategorieTable();
        return view("ticket::ticket.tickets", ['result' => $result,'users' => $users, 'tecnici' => $tecnici,'stati' => $stati,'sistemisti' => $sistemisti,'sedioperative' => $sedioperative, 'singole_attivita' => $singole_attivita ,'genere' => $genere]);
    }

    public function getSingleUser(){
        $model = new Utenti();
        $users = $model->getSingleUserFromMago();
        return json_encode($users);

    }

    public function getSingleSede(){
        $model = new Utenti();
        $users = $model->getSingleSedeFromMago();
        return json_encode($users);

    }

    public function getEmailCliente(){
        $model = new AttivitaModel();
        return $model->getEmailCliente();
    }

    public function getEmailFornitore(){
        $model = new AttivitaModel();
        return $model->getEmailFornitore();
    }

    public function mailAperturaTicket(){
        $model = new AttivitaModel();
        $row['idattivita'] = Input::get("idattivita");
        $row['descrizione'] = "Apertura ticket Uniweb ".$row['idattivita'];
        $row['titolo'] = Input::get("titolo");
        $row['motivo'] = Input::get("motivo");
        $email = Input::get("email");
        $row['incaricoa'] = Input::has("incaricoa") ? $model->getTecnicoByID(Input::get("incaricoa")) : "";
        $row['email_tecnico'] = Input::has("incaricoa") ? $model->getEmailTecnicoByID(Input::get("incaricoa")) : EMAIL_STAFF;
        if(empty($row['email_tecnico']))
            $row['email_tecnico'] = EMAIL_STAFF;
        $row['conferma_ordine'] = Input::get("conferma_ordine");
        $row['cliente'] = Input::has("cliente") ? $model->getClientiById(Input::get("cliente")) : "";
        $row['cliente_finale'] = Input::has("cliente_finale") ? $model->getClientiById(Input::get("cliente_finale")) : "";
        $row['ubicazione_impianto'] = Input::has("ubicazione_impianto") ? $model->getClientiById(Input::get("ubicazione_impianto")) : "";
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] = trim($email_referente);
        $row['email'] = explode(";", $email);
        try{
            if(is_array($row['email']))
                $row['email'] = $row['email'][0];
            if(!empty(trim($row['email']))  && trim($row['email']) != "") {
                Mail::send('ticket::email.apertura-ticket', ['idattivita' => $row['idattivita'],'conferma_ordine' => $row['conferma_ordine'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                    $message->to($row['email'])->subject('Apertura ticket ' . $row['idattivita']);
                });
            }
            if(!empty(trim($row['email_referente']))  && trim($row['email_referente']) != "") {
                Mail::send('ticket::email.apertura-ticket', ['idattivita' => $row['idattivita'],'conferma_ordine' => $row['conferma_ordine'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email_referente'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                    $message->to($row['email_referente'])->subject('Apertura ticket ' . $row['idattivita']);
                });
            }
        }
        catch (Exception $e) {}

        $model = new AttivitaModel();
        $result = $model->getAllAttivitaByID($row['idattivita']);


        Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => 'APERTO','incaricoa' => $row['incaricoa'],'conferma_ordine' => $row['conferma_ordine'], 'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email'],'result' => $result,'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
            $message->to($row['email_tecnico'], EMAIL_STAFF_DESC)->subject($row['cliente'].' - Apertura ticket ' . $row['idattivita']);
        });

    }

    public function sollecitoTicket(){
        $model = new AttivitaModel();
        $stato = Input::get("stato");
        $row['idattivita'] = Input::get("idattivita");
        $row['stato'] = $model->getStato($stato);
        $row['descrizione'] = "Apertura ticket Uniweb ".$row['idattivita'];
        $row['titolo'] = Input::get("titolo");
        $row['motivo'] = Input::get("motivo");
        $email = Input::get("email");
        $row['incaricoa'] = Input::has("incaricoa") ? $model->getTecnicoByID(Input::get("incaricoa")) : "";
        $row['email_tecnico'] = Input::has("incaricoa") ? $model->getEmailTecnicoByID(Input::get("incaricoa")) : EMAIL_STAFF;
        if(empty($row['email_tecnico']))
            $row['email_tecnico'] = EMAIL_STAFF;
        $row['conferma_ordine'] = Input::get("conferma_ordine");
        $row['cliente'] = Input::has("cliente") ? $model->getClientiById(Input::get("cliente")) : "";
        $row['cliente_finale'] = Input::has("cliente_finale") ? $model->getClientiById(Input::get("cliente_finale")) : "";
        $row['ubicazione_impianto'] = Input::has("ubicazione_impianto") ? $model->getClientiById(Input::get("ubicazione_impianto")) : "";
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] = trim($email_referente);
        $row['email'] = explode(";", $email);

        $model = new AttivitaModel();
        $result = $model->getAllAttivitaByID($row['idattivita']);


        Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => $row['stato'],'incaricoa' => $row['incaricoa'],'conferma_ordine' => $row['conferma_ordine'], 'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email'],'result' => $result,'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
            $message->to($row['email_tecnico'], EMAIL_STAFF_DESC)->subject($row['cliente'].' - Sollecito ticket ' . $row['idattivita']);
        });

    }

    public function modificaAttivita(){
        $model = new AttivitaModel();
        $result = $model->getAttivita();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        return view("ticket::ticket.modifica-attivita", ['result' => $result,'tecnici' => $tecnici,'stati' => $stati]);
    }

    public function getclienti(){
        $model = new AttivitaModel();
        $clienti = $model->getClientiByRivenditore();
        return json_encode($clienti);
    }

    public function getsedeoperativa(){
        $model = new AttivitaModel();
        $clienti = $model->getSedeOperativaByRivenditore();
        return json_encode($clienti);
    }

    public function getcategorie(){
        $model = new AttivitaModel();
        $clienti = $model->getCategorie();
        return json_encode($clienti);
    }

    public function checkBlocked(){
        $model = new AttivitaModel();
        $blocked = $model->checkblocked();
        return json_encode($blocked);
    }

    public function getTipologiaContratto(){
        $model = new AttivitaModel();
        $tipologia = $model->getTipologiaContratto();
        return json_encode($tipologia);
    }

}
