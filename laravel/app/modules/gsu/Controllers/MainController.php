<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\DialUpModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;
use Session;
use Route;
use Input;

class MainController extends Controller {

    public function __construct()
    {
        /*$this->beforeFilter(function(){
            $logged = Session::get('logged');
            if(is_null($logged) || $logged != 1) {
                Session::flush();
                return Redirect::to('/dashboard');
            }
        });*/

        $logged = Session::get('logged');
        if(is_null($logged) || $logged != 1) {
            Session::flush();
            return Redirect::to('/dashboard');
        }

    }


}
