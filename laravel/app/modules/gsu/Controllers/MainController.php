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

    public function __construct()
    {

        $this->beforeFilter(function() {
            if (Session::has('logged') || Session::get('logged') != 1) {
                Session::flush();
                return Redirect::to('/')->with('message', 'Your are now logged out!');
            }
        });

    }


}
