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
        $row['motivo'] = Input::get("motivo");
        $row['email'] = Input::get("email");
        $row['idattivita'] = $idattivita;
        $email_referente  = Input::get("email_referente");
        $row['email_referente'] = trim($email_referente);
        try{
            if(!empty($row['email'])) {
                Mail::send('ticket::email.chiusura-ticket', ['idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function ($message) use ($row) {
                    $message->to($row['email'])->subject('Chiusura ticket ' . $row['idattivita'])->attach($row['pathToFile']);
                });
            }
            $model = new AttivitaModel();
            $result = $model->getAllAttivitaByID($row['idattivita']);
            Mail::send('ticket::email.cambio-stato-ticket-staff', ['stato' => 'CHIUSO', 'idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email'],'result' => $result], function ($message) use ($row) {
                $message->to('staff@uniweb.it', 'Staff Uniweb')->subject('Chiusura ticket ' . $row['idattivita'])->attach($row['pathToFile']);
            });
        }
        catch (Exception $e) {}

    }



    public function chiudiTicket(){
        $stato = Input::get("stato");
        if($stato == 4) {
            $model = new Utenti();
            $users = $model->getAllUserFromMago();
            $model = new AttivitaModel();
            $tecnico = $model->getTecnico();
            $verbalino = $model->getVerbalino();
            return view("ticket::verbalino", ['users' => $users, 'tecnico' => $tecnico,'verbalino' => $verbalino]);
        }
    }

    public function salvaVerbalino(){
        $model = new AttivitaModel();
        $model->salvaVerbalino();
    }

}
