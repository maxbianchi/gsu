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
                    $message->to($row['email'], EMAIL_STAFF_DESC)->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
                });
            }
            if (!empty(trim($row['email_referente'])) && trim($row['email_referente']) != "") {
                Mail::send('ticket::email.apertura-ticket-cliente', ['stato' => 'APERTO','user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                    $message->to($row['email_referente'], EMAIL_STAFF_DESC)->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
                });
            }

            Mail::send('ticket::email.apertura-ticket-cliente', ['stato' => 'APERTO','user' => $row['users'],'titolo' => $row['titolo'],'idattivita' => $row['idattivita'], 'motivo' => $row['motivo']], function ($message) use ($row) {
                $message->to(EMAIL_STAFF, EMAIL_STAFF_DESC)->subject($row['users'].' - Apertura ticket da CLIENTE ' . $row['idattivita']);
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
            $message->to(EMAIL_STAFF, EMAIL_STAFF_DESC)->subject($row['users'].' - Sollecito ticket da CLIENTE ' . $row['idattivita']);
        });


    }

    public function elaborato(){
        //Salvataggio dati su JBS_StoricoInterventi
        $idattivita = Input::get("idattivita");
        $model = new AttivitaModel();
        $attivita = $model->getAllFromAttivita($idattivita);
        $verbalino = $model->getAllFromVerbalino($idattivita);
        $model->storeStoricoJBS($attivita[0],$verbalino[0]);
        //Calcolo ore
        $tempo_totale = $verbalino[0]['TEMPO_TOTALE'] / 60;
        $ora = ($verbalino[0]['ORA_FINE_1'] + ($verbalino[0]['ORA_FINE_1_MINUTI'] / 60)) - ($verbalino[0]['ORA_INIZIO_1'] + ($verbalino[0]['ORA_INIZIO_1_MINUTI'] / 60));
        $ora2 = ($verbalino[0]['ORA_FINE_2'] + ($verbalino[0]['ORA_FINE_2_MINUTI'] / 60)) - ($verbalino[0]['ORA_INIZIO_2'] + ($verbalino[0]['ORA_INIZIO_2_MINUTI'] / 60));
        $ora3 = $verbalino[0]['TEMPO_VIAGGIO_1'];
        $ora4 = $verbalino[0]['TEMPO_VIAGGIO_2'];
        $minuti = $verbalino[0]['TEMPO_VIAGGIO_1_MINUTI'] / 60;
        $minuti2 = $verbalino[0]['TEMPO_VIAGGIO_2_MINUTI'] / 60;


        $tempo = $ora + $ora2 + $ora3 + $ora4 + $minuti + $minuti2 + $tempo_totale;
        $prezzo = $model->getPrice($attivita[0]['IDCATEGORIA']);

        $importo = $tempo * $prezzo[0]['PREZZO_FINALE'];

        $tipologia_contratto = $model->getTipologiaContrattoByCliente($attivita[0]['SOGGETTO'], $attivita[0]['IDCATEGORIA']);
        switch($tipologia_contratto[0]['TipologiaAssistenza']){
            case 'CONTRATTO':
                break;
            case 'TICKET':
                if($verbalino[0]['IN_GARANZIA'] != 1):
                    //Gestione tempo minimo
                    if($tipologia_contratto['0']['TempoMinimo'] > $tempo)
                        $importo = $tipologia_contratto['0']['TempoMinimo'] * $prezzo[0]['PREZZO_FINALE'];
                    //Gestione DirittoFisso
                    $importo += $tipologia_contratto['0']['DirittoFisso'];
                    $model->storeTicket($attivita[0],$verbalino[0],$importo);
                    $model2 = new ClientiModel();
                    $creditoresiduo = $model2->getTicketDisponibile($attivita[0]['SOGGETTO'], $attivita[0]['IDCATEGORIA']);
                    $creditoresiduo = $creditoresiduo[0]['JBS_ValoreTotaleEuro'] - $importo;
                    $model2->updateTicketDisponibile($attivita[0]['SOGGETTO'],$creditoresiduo );
                endif;
                break;
            case 'CARNET':
                if($verbalino[0]['IN_GARANZIA'] != 1):
                    //CARNET
                    $numero_carnet = $verbalino[0]['CARNET_MATTINA'] + $carnet_mattina = $verbalino[0]['CARNET_POMERIGGIO'];
                    $carnet_disponibili = $model->getNumeroCarnet($attivita[0]['SOGGETTO'], $attivita[0]['IDCATEGORIA']);
                endif;
                break;
            default:
                if($verbalino[0]['IN_GARANZIA'] != 1):
                    //CONSUNTIVO
                    //Gestione tempo minimo
                    if($tipologia_contratto['0']['TempoMinimo'] > $tempo)
                        $tempo = $tipologia_contratto['0']['TempoMinimo'];
                    $model->storeConsuntivo($attivita[0],$verbalino[0],$tempo,$prezzo[0]['PREZZO_FINALE']);
                endif;
        }



        //Archivio l'attivita
        $model = new ClientiModel();
        $model->elaborato();
    }


    public function getCarnetDisponibili(){
        $cliente = Input::get("cliente");
        $categoria = Input::get("categoria");
        $model = new ClientiModel();
        $carnet_disponibili = $model->getNumeroCarnet($cliente, $categoria);
        return json_encode($carnet_disponibili);
    }

    public function getTicketDisponibili(){
        $cliente = Input::get("cliente");
        $categoria = Input::get("categoria");
        $model = new ClientiModel();
        $ticket_disponibili = $model->getTicketDisponibile($cliente, $categoria);
        return json_encode($ticket_disponibili);
    }

}
