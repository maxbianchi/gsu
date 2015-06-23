<?php namespace App\Modules\Gsu\Models;

use Illuminate\Database\Eloquent\Model;
use Input;
use Session;
use DB;


class VpnModel extends Model {

    public function getAllRequest(){
        $cliente = Input::get('cliente');

        $sql = <<<EOF
			SELECT
			RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.DESCRIZIONE 	AS CLIENTE,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			VPN.IDVPN,
			VPN.CODICE_R,
            VPN.SEDE1,
            VPN.SEDE2,
            VPN.SEDE3,
            VPN.SEDE4,
            VPN.SEDE5
			FROM gsu.dbo.VPN
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON VPN.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
            WHERE VPN.ELIMINATO = 0
EOF;

        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;
    }

    public function getFilteredRequest(){

        $id = Input::get('id');
        $cliente = Input::get('cliente');
        $cliente_finale = Input::get('cliente_finale');
        $ubicazione = Input::get('ubicazione');
        $canone = Input::get('canone');
        $manutenzione = Input::get('manutenzione');
        $data_contratto = Input::get('data_contratto');
        $eliminati = Input::get('eliminati');
        $sede1 = Input::get('sede1');
        $sede2 = Input::get('sede2');
        $sede3 = Input::get('sede3');
        $sede4 = Input::get('sede4');
        $sede5 = Input::get('sede5');

        $sql = <<<EOF
            SELECT
            RICHIESTE.STATO,
			richieste.OGGETTO			AS CANONE,
			CONVERT(VARCHAR(10),RICHIESTE.DATADOCUMENTO,105) DATADOCUMENTO,
			richieste.MANUTENZIONE 	AS MANUTENZIONE,
			anagrafica1.DESCRIZIONE		AS SOGGETTO,
			anagrafica1.INDIRIZZO		AS SOGGETTO_INDIRIZZO,
			anagrafica1.CAP		AS SOGGETTO_CAP,
			anagrafica1.LOCALITA		AS SOGGETTO_LOCALITA,
			anagrafica1.PROVINCIA		AS SOGGETTO_PROVINCIA,
			anagrafica1.TELEFONO		AS SOGGETTO_TELEFONO,
			anagrafica1.PARTITAIVA		AS SOGGETTO_PARTITAIVA,
			anagrafica2.DESCRIZIONE 	AS CLIENTE,
			anagrafica2.INDIRIZZO 		AS CLIENTE_INDIRIZZO,
			anagrafica2.CAP		AS CLIENTE_CAP,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica2.TELEFONO		AS CLIENTE_TELEFONO,
			anagrafica2.PARTITAIVA		AS CLIENTE_PARTITAIVA,
			anagrafica2.LOCALITA		AS CLIENTE_LOCALITA,
			anagrafica2.PROVINCIA		AS CLIENTE_PROVINCIA,
			anagrafica3.DESCRIZIONE	AS DESTINATARIOABITUALE,
			anagrafica3.INDIRIZZO		AS DESTINATARIOABITUALE_INDIRIZZO,
			anagrafica3.CAP		AS DESTINATARIOABITUALE_CAP,
			anagrafica3.LOCALITA		AS DESTINATARIOABITUALE_LOCALITA,
			anagrafica3.PROVINCIA		AS DESTINATARIOABITUALE_PROVINCIA,
			anagrafica3.TELEFONO		AS DESTINATARIOABITUALE_TELEFONO,
			anagrafica3.PARTITAIVA		AS DESTINATARIOABITUALE_PARTITAIVA,
            RICHIESTE.QUANTITA AS QTAAOF70,
            ISNULL(RICHIESTE_EVASE.QUANTITA, 0) AS QTAGSU,
			VPN.IDVPN,
			VPN.CODICE_R,
            VPN.SEDE1,
            VPN.SEDE2,
            VPN.SEDE3,
            VPN.SEDE4,
            VPN.SEDE5
			FROM gsu.dbo.VPN
			LEFT OUTER JOIN UNIWEB.dbo.AOF70 richieste ON VPN.codice_r = richieste.MANUTENZIONE
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica1	ON richieste.SOGGETTO				= anagrafica1.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica2	ON richieste.CLIENTE				= anagrafica2.SOGGETTO
			LEFT OUTER JOIN	UNIWEB.dbo.AGE10	anagrafica3	ON richieste.DESTINATARIOABITUALE	= anagrafica3.SOGGETTO
			LEFT OUTER JOIN gsu.dbo.RICHIESTE_EVASE ON gsu.dbo.RICHIESTE_EVASE.CODICE_R = richieste.MANUTENZIONE
			WHERE 1 = 1
EOF;

        if(!empty($id))
            $sql .= " AND VPN.IDVPN = '$id'";
        if(!empty($cliente))
            $sql .= " AND ANAGRAFICA1.DESCRIZIONE like '%$cliente%'";
        if(!empty($cliente_finale))
            $sql .= " AND ANAGRAFICA2.DESCRIZIONE like '%$cliente_finale%'";
        if(!empty($ubicazione))
            $sql .= " AND ANAGRAFICA3.DESCRIZIONE like '%$ubicazione%'";

        if(!empty($canone))
            $sql .= " AND RICHIESTE.OGGETTO like '%$canone%'";
        if(!empty($manutenzione))
            $sql .= " AND RICHIESTE.MANUTENZIONE like '%$manutenzione%'";

        if(!empty($data_contratto)) {
            $data_contratto = explode("-", $data_contratto);
            $data_contratto = $data_contratto[2]."-".$data_contratto[1]."-".$data_contratto[0];
            $sql .= " AND RICHIESTE.DATADOCUMENTO like '%$data_contratto%'";
        }

        if(!empty($sede1))
            $sql .= " AND VPN.SEDE1 like '%$sede1%'";
        if(!empty($sede2))
            $sql .= " AND VPN.SEDE2 like '%$sede2%'";
        if(!empty($sede3))
            $sql .= " AND VPN.SEDE3 like '%$sede3%'";
        if(!empty($sede4))
            $sql .= " AND VPN.SEDE4 like '%$sede4%'";
        if(!empty($sede5))
            $sql .= " AND VPN.SEDE5 like '%$sede5%'";

        if(!empty($eliminati))
            $sql .= " AND VPN.ELIMINATO = 1";
        else
            $sql .= " AND VPN.ELIMINATO = 0";

        $sql .= " ORDER BY SOGGETTO, CLIENTE, DESTINATARIOABITUALE";

        $request  = DB::select($sql);
        return $request;


    }

    public function deleteByID(){
        $id = Input::get('id');
        $manutenzione = Input::get('manutenzione');
        if(!empty($id)) {
            $sql = "UPDATE gsu.dbo.VPN SET ELIMINATO=1 WHERE IDVPN='$id'";
            DB::delete($sql);

            $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
            $richieste_evase = DB::select($sql);
            if(count($richieste_evase) > 0){
                $richieste_evase = $richieste_evase[0];
                $qta = $richieste_evase['QUANTITA'] - 1;
                /*if($qta == 0)
                    DB::delete("DELETE FROM gsu.dbo.RICHIESTE_EVASE where CODICE_R = '$manutenzione'");
                else*/
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
            }


            }
    }


    public function saveData(){
        $id = Input::get('id_tbl');
        $manutenzione = Input::get('manutenzione');
        $eliminato = !is_null(Input::get('eliminato')) ? 1 : 0 ;
        $stato_precedente = Input::get('stato_precedente');
        $sede1 = Input::get('sede1');
        $sede2 = Input::get('sede2');
        $sede3 = Input::get('sede3');
        $sede4 = Input::get('sede4');
        $sede5 = Input::get('sede5');

        try {
            if(empty($id)) {
                DB::insert("INSERT INTO gsu.dbo.VPN (CODICE_R,SEDE1,SEDE2,SEDE3,SEDE4,SEDE5, ELIMINATO) VALUES ('$manutenzione','$sede1','$sede2','$sede3','$sede4','$sede5',$eliminato)");


                $sql = "SELECT * FROM gsu.dbo.RICHIESTE_EVASE WHERE CODICE_R = '$manutenzione'";
                $richieste_evase = DB::select($sql);
                if(count($richieste_evase) > 0) {
                    $richieste_evase = $richieste_evase[0];
                    $qta = $richieste_evase['QUANTITA'] + 1;
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = '$qta' where CODICE_R = '$manutenzione'");
                }
                else{
                    DB::insert("INSERT INTO gsu.dbo.RICHIESTE_EVASE (CODICE_R, QUANTITA) VALUES ('$manutenzione','1')");
                }
            }
            else
                DB::update("UPDATE gsu.dbo.VPN SET Codice_R='$manutenzione',SEDE1='$sede1',SEDE2='$sede2',SEDE3='$sede3',SEDE4='$sede4',SEDE5='$sede5',ELIMINATO=$eliminato WHERE IDVPN=$id");
                if($stato_precedente == 1 && $eliminato == 0){
                    DB::update("UPDATE gsu.dbo.RICHIESTE_EVASE SET QUANTITA = (QUANTITA + 1) where CODICE_R = '$manutenzione'");
                }
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function checkAddNew(){
        $model = new VpnModel();
        $res = $model->getFilteredRequest();
        $codici_manutenzione = [];
        $cod_manutenzione = "";
        foreach ($res as $key => $value){
            if($cod_manutenzione != $value['MANUTENZIONE']) {
                $cod_manutenzione = $value['MANUTENZIONE'];
                $codici_manutenzione[] = $value['MANUTENZIONE'];
            }
        }
        Input::merge(array('add' => '0'));
        if(count($res) > 0 && count($codici_manutenzione) == 1) {
            if ($res[0]['QTAAOF70'] > $res[0]['QTAGSU'])
                Input::merge(array('add' => '1'));
        }
    }

}

