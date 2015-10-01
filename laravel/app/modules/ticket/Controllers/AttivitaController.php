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
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $categorie = $model->getAllCategorie();
        $idattivita = $model->generateIDAttivita();
        return view("ticket::ticket.attivita", ['users' => $users, 'tecnici' => $tecnici,'stati' => $stati, 'idattivita' => $idattivita,'categorie' => $categorie]);
    }

    public function salvaattivita(){
        $model = new AttivitaModel();
        $model->salvaattivita();
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
            $row['idattivita'] = Input::get("idattivita");
            $row['descrizione'] = "Apertura ticket Uniweb " . $row['idattivita'];
            $row['motivo'] = Input::get("motivo");
            $email = Input::get("email");
            $email_referente  = Input::get("email_referente");
            $row['email_referente'] = $email_referente;
            $row['email'] = explode(";", $email);


            try {
                if (is_array($row['email']))
                    $row['email'] = $row['email'][0];
                if (!empty($row['email'])  && $row['email'] != "") {
                    Mail::send('ticket::email.cambio-stato-ticket', ['stato' => $row['stato'], 'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function ($message) use ($row) {
                        $message->to($row['email'])->subject('Cambio stato ticket ' . $row['idattivita']);
                    });
                }
                if (!empty($row['email_referente']) && $row['email_referente'] != "") {
                    Mail::send('ticket::email.cambio-stato-ticket', ['stato' => $row['stato'], 'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function ($message) use ($row) {
                        $message->to($row['email_referente'])->subject('Cambio stato ticket ' . $row['idattivita']);
                    });
                }
            }
            catch (Exception $e) {}

            $result = $model->getAllAttivitaByID($row['idattivita']);
            $tecnici = $model->getAllTecnici();
            $stati = $model->getAllStati();


            Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => $row['stato'], 'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email'], 'result' => $result, 'tecnici' => $tecnici, 'stati' => $stati], function ($message) use ($row) {
                $message->to('staff@uniweb.it', 'Staff Uniweb')->subject('Cambio stato ticket ' . $row['idattivita']);
            });

        }
        else{
            //Ticket Chiuso nessuna email, devo passare in generazione verbalino
        }
    }


    public function tickets(){
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $result = $model->getTickets();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $categorie = $model->getAllCategorie();
        return view("ticket::ticket.tickets", ['result' => $result,'users' => $users, 'tecnici' => $tecnici,'stati' => $stati,'categorie' => $categorie]);
    }

    public function getEmailCliente(){
        $model = new AttivitaModel();
        return $model->getEmailCliente();
    }

    public function mailAperturaTicket(){
        $row['idattivita'] = Input::get("idattivita");
        $row['descrizione'] = "Apertura ticket Uniweb ".$row['idattivita'];
        $row['motivo'] = Input::get("motivo");
        $email = Input::get("email");
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] =$email_referente;
        $row['email'] = explode(";", $email);
        try{
            if(is_array($row['email']))
                $row['email'] = $row['email'][0];
            if(!empty($row['email'])  && $row['email'] != "") {
                Mail::send('ticket::email.apertura-ticket', ['idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function ($message) use ($row) {
                    $message->to($row['email'])->subject('Apertura ticket ' . $row['idattivita']);
                });
            }
            if(!empty($row['email_referente'])  && $row['email_referente'] != "") {
                Mail::send('ticket::email.apertura-ticket', ['idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function ($message) use ($row) {
                    $message->to($row['email_referente'])->subject('Apertura ticket ' . $row['idattivita']);
                });
            }
        }
        catch (Exception $e) {}

        $model = new AttivitaModel();
        $result = $model->getAllAttivitaByID($row['idattivita']);


        Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => 'APERTO', 'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email'],'result' => $result], function ($message) use ($row) {
            $message->to('staff@uniweb.it', 'Staff Uniweb')->subject('Cambio stato ticket ' . $row['idattivita']);
        });

    }

    public function modificaAttivita(){
        $model = new AttivitaModel();
        $result = $model->getAttivita();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        return view("ticket::ticket.modifica-attivita", ['result' => $result,'tecnici' => $tecnici,'stati' => $stati]);
    }

}
