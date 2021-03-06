<?php namespace App\Modules\Gsu;
use Input;

class Utility{

    public function getClassColorStato(&$request){

        $canone = new Canoni();
        $res = [];
        $link = [];
        foreach($request as $key => $row) {
            $res = [];
            $res["GSU"]['queryString'] = "";
            $STATO = $row['STATO'];
            $QTAAOF70 = $row['QTAAOF70'];
            $QTAGSU = $row['QTAGSU'];

            $QTAGSU = is_null($QTAGSU) ? 0 : $QTAGSU;

            //Per la vista admin
            $res["GESTIONALE"]['color'] = ($STATO == 'A') ? "green" : "red";
            if (($QTAAOF70 > $QTAGSU) && ($QTAGSU == 0)) {
                $res["GSU"]['color'] = "red";
                $res["GSU"]['text'] = "D";
                $res["GSU"]['action'] = "edit";
                if($STATO != 'A')
                    $res["GSU"]['queryString'] = "eliminato=1";
            } else if (($QTAAOF70 > $QTAGSU) && ($QTAGSU != 0)) {
                $res["GSU"]['color'] = "blue";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
                $res["GSU"]['queryString'] = "add=1";
            } else if ($QTAAOF70 == $QTAGSU) {
                $res["GSU"]['color'] = "green";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
            } else if (($QTAAOF70 < $QTAGSU)) {
                $res["GSU"]['color'] = "yellow";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
            }

            //Per la Vista Rivenditori
            if($STATO == 'A'){
                if (($QTAAOF70 > $QTAGSU) || ($QTAGSU == 0)) {
                    $res["GSU"]['rivenditore']['text'] = "In attivazione";
                    $res["GSU"]['rivenditore']['color'] = "blue";
                } else if (($QTAAOF70 == $QTAGSU) || ($QTAGSU > $QTAAOF70)) {
                    $res["GSU"]['rivenditore']['text'] = "Attivo";
                    $res["GSU"]['rivenditore']['color'] = "green";
                }
                if(in_array($row['CANONE'], unserialize(SISTEMISTI))){
                    $res["GSU"]['rivenditore']['text'] = "Attivo";
                    $res["GSU"]['rivenditore']['color'] = "green";
                }
            } else {
                if (($QTAGSU == 0)) {
                    $res["GSU"]['rivenditore']['text'] = "Disattivo";
                    $res["GSU"]['rivenditore']['color'] = "red";
                } else if (($QTAGSU > 0)) {
                    $res["GSU"]['rivenditore']['text'] = "Da disattivare";
                    $res["GSU"]['rivenditore']['color'] = "yellow";
                }

            }

            $class[$row['MANUTENZIONE']] = $res;

            $request[$key]['DATADOCUMENTO'] = $row['DATADOCUMENTO'];

            $res["GSU"]["ELIMINATO"] = "";
            if(isset($row['ELIMINATO']) && $row['ELIMINATO'] == 1) {
                $res["GSU"]["ELIMINATO"] = "eliminato";
            }

            $link[$row['MANUTENZIONE']] = $canone->getRouteByCanone($row['CANONE'])."/".$res["GSU"]['action'];
        }

        $class['link'] = $link;
        return $class;
    }

    public function setLinkData(&$request){
        $canone = new Canoni();
        $res = [];
        $link = [];
        foreach($request as $key => $row) {
            $res = [];
            $res["GSU"]['queryString'] = "";
            $STATO = $row['STATO'];
            $QTAAOF70 = $row['QTAAOF70'];
            $QTAGSU = $row['QTAGSU'];

            $QTAGSU = is_null($QTAGSU) ? 0 : $QTAGSU;

            //Per la vista admin
            $res["GESTIONALE"]['color'] = ($STATO == 'A') ? "green" : "red";
            if (($QTAAOF70 > $QTAGSU) && ($QTAGSU == 0)) {
                $res["GSU"]['color'] = "red";
                $res["GSU"]['text'] = "D";
                $res["GSU"]['action'] = "edit";
            } else if (($QTAAOF70 > $QTAGSU) && ($QTAGSU != 0)) {
                $res["GSU"]['color'] = "blue";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
                $res["GSU"]['queryString'] = "add=1";
            } else if ($QTAAOF70 == $QTAGSU) {
                $res["GSU"]['color'] = "green";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
            } else if (($QTAAOF70 < $QTAGSU)) {
                $res["GSU"]['color'] = "yellow";
                $res["GSU"]['text'] = "A";
                $res["GSU"]['action'] = "search";
            }

            //Per la Vista Rivenditori
            if($STATO == 'A'){
                if (($QTAAOF70 > $QTAGSU) || ($QTAGSU == 0)) {
                    $res["GSU"]['rivenditore']['text'] = "In attivazione";
                    $res["GSU"]['rivenditore']['color'] = "blue";
                } else if (($QTAAOF70 == $QTAGSU) || ($QTAGSU > $QTAAOF70)) {
                    $res["GSU"]['rivenditore']['text'] = "Attivo";
                    $res["GSU"]['rivenditore']['color'] = "green";
                }
            } else {
                if (($QTAGSU == 0)) {
                    $res["GSU"]['rivenditore']['text'] = "Disattivo";
                    $res["GSU"]['rivenditore']['color'] = "red";
                } else if (($QTAGSU > 0)) {
                    $res["GSU"]['rivenditore']['text'] = "Da disattivare";
                    $res["GSU"]['rivenditore']['color'] = "yellow";
                }

            }

            $res["GSU"]["ELIMINATO"] = "";
            if(isset($row['ELIMINATO']) && $row['ELIMINATO'] == 1)
                $res["GSU"]["ELIMINATO"] = "eliminato";
            $class[$row['MANUTENZIONE']] = $res;

            //Imposto link dettaglio
            $link[$row['CANONE']] = $canone->getRouteByCanone($row['CANONE']);
        }

        $class['link'] = $link;
        return $class;
    }

    public static function DEBUG($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    //**
    //*@Per salvare date su sql server da dd-mm-yyyy a yyyy-mm-dd
    //**
    public function convertDate($dateIT){
        $dateIT = implode("-", array_reverse(explode("-", $dateIT)));
        return $dateIT;
    }

}