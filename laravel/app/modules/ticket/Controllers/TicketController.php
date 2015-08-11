<?php namespace App\Modules\Ticket\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Session;
use Redirect;
use Input;
use Knp\Snappy\Pdf;
use App\Utenti;

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
        $snappy = new Pdf('/var/www/gsu/laravel/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
        $snappy->generateFromHtml($html, '/var/www/gsu/laravel/public/output/test.pdf');

    }

}
