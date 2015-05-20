<?php namespace App;

use App\Modules\Gsu\Utility;
use Illuminate\Database\Eloquent\Model;
use Input;
use League\Flysystem\Exception;
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
            $riferimenti  = $this->getAllRiferimenti($res[0]['CODUTENTE']);
            $clienti_finali = [];
            $ubicazioni = [];

            if($res[0]['LIVELLO'] != 1) {
                foreach ($riferimenti as $rif) {
                    if (!in_array($rif['CLIENTE_FINALE'], $clienti_finali))
                        $clienti_finali[] = $rif['CLIENTE_FINALE'];
                    if (!in_array($rif['UBICAZIONE_IMPIANTO'], $ubicazioni))
                        $ubicazioni[] = $rif['UBICAZIONE_IMPIANTO'];
                }
            }

            $utente[0]['username'] = $usr;
            $utente[0]['password'] = $pwd;

            Session::put('user', $utente[0]);
            Session::put('livello', $res[0]['LIVELLO']);
            Session::put('logged', 1);
            Session::put('clienti_finali', $clienti_finali);
            Session::put('ubicazioni', $ubicazioni);

            return true;
        } else {
            Session::flush();
            Session::flash('errors', 'Username and/or password not valid');
            return false;
        }

    }

    public function getAllUser(){
        $utente  = DB::select("SELECT U.IDUTENTE, A.DESCRIZIONE, U.UTENTE, U.PASSWORD, U.LIVELLO  FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE A.DESCRIZIONE != '' ORDER BY A.DESCRIZIONE");
        foreach($utente as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }

    public function getAllUserFromMago(){
        $utenti  = DB::select("SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE != '' ORDER BY DESCRIZIONE");
        return $utenti;
    }

    public function createUser($codutente, $username, $password, $livello) {
        DB::insert("insert into gsu.dbo.UTENTI (CODUTENTE, UTENTE,PASSWORD, LIVELLO) values ('$codutente', '$username', '$password', '$livello')");
    }


    public function getAllRiferimenti($soggetto = ""){
        $sql = <<<EOF
        SELECT A1.DESCRIZIONE SOGGETTO, A2.DESCRIZIONE CLIENTE_FINALE, ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF((A2.DESCRIZIONE), ''), A1.DESCRIZIONE)) + ' - ' + ISNULL(NULLIF((A2.LOCALITA), ''), A1.LOCALITA)) + ' - ' + ISNULL(NULLIF(A3.INDIRIZZO, ''), ISNULL(NULLIF((A2.INDIRIZZO), ''), A1.INDIRIZZO)) UBICAZIONE_IMPIANTO FROM UNIWEB.dbo.riferimenti R
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON R.SOGGETTO = A1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON R.CLIENTE_FINALE = A2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A3 ON R.UBICAZIONE_IMPIANTO = A3.SOGGETTO
EOF;

        if(!empty($soggetto))
            $sql .=" WHERE A1.SOGGETTO like '%$soggetto%'";

        $sql .= " ORDER BY SOGGETTO";

        $res = DB::select($sql);
        return $res;
    }

    public function autoSetRiferimenti(){
        $sql=<<<EOF
        select SOGGETTO, CLIENTE, DESTINATARIOABITUALE FROM UNIWEB.dbo.AOF70 ORDER BY SOGGETTO
EOF;
        $riferimenti = DB::select($sql);
        $i = 0;
        foreach($riferimenti as $rif){
            $sql = "SELECT count(*) num FROM UNIWEB.dbo.riferimenti WHERE soggetto='".$rif['SOGGETTO']."' AND cliente_finale='".$rif['CLIENTE']."' AND ubicazione_impianto='".$rif['DESTINATARIOABITUALE']."'";
            $res = DB::select($sql);
            if($res[0]['num'] == 0){
                $sql = "INSERT INTO UNIWEB.dbo.riferimenti (soggetto, cliente_finale, ubicazione_impianto) VALUES ('".$rif['SOGGETTO']."', '".$rif['CLIENTE']."', '".$rif['DESTINATARIOABITUALE']."')";
                DB::insert($sql);
                $i++;
            }
        }
        return $i;
    }

    public function saveRiferimento(){
        try {
            $soggetto = Input::get('soggetto');
            $cliente = Input::get('cliente');
            $ubicazione = Input::get('ubicazione');
            DB::insert("insert into UNIWEB.dbo.riferimenti (SOGGETTO, CLIENTE_FINALE,UBICAZIONE_IMPIANTO) values ('$soggetto', '$cliente', '$ubicazione')");
        }
        catch (Exception $e) {
            Throw new Exception('Caught exception: '. $e->getMessage());
        }
    }

}
