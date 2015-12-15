<?php namespace App;

use App\Modules\Gsu\Utility;
use Illuminate\Database\Eloquent\Model;
use Input;
use League\Flysystem\Exception;
use Session;
use DB;
use Illuminate\Support\Facades\Mail;
use Request;


class Utenti extends Model {

    protected $table = 'UTENTI';
    protected $primaryKey = 'IDUTENTE';

    public function checkLogin()
    {
        $usr = Input::get("username");
        $pwd = Input::get("password");

        if($usr == "uniweb")
            $usr = "ws00375";

        $where = ['UTENTE' => $usr, 'PASSWORD' => $pwd];
        $res = $this::where($where)->get()->toArray();

        if (count($res) == 1) {
            $utente  = DB::select("SELECT * FROM UNIWEB.dbo.AGE10 A WHERE A.SOGGETTO ='".$res[0]['CODUTENTE']."'");
             $utente[0]['username'] = $usr;
            $utente[0]['password'] = $pwd;

            Session::put('user', $utente[0]);
            Session::put('livello', $res[0]['LIVELLO']);
            Session::put('idtecnico', $res[0]['IDTECNICO']);
            Session::put('logged', 1);
            $last_login = $date = date('Y-m-d H:i:s');
            $ip = Request::getClientIp(true);
            $sql = "UPDATE UTENTI SET NUMBER_LOGIN=NUMBER_LOGIN+1, LAST_LOGIN='$last_login', IP='$ip' WHERE UTENTE='".$usr."'";
            DB::update($sql);
            return true;
        } else {
            Session::flush();
            Session::flash('errors', 'Username and/or password not valid');
            return false;
        }

    }

    public function getAllUser($id = ""){
        $sql = "SELECT U.IDUTENTE, A.DESCRIZIONE, U.UTENTE, U.PASSWORD, U.LIVELLO,A.EMAIL,U.CODUTENTE  FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE A.DESCRIZIONE != '' ";

        if(!empty($id))
            $sql .= " AND U.IDUTENTE = $id";

        $sql .= " ORDER BY A.DESCRIZIONE";

        $utente  = DB::select($sql);

        foreach($utente as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }

        /*if(count($utente) == 1)
            $utente = $utente[0];*/

        return $utente;
    }

    public function getAllUserFromMago(){
        $utenti  = DB::select("SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA, A.EMAIL,A.PARTITAIVA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE != '' ORDER BY DESCRIZIONE");
        $utente = [];
        foreach($utenti as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }

    public function getUserFromMago(){
        $id = Input::get("id");
        $utenti  = DB::select("SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA, A.EMAIL, A.CAP, A.TELEFONO,A.PARTITAIVA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE != '' AND A.SOGGETTO=$id ORDER BY DESCRIZIONE");
        $utente = [];
        foreach($utenti as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }

    public function getSingleUserFromMago(){
        $descrizione = Input::get("descrizione");
        $utenti  = DB::select("SELECT A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA, A.EMAIL, A.CAP, A.TELEFONO,A.PARTITAIVA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE like '%$descrizione%' ORDER BY DESCRIZIONE");
        $utente = [];
        foreach($utenti as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }


    public function getUserFromMagoByName($descrizione){
        $utenti  = DB::select("SELECT A.DESCRIZIONE term, A.SOGGETTO, A.DESCRIZIONE, A.INDIRIZZO, A.LOCALITA, A.PROVINCIA, A.EMAIL,A.PARTITAIVA  FROM UNIWEB.dbo.AGE10 A WHERE A.DESCRIZIONE != '' AND A.DESCRIZIONE like '%$descrizione%' ORDER BY DESCRIZIONE");
        $utente = [];
        foreach($utenti as $key => $value){
            foreach($value as $key2 => $value2){
                $utente[$key][$key2] = utf8_encode($value2);
            }
        }
        return $utente;
    }

    public function createUser($codutente, $username, $password, $livello,$id) {
        if(empty($id))
            DB::insert("insert into gsu.dbo.UTENTI (CODUTENTE, UTENTE,PASSWORD, LIVELLO,NUMBER_LOGIN) values ('$codutente', '$username', '$password', '$livello',0)");
        else
            DB::update("UPDATE gsu.dbo.UTENTI SET CODUTENTE='$codutente', UTENTE='$username',PASSWORD='$password', LIVELLO='$livello' WHERE IDUTENTE=$id");
    }

    public function deleteUser($id) {
            DB::delete("DELETE FROM gsu.dbo.UTENTI WHERE IDUTENTE=$id");
    }


    public function getAllRiferimenti($soggetto = "", $q = ""){
        $sql = <<<EOF
            SELECT
            A1.DESCRIZIONE + ' - ' + A1.LOCALITA + ' - ' + A1.INDIRIZZO SOGGETTO,

            A2.DESCRIZIONE + ' - ' + A2.LOCALITA + ' - ' + A2.INDIRIZZO CLIENTE_FINALE,

            ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF((A2.DESCRIZIONE), ''), A1.DESCRIZIONE))) + ' - ' +
            ISNULL(NULLIF(A3.LOCALITA, ''), ISNULL(NULLIF((A2.LOCALITA), ''), A1.LOCALITA)) + ' - ' +
            ISNULL(NULLIF(A3.INDIRIZZO, ''), ISNULL(NULLIF((A2.INDIRIZZO), ''), A1.INDIRIZZO)) UBICAZIONE_IMPIANTO

            FROM GSU.dbo.riferimenti R
            LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON R.SOGGETTO = A1.SOGGETTO
            LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON R.CLIENTE_FINALE = A2.SOGGETTO
            LEFT OUTER JOIN UNIWEB.dbo.AGE10 A3 ON R.UBICAZIONE_IMPIANTO = A3.SOGGETTO
            Where 1=1
EOF;


        /*
         * SELECT A1.DESCRIZIONE SOGGETTO, A2.DESCRIZIONE CLIENTE_FINALE, ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF(A3.DESCRIZIONE, ''), ISNULL(NULLIF((A2.DESCRIZIONE), ''), A1.DESCRIZIONE)) + ' - ' + ISNULL(NULLIF((A2.LOCALITA), ''), A1.LOCALITA)) + ' - ' + ISNULL(NULLIF(A3.INDIRIZZO, ''), ISNULL(NULLIF((A2.INDIRIZZO), ''), A1.INDIRIZZO)) UBICAZIONE_IMPIANTO FROM GSU.dbo.riferimenti R
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A1 ON R.SOGGETTO = A1.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A2 ON R.CLIENTE_FINALE = A2.SOGGETTO
        LEFT OUTER JOIN UNIWEB.dbo.AGE10 A3 ON R.UBICAZIONE_IMPIANTO = A3.SOGGETTO
        Where 1=1
         */

        if(!empty($soggetto))
            $sql .=" AND A1.SOGGETTO = '$soggetto'";

        if(!empty($q))
            $sql .=" AND A2.DESCRIZIONE like '%$q%'";

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
            $sql = "SELECT count(*) num FROM GSU.dbo.riferimenti WHERE soggetto='".$rif['SOGGETTO']."' AND cliente_finale='".$rif['CLIENTE']."' AND ubicazione_impianto='".$rif['DESTINATARIOABITUALE']."'";
            $res = DB::select($sql);
            if($res[0]['num'] == 0){
                $sql = "INSERT INTO GSU.dbo.riferimenti (soggetto, cliente_finale, ubicazione_impianto) VALUES ('".$rif['SOGGETTO']."', '".$rif['CLIENTE']."', '".$rif['DESTINATARIOABITUALE']."')";
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
            DB::insert("insert into GSU.dbo.riferimenti (SOGGETTO, CLIENTE_FINALE,UBICAZIONE_IMPIANTO) values ('$soggetto', '$cliente', '$ubicazione')");
        }
        catch (Exception $e) {
            Throw new Exception('Caught exception: '. $e->getMessage());
        }
    }

    public function recuperapassword($piva){
        $sql = "SELECT A.SOGGETTO,A.DESCRIZIONE, A.EMAIL, U.PASSWORD FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE PARTITAIVA = '$piva' OR CODICEFISCALE='$piva'";
        $res['utenti'] = DB::select($sql);
        if(count($res['utenti']) == 0){
            Session::flush();
            $res['errors'][] = 'Partita Iva non trovata';
        }
        return $res;
    }

    public function recuperapasswordByID($id){
        $sql = "SELECT A.SOGGETTO,A.DESCRIZIONE, A.EMAIL,U.UTENTE, U.PASSWORD FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE A.SOGGETTO='$id'";
        $res['utenti'] = DB::select($sql);
        if(count($res['utenti']) == 0){
            Session::flush();
            $res['errors'] = 'Partita Iva non trovata';
        }
        return $res;
    }


    public function registrazioneSave(){
        $codicecliente = Input::get('codicecliente');
        $societa = Input::get('societa');
        $piva = Input::get('piva');
        $cf = Input::get('cf');
        $indirizzo = Input::get('indirizzo');
        $citta = Input::get('citta');
        $provincia = Input::get('provincia');
        $cap = Input::get('cap');
        $telefono = Input::get('telefono');
        $fax = Input::get('fax');
        $email = Input::get('email');
        $sitoweb = Input::get('sitoweb');
        $so_indirizzo = Input::get('so_indirizzo');
        $so_citta = Input::get('so_citta');
        $so_provincia = Input::get('so_provincia');
        $so_cap = Input::get('so_cap');
        $so_telefono = Input::get('so_telefono');
        $so_fax = Input::get('so_fax');
        $so_email = Input::get('so_email');
        $co_nome = Input::get('co_nome');
        $co_cognome = Input::get('co_cognome');
        $co_telefono = Input::get('co_telefono');
        $co_cellulare = Input::get('co_cellulare');
        $co_email = Input::get('co_email');

        $registrazione['codicecliente'] = $codicecliente;
        $registrazione['societa'] = $societa;
        $registrazione['piva'] = $piva;
        $registrazione['cf'] = $cf;
        $registrazione['indirizzo'] = $indirizzo;
        $registrazione['citta'] = $citta;
        $registrazione['provincia'] = $provincia;
        $registrazione['cap'] = $cap;
        $registrazione['telefono'] = $telefono;
        $registrazione['fax'] = $fax;
        $registrazione['email'] = $email;
        $registrazione['sitoweb'] = $sitoweb;
        $registrazione['so_indirizzo'] = $so_indirizzo;
        $registrazione['so_citta'] = $so_citta;
        $registrazione['so_provincia'] = $so_provincia;
        $registrazione['so_cap'] = $so_cap;
        $registrazione['so_telefono'] = $so_telefono;
        $registrazione['so_fax'] = $so_fax;
        $registrazione['so_email'] = $so_email;
        $registrazione['co_nome'] = $co_nome;
        $registrazione['co_cognome'] = $co_cognome;
        $registrazione['co_telefono'] = $co_telefono;
        $registrazione['co_cellulare'] = $co_cellulare;
        $registrazione['co_email'] = $co_email;




        $res['errors'] = "";
        $res['messages'] = "";

        try {
            $sql = "INSERT INTO REGISTRAZIONI (CODICECLIENTE,SOCIETA,PIVA,CF,INDIRIZZO,CITTA,PROVINCIA,CAP,TELEFONO,FAX,EMAIL,SITOWEB,SEDE_INDIRIZZO,SEDE_CITTA,SEDE_PROVINCIA,SEDE_CAP,SEDE_TELEFONO,SEDE_FAX,SEDE_EMAIL,RIFERIMENTO_NOME,RIFERIMENTO_COGNOME,RIFERIMENTO_TELEFONO,RIFERIMENTO_CELLULARE,RIFERIMENTO_EMAIL) VALUES ('$codicecliente','$societa','$piva','$cf','$indirizzo','$citta','$provincia','$cap','$telefono','$fax','$email','$sitoweb','$so_indirizzo','$so_citta','$so_provincia','$so_cap','$so_telefono','$so_fax','$so_email','$co_nome','$co_cognome','$co_telefono','$co_cellulare','$co_email')";
            DB::insert($sql);
            $sql = "SELECT MAX(ID) FROM REGISTRAZIONI";
            $id = DB::select($sql);
            $id = $id[0];
            foreach($id as $num)
                $id = $num;
            $registrazione['id'] = $id;
            //Verifico se codice cliente esiste
            if(!empty($codicecliente)){
                $sql = "SELECT A.SOGGETTO,A.DESCRIZIONE, A.EMAIL,U.UTENTE, U.PASSWORD FROM UNIWEB.dbo.AGE10 A INNER JOIN gsu.dbo.UTENTI U ON A.SOGGETTO = U.CODUTENTE WHERE CODUTENTE = $codicecliente";
                $res['utenti'] = DB::select($sql);
                if(count($res['utenti']) == 0) {
                    //Nuovo utente
                    $this->nuovaRegistrazione($registrazione);
                }else{
                    foreach($res['utenti'] as $row){
                        $email = explode(";", $row['EMAIL']);
                        if(is_array($email))
                            $row['EMAIL'] = $email[0];
                        Mail::send('emails.registrazione', ['pwd' => $row['PASSWORD'], 'user' => $row['DESCRIZIONE'], 'username' => $row['UTENTE']], function($message) use ($row)
                        {
                            $message->to($row['EMAIL'], $row['DESCRIZIONE'])->subject('Registrazione area clienti Uniweb 4.0');
                        });
                    }
                }
            }else{
                //Nuovo utente
                $this->nuovaRegistrazione($registrazione);
            }
            $res['messages'] = "Registrazione effettuata con successo, riceverà una mail con nome utente e password";
        }catch (Exception $e) {
            $res['errors'] = "Si sono verificati problemi durante la registrazione: ".$e->getMessage();
        }
        return $res;
    }

    private function nuovaRegistrazione($registrazione){
            Mail::send('emails.nuova_registrazione', ['registrazione' => $registrazione], function($message) use($registrazione)
            {
                $message->to('staff@uniweb.it', 'Portale Uniweb 4.0')->subject('Nuova registrazione sul portale Uniweb 4.0');
            });
    }

}

