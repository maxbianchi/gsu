<?php namespace App\Modules\Gsu;

class Utility{

    public function getClassColorStato(&$request){

        $canone = new Canoni();
        $res = [];
        $link = [];
        foreach($request as $key => $row) {
            $res = [];
            $STATO = $row['STATO'];
            $QTAAOF70 = $row['QTAAOF70'];
            $QTAGSU = $row['QTAGSU'];

            $QTAGSU = is_null($QTAGSU) ? 0 : $QTAGSU;

            $res["GESTIONALE"]['color'] = ($STATO == 'A') ? "green" : "red";
            if (($QTAAOF70 > $QTAGSU) && ($QTAGSU == 0)) {
                $res["GSU"]['color'] = "red";
                $res["GSU"]['text'] = "D";
            } else if (($QTAAOF70 > $QTAGSU) && ($QTAGSU != 0)) {
                $res["GSU"]['color'] = "blue";
                $res["GSU"]['text'] = "A";
            } else if ($QTAAOF70 == $QTAGSU) {
                $res["GSU"]['color'] = "green";
                $res["GSU"]['text'] = "A";
            } else if (($QTAAOF70 < $QTAGSU)) {
                $res["GSU"]['color'] = "yellow";
                $res["GSU"]['text'] = "A";
            }
            $class[$row['MANUTENZIONE']] = $res;

            //Sistemo Data
            if(!empty($row['DATADOCUMENTO'])) {
                $data = explode(" ", $row['DATADOCUMENTO']);
                $data = explode("-", $data[0]);
                $data = $data[2] . "-" . $data[1] . "-" . $data[0];
                $request[$key]['DATADOCUMENTO'] = $data;
            }

            //Imposto link dettaglio
            $link[$row['CANONE']] = $canone->getRouteByCanone($row['CANONE']);
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

            //Sistemo Data
            if(!empty($row['DATADOCUMENTO'])) {
                $data = explode(" ", $row['DATADOCUMENTO']);
                $data = explode("-", $data[0]);
                $data = $data[2] . "-" . $data[1] . "-" . $data[0];
                $request[$key]['DATADOCUMENTO'] = $data;
            }

            //Imposto link dettaglio
            $link[$row['CANONE']] = $canone->getRouteByCanone($row['CANONE']);
        }

        $class['link'] = $link;
        return $class;
    }


}