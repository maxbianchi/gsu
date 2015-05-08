<?php namespace App\Modules\Gsu\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gsu\Models\DialUpModel;
use App\Modules\Gsu\Models\GsuModel;
use App\Modules\Gsu\Utility;
use DB;

class DialUpController extends Controller {

	public function __construct()
	{
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */

    public function main(){
        $res = new DialUpModel();
        $res = $res->getAllRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.dial-up.dial-up", ['request' => $res, 'class' => $class]);
    }

    public function search(){
        $res = new DialUpModel();
        $res = $res->getFilteredRequest();
        $utility = new Utility();
        $class = $utility->setLinkData($res);
        return view("gsu::admin.dial-up.dial-up", ['request' => $res, 'class' => $class]);
    }

    public function show(){
        $res = new DialUpModel();
        $res = $res->getFilteredRequest();
        print_r($res);
        exit;

    }

}
