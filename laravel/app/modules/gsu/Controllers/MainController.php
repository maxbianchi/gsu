<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\DialUpModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Redirect;
use Input;


class MainController extends Controller {

    protected $view_folder;

    public function __construct()
    {

        $this->beforeFilter(function() {
            if (!Session::has('logged') || Session::get('logged') != 1) {
                Session::flush();
                return Redirect::to('/')->with('message', 'Your are now logged out!');
            } else {
                Session::set('alive', 1);
            }

            $livello = Session::get('livello');
            if($livello != 1) {
                $cliente = Session::get('user');
                Input::merge(array('cliente' => $cliente['DESCRIZIONE']));
            }
            $this->view_folder = "admin";
            if($livello == 2)
                $this->view_folder = "rivenditore";
            if($livello == 3)
                $this->view_folder = "user";

        });

    }


}
