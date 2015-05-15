<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class Utenti extends Model {

    protected $table = 'UTENTI';
    protected $primaryKey = 'IDUTENTE';

    public function checkLogin()
    {
        $usr = Input::get("username");
        $pwd = Input::get("password");
        $where = ['UTENTE' => $usr, 'PASSWORD' => $pwd];
        $res = $this::where($where)->get()->toArray();

        if (count($res) == 1) {
            $utente  = DB::select("SELECT * FROM UNIWEB.dbo.AGE10 A WHERE A.SOGGETTO ='".$res[0]['CODUTENTE']."'");
            $utente[0]['username'] = $usr;
            $utente[0]['password'] = $pwd;

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

    public function getAllUser(){
        $utente  = DB::select("SELECT A.DESCRIZIONE, U.UTENTE, U.PASSWORD, U.LIVELLO  FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE A.DESCRIZIONE != ''");
        foreach($utente as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        $utenti = json_encode($utente, JSON_HEX_QUOT);
        return $utenti;
    }

    public function getAllUserFromMago(){
        $utenti  = DB::select("SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE != '' ORDER BY DESCRIZIONE");
        return $utenti;
    }

    public function createUser($codutente, $username, $password, $livello) {
        DB::insert('insert into gsu.dbo.UTENTI (CODUTENTE, UTENTE,PASSWORD, LIVELLO) values (?, ?, ?, ?)', [$codutente, $username, $password, $livello]);
    }

}
