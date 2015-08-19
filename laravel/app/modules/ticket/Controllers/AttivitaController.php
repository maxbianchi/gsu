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
        $idattivita = $model->generateIDAttivita();
		return view("ticket::ticket.attivita", ['users' => $users, 'tecnici' => $tecnici,'stati' => $stati, 'idattivita' => $idattivita]);
	}

   public function salvaattivita(){
       $model = new AttivitaModel();
       $model->salvaattivita();
   }

    /**
     *
     */
    public function salvaticket(){
        $model = new AttivitaModel();
        $model->salvaticket();
    }

    public function tickets(){
        $model = new Utenti();
        $users = $model->getAllUserFromMago();
        $model = new AttivitaModel();
        $result = $model->getTickets();
        $tecnici = $model->getAllTecnici();
        $stati = $model->getAllStati();
        return view("ticket::ticket.tickets", ['result' => $result,'users' => $users, 'tecnici' => $tecnici,'stati' => $stati]);
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
        $row['email'] = explode(";", $email);
        if(is_array($row['email']))
            $row['email'] = $row['email'][0];
        Mail::send('ticket::email.apertura-ticket', ['idattivita' => $row['idattivita'], 'motivo' => $row['motivo'], 'email' => $row['email']], function($message) use ($row)
        {
            $message->to($row['email'])->bcc('staff@uniweb.it', 'Staff Uniweb')->subject('Apertura ticket '.$row['idattivita']);
        });
    }

}
