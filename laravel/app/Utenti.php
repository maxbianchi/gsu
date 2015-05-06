<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class Utenti extends Model {

    protected $connection = 'mysql';
    protected $table = 'UTENTI';
    protected $primaryKey = 'IDUTENTE';

    public function checkLogin()
    {
        $usr = Input::get("username");
        $pwd = Input::get("password");
        $where = ['UTENTE' => $usr, 'PASSWORD' => $pwd];
        $res = $this::where($where)->get()->toArray();

        if (count($res) == 1) {
            $utente  = DB::select("SELECT * FROM AGE10 A WHERE A.SOGGETTO ='".$res[0]['CODUTENTE']."'");
            Session::put('user', $utente[0]);
            Session::put('livello', $res[0]['LIVELLO']);
            Session::put('logged', 1);
            return true;
        } else {
            Session::flush();
            Session::flash('errors', 'Username and/or password not valid');
            return false;
        }

    }

}
