<?php namespace App\Modules\Ticket\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Ticket\Models\AttivitaModel;
use App\Modules\Ticket\Models\ClientiModel;
use DB;
use Knp\Snappy\Pdf;
use App\Utenti;
use Illuminate\Support\Facades\Mail;
use Session;
use Redirect;
use Input;


class ClientController extends MainController {

    protected $view_folder;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTickets(){
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $result = $model->getTestataTickets();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $categorie = $model->getAllCategorie();
        return view("ticket::client.index", ['result' => $result,'users' => $users, 'tecnici' => $tecnici,'stati' => $stati,'categorie' => $categorie]);
    }

    public function getStorico(){
        $idattivita = Input::get("idattivita");
        $model = new ClientiModel();
        $storico = $model->getAllStorico($idattivita);
        $attivita = $model->getAttivita($idattivita);
        return view("ticket::client.storico", ['storico' => $storico, 'attivita' => $attivita]);
    }

    public function apriticket(){
        $model = new ClientiModel();
        $users = $model->getAllUserFromMagoBySoggetto(Session::get('user'));
        $model = new AttivitaModel();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $categorie = $model->getAllCategorie();
        $idattivita = $model->generateIDAttivita();
        return view("ticket::client.nuovo", ['users' => $users, 'tecnici' => $tecnici,'stati' => $stati, 'idattivita' => $idattivita,'categorie' => $categorie]);
    }

    public function salvaticket(){
        $model = new ClientiModel();
        $model->salvaticket();
        $model = new ClientiModel();
        $soggetto = Session::get('user');
        $row['users'] = $soggetto['DESCRIZIONE'];
        $row['idattivita'] = Input::get("idattivita");
        $row['titolo'] = Input::get("titolo");
        $row['motivo'] = Input::get("motivo");
        $row['email'] = Input::get("email");
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] = trim($email_referente);
        try{

            if (is_array($row['email']))
                $row['email'] = $row['email'][0];
            if(!empty(trim($row['email']))) {
                Mail::send('ticket::email.apertura-ticket-cliente', ['stato' => 'APERTO','user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                    $message->to($row['email'], 'Staff Uniweb')->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
                });
            }
            if (!empty(trim($row['email_referente'])) && trim($row['email_referente']) != "") {
                Mail::send('ticket::email.apertura-ticket-cliente', ['stato' => 'APERTO','user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                    $message->to($row['email_referente'], 'Staff Uniweb')->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
                });
            }

            Mail::send('ticket::email.apertura-ticket-cliente', ['stato' => 'APERTO','user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                $message->to('staff@uniweb.it', 'Staff Uniweb')->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
            });
        }
        catch (Exception $e) {}

    }

    public function getDataCliente(){
        $model = new ClientiModel();
        return $model->getDataCliente(Session::get('user'));
    }

    public function sollecitoTicket(){
        $model = new ClientiModel();
        $soggetto = Session::get('user');
        $row['users'] = $soggetto['DESCRIZIONE'];
        $row['idattivita'] = Input::get("idattivita");
        $row['titolo'] = Input::get("titolo");
        $row['motivo'] = Input::get("motivo");


            Mail::send('ticket::email.sollecito-ticket-cliente', ['user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                $message->to('staff@uniweb.it', 'Staff Uniweb')->subject($row['users'].' - Sollecito ticket da CLIENTE ' . $row['idattivita']);
            });


    }

}
