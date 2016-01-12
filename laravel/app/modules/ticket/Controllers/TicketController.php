<?php namespace App\Modules\Ticket\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Ticket\Models\AttivitaModel;
use DB;
use Session;
use Input;
use Knp\Snappy\Pdf;
use App\Utenti;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class TicketController extends MainController {

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
    public function index()
    {
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        return view("ticket::index", ['users' => $users]);
    }

    public function getUserFromMago(){
        $id = Input::get("id");
        $model = new Utenti();
        $user = $model->getUserFromMago($id);
        return json_encode($user);
    }

    public function getAnagrafica(){
        $descrizione = Input::get("term");
        $model = new Utenti();
        $user = $model->getUserFromMagoByName($descrizione);
        return json_encode($user);
    }

    public function pdf(){
        $html = Input::get("html");
        $idattivita = Input::get("idattivita");
        if(file_exists('/var/www/gsu/laravel/public/output/'.$idattivita.'.pdf')){
            unlink('/var/www/gsu/laravel/public/output/'.$idattivita.'.pdf');
        }
        $snappy = new Pdf('/var/www/gsu/laravel/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
        $snappy->generateFromHtml($html, '/var/www/gsu/laravel/public/output/'.$idattivita.'.pdf');
        $model = new AttivitaModel();
        $model->chiudiTicket();
        chmod('/var/www/gsu/laravel/public/output/'.$idattivita.'.pdf', 0777);
        $row['pathToFile'] = "/var/www/gsu/laravel/public/output/".$idattivita.".pdf";

        //Recupero dati ticket
        $res = $model->getDataFromAttivita($idattivita);
        $row['motivo'] = $res['MOTIVO'];
        $row['titolo'] = $res['TITOLO'];
        $row['incaricoa'] = !empty($res['INCARICOA']) ? $model->getTecnicoByID($res['INCARICOA']) : "";
        $row['email_tecnico'] = Input::has("incaricoa") ? $model->getEmailTecnicoByID(Input::get("incaricoa")) : EMAIL_STAFF;
        if(empty($row['email_tecnico']))
            $row['email_tecnico'] = EMAIL_STAFF;
        $row['conferma_ordine'] = $res['CONFERMA_ORDINE'];
        $row['email'] = Input::get("email");
        $row['email'] = explode(";", $row['email']);
        $row['cliente'] = Input::has("cliente") ? $model->getClientiById(Input::get("cliente")) : "";
        $row['cliente_finale'] = Input::has("cliente_finale") ? $model->getClientiById(Input::get("cliente_finale")) : "";
        $row['ubicazione_impianto'] = Input::has("ubicazione_impianto") ? $model->getClientiById(Input::get("ubicazione_impianto")) : "";

        $row['idattivita'] = $idattivita;
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] = trim($email_referente);
        try{

            if (is_array($row['email']))
                $row['email'] = $row['email'][0];
            if(!empty(trim($row['email']))) {
                Mail::send('ticket::email.chiusura-ticket', ['idattivita' => $row['idattivita'],'conferma_ordine' => $row['conferma_ordine'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                    $message->to($row['email'])->subject('Chiusura ticket ' . $row['idattivita'])->attach($row['pathToFile']);
                });
            }
            if (!empty(trim($row['email_referente'])) && trim($row['email_referente']) != "") {
                Mail::send('ticket::email.chiusura-ticket', ['stato' => 'CHIUSO','conferma_ordine' => $row['conferma_ordine'], 'idattivita' => $row['idattivita'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email_referente'],'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                    $message->to($row['email_referente'])->subject('Chiusura ticket ' . $row['idattivita'])->attach($row['pathToFile']);
                });
            }
            $model = new AttivitaModel();
            $result = $model->getAllAttivitaByID($row['idattivita']);
            Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => 'CHIUSO','incaricoa' => $row['incaricoa'],'conferma_ordine' => $row['conferma_ordine'], 'idattivita' => $row['idattivita'],'titolo' => $row['titolo'], 'motivo' => $row['motivo'], 'email' => $row['email'],'result' => $result,'cliente' => $row['cliente'],'cliente_finale' => $row['cliente_finale'],'ubicazione_impianto' => $row['ubicazione_impianto']], function ($message) use ($row) {
                $message->to($row['email_tecnico'], EMAIL_STAFF_DESC)->subject($row['cliente'].' - Chiusura ticket ' . $row['idattivita'])->attach($row['pathToFile']);
            });
        }
        catch (Exception $e) {}

    }



    public function chiudiTicket(){
        $stato = Input::get("stato");
        if($stato == 4) {
            $idattivita = Input::get('idattivita');
            $model = new Utenti();
            $users = $model->getAllUserFromMago();
            $model = new AttivitaModel();
            $attivita = $model->getDataFromAttivita($idattivita);
            $apertail = $model->getDataApertura();
            $tecnico = $model->getTecnico();
            $verbalino = $model->getVerbalino();
            $carnetdisponibili = $model->getCarnetDisponibili($attivita['SOGGETTO'],$attivita['IDCATEGORIA']);
            return view("ticket::verbalino", ['users' => $users, 'tecnico' => $tecnico,'verbalino' => $verbalino,'apertail' => $apertail,'carnetdisponibili' => $carnetdisponibili]);
        }
    }

    public function salvaVerbalino(){
        $model = new AttivitaModel();
        $model->salvaVerbalino();
    }

    public function alltickets(){
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $result = $model->getTestataTickets();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        $categorie = $model->getAllCategorie();
        return view("ticket::ticket.alltickets", ['result' => $result,'users' => $users, 'tecnici' => $tecnici,'stati' => $stati,'categorie' => $categorie]);
    }

}
