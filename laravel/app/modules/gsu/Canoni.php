<?php namespace App\Modules\Gsu;

class Canoni{

    private $canoni;
    
    public function __construct(){
        $this->canoni['/gsu/adsl'] = ['CAN-B001A', 'CAN-B001B', 'CAN-B002A', 'CAN-B002B', 'CAN-B003A', 'CAN-B003B', 'CAN-B004A', 'CAN-B004B', 'CAN-B005A', 'CAN-B005B', 'CAN-B009A', 'CAN-B009B', 'CAN-B010A', 'CAN-B010B', 'CAN-B011B', 'CAN-B012B', 'CAN-B013B','CAN-B014B','CAN-B015B', 'CAN-B016B', 'CAN-B017B', 'CAN-B018B', 'CAN-B007A', 'CAN-B007B', 'CAN-B008A', 'CAN-B008B', 'CAN-B006A', 'CAN-B006B', 'CAN-B008M', 'CAN-B019B', 'CAN-B020B', 'CAN-B051-001B', 'CAN-B057-001B'];
        $this->canoni['/gsu/linea-aggiuntiva'] = ['CAN-B201', 'CAN-B201B'];
        $this->canoni['/gsu/sim'] = ['CAN-I001-001B', 'CAN-I001-002B','CAN-I001-003B','CAN-I001-004B','CAN-I001-005B','CAN-I001-006B','CAN-I001-007B', 'CAN-I001M', 'CAN-I011M', 'CAN-I001-008B', 'CAN-I001-009B', 'CAN-I001-010B', 'CAN-I001-011B', 'CAN-I001-015B', 'CAN-I001-016B', 'CAN-I001-017B', 'CAN-I001-012B', 'CAN-I001-013B', 'CAN-I001-014B','CAN-I001-018B','CAN-I001-019B','CAN-I001-020B','CAN-I001-021B','CAN-I001-022B','CAN-I001-023B','CAN-I001-024B','CAN-I001-025B','CAN-I001-026B','CAN-I001-027B','CAN-I001-028B', 'CAN-I001-029B', 'CAN-I001-030B', 'CAN-I001-031B', 'CAN-I001-032B', 'CAN-I001-033B', 'CAN-I001-034B', 'CAN-I001-035B', 'CAN-I001-036B', 'CAN-I001-037B', 'CAN-I001-038B', 'CAN-I001-039B', 'CAN-I001-040B', 'CAN-I001-041B', 'CAN-I001-042B', 'CAN-I001-043B', 'CAN-I001-044B', 'CAN-I001-045B', 'CAN-I001-046B'];
        $this->canoni['/gsu/sim-m2m'] = ['CAN-I011A', 'CAN-I011B'];
        $this->canoni['/gsu/sim-twin'] = ['CAN-I021B', 'CAN-I022B'];
        $this->canoni['/gsu/sim-extension'] = ['CAN-I031B'];
        $this->canoni['/gsu/sim-fax-dati'] = ['CAN-I041B'];
        $this->canoni['/gsu/sim-opzioni-roaming'] = ['CAN-I051B', 'CAN-I052B', 'CAN-I053B', 'CAN-I054B', 'CAN-I055B', 'CAN-I056B', 'CAN-I057B', 'CAN-I058B', 'CAN-I051-001B', 'CAN-I051-003B', 'CAN-I051-004B'];
        $this->canoni['/gsu/sim-opzioni-intercom'] = ['CAN-I061B', 'CAN-I062B', 'CAN-I063B', 'CAN-I064B', 'CAN-I065B', 'CAN-I066B'];
        $this->canoni['/gsu/sim-tassa-ministeriale'] = ['CAN-I101B'];
        $this->canoni['/gsu/sim-assistenza-tecnica'] = ['CAN-I201B'];
        $this->canoni['/gsu/sim-opzione-dati'] = ['CAN-I111B', 'CAN-I112B', 'CAN-I113B', 'CAN-I114B', 'CAN-I115B', 'CAN-I116B', 'CAN-I117B', 'CAN-I118B', 'CAN-I119-001B','CAN-I119-002B', 'CAN-I119-003B','CAN-I119-004B','CAN-I119-005B','CAN-I119-006B','CAN-I119-007B', 'CAN-I120-001B', 'CAN-I120-002B', 'CAN-I119-008B' , 'CAN-I119-009B' , 'CAN-I119-010B' , 'CAN-I119-011B' , 'CAN-I119-012B' , 'CAN-I120-003B' , 'CAN-I120-004B', 'CAN-I119-013B', 'CAN-I119-014B', 'CAN-I119-015B', 'CAN-I119-016B', 'CAN-I119-017B', 'CAN-I119-018B', 'CAN-I119-019B', 'CAN-I119-020B', 'CAN-I119-021B'];
        $this->canoni['/gsu/sim-filtro-accessi'] = ['CAN-I211-001B', 'CAN-I212-001B', 'CAN-I213-001B', 'CAN-I214-001B', 'CAN-I215-001B', 'CAN-I216-001B', 'CAN-I217-001B', 'CAN-I217-001B', 'CAN-I219-001B'];
        $this->canoni['/gsu/apparati-networking'] = ['CAN-B102B', 'CAN-B103M', 'CAN-B103B', 'CAN-D103B', 'CAN-F022A', 'CAN-F022B', 'CAN-F022M', 'CAN-F021B'];
        $this->canoni['/gsu/assistenza-centralini'] = ['CAN-G001A', 'CAN-G001B'];
        $this->canoni['/gsu/servizi-plus'] = ['CAN-G071-001B', 'CAN-G071-002B', 'CAN-G071-003B', 'CAN-G072-001B', 'CAN-G073-001B', 'CAN-G073-002B'];
        $this->canoni['/gsu/multifunzione'] = ['CAN-F101A', 'CAN-F101B'];
        $this->canoni['/gsu/apparati-mobile'] = ['CAN-F301A', 'CAN-F301B'];
        $this->canoni['/gsu/centralini'] = ['CAN-F201B', 'CAN-F201A', 'CAN-F202B', 'CAN-F202A', 'CAN-F203B', 'CAN-F203A', 'CAN-F204B', 'CAN-F204A'];
        $this->canoni['/gsu/assistenza-tecnica-multifunzione'] = ['CAN-G081A', 'CAN-G081B'];
        $this->canoni['/gsu/consumabile-nero'] = ['CAN-G082-001B'];
        $this->canoni['/gsu/consumabile-colori'] = ['CAN-G082-002B'];
        $this->canoni['/gsu/assistenza-tecnica-hardware'] = ['CAN-G101A','CAN-G101M', 'CAN-G102A', 'CAN-G105A', 'CAN-G106A', 'CAN-G107A', 'CAN-G102-001A', 'CAN-G105-001A', 'CAN-G106-001A', 'CAN-G107-001A', 'CAN-G101B'];
        $this->canoni['/gsu/hardware'] = ['CAN-F401A', 'CAN-F401B'];
        $this->canoni['/gsu/mail-server'] = ['CAN-G104A'];
        $this->canoni['/gsu/utente-aggiuntivo-ms'] = ['CAN-G104-001A'];
        $this->canoni['/gsu/terminal-server'] = ['CAN-G103A'];
        $this->canoni['/gsu/utente-aggiuntivo'] = ['CAN-G101-001A'];
        $this->canoni['/gsu/utente-aggiuntivo-ts'] = ['CAN-G103-001A'];
        $this->canoni['/gsu/assistenza-tecnica'] = ['CAN-G002A', 'CAN-G002B'];
        $this->canoni['/gsu/servizi-access'] = ['CAN-G061', 'CAN-G061A', 'CAN-G061B', 'CAN-G062', 'CAN-G062A', 'CAN-G062B'];
        $this->canoni['/gsu/caselle'] = ['CAN-E062A', 'CAN-E062B', 'CAN-E061B', 'CAN-E061A', 'CAN-E061M', 'CAN-E063A', 'CAN-E063B', 'CAN-E064A', 'CAN-E064B', 'CAN-E11A', 'CAN-E11B', 'CAN-E111A', 'CAN-E111B', 'CAN-E112A', 'CAN-E112B', 'CAN-E113A', 'CAN-E113B','CAN-E081A', 'CAN-E081B', 'CAN-E082-001A', 'CAN-E082-002A', 'CAN-E082-003A', 'CAN-E082-004A', 'CAN-E082-005A', 'CAN-E082-006A', 'CAN-E082-007A', 'CAN-E082-008A', 'CAN-E082-009A', 'CAN-E082-010A', 'CAN-E082-001B', 'CAN-E082-002B', 'CAN-E082-003B', 'CAN-E082-004B', 'CAN-E082-005B', 'CAN-E082-006B', 'CAN-E082-007B', 'CAN-E082-008B', 'CAN-E082-009B', 'CAN-E082-010B'];
        $this->canoni['/gsu/database'] = ['CAN-E031A', 'CAN-E031B'];
        $this->canoni['/gsu/housing'] = ['CAN-E021A', 'CAN-E021B'];
        $this->canoni['/gsu/outlook'] = ['CAN-E131A', 'CAN-E131B'];
        $this->canoni['/gsu/activesync'] = ['CAN-E132A', 'CAN-E132B'];
        $this->canoni['/gsu/dial-up'] = ['CAN-A002A', 'CAN-A004A', 'CAN-A001A'];
        $this->canoni['/gsu/direct-access'] = ['CAN-D011B', 'CAN-D012B', 'CAN-D013B', 'CAN-D014B', 'CAN-D015B', 'CAN-D016B', 'CAN-D017B', 'CAN-D018B', 'CAN-D019B', 'CAN-D021B', 'CAN-D022B', 'CAN-D023B', 'CAN-D024B', 'CAN-D025B', 'CAN-D026B', 'CAN-D027B', 'CAN-D028B', 'CAN-D028M', 'CAN-D042B', 'CAN-D051B', 'CAN-D052B', 'CAN-D053B', 'CAN-D033B', 'CAN-D054B', 'CAN-D055B'];
        $this->canoni['/gsu/domini'] = ['CAN-E001A', 'CAN-E001B', 'CAN-E10A', 'CAN-E10B', 'CAN-E101A', 'CAN-E101B'];
        $this->canoni['/gsu/dpss'] = ['CAN-G053A', 'CAN-G054A'];
        $this->canoni['/gsu/hosting'] = ['CAN-E011A', 'CAN-E011B', 'CAN-E012A', 'CAN-E012B', 'CAN-E013A', 'CAN-E013B', 'CAN-E014A', 'CAN-E014B', 'CAN-E014M', 'CAN-E015A', 'CAN-E015B', 'CAN-E016A', 'CAN-E016B', 'CAN-E017A', 'CAN-E017B', 'CAN-E018A', 'CAN-E018B', 'CAN-E019A', 'CAN-E019B'];
        $this->canoni['/gsu/mailarchive'] = ['CAN-E121-001A', 'CAN-E121-002A', 'CAN-E121-003A', 'CAN-E121-004A', 'CAN-E121-005A', 'CAN-E121-006A', 'CAN-E121-007A', 'CAN-E121-008A', 'CAN-E121-009A'];
        $this->canoni['/gsu/faxvirtuale'] = ['CAN-F017B'];
        $this->canoni['/gsu/videoconference'] = ['CAN-F041A'];
        $this->canoni['/gsu/ipstatici'] = ['CAN-E091A', 'CAN-E091B' , 'CAN-E092A', 'CAN-E092B', 'CAN-E093B'];
        $this->canoni['/gsu/webmarketing'] = ['CAN-E041A', 'CAN-E041B'];
        $this->canoni['/gsu/novirusnospam'] = ['CAN-E051A', 'CAN-E051B', 'CAN-E052-001A', 'CAN-E052-002A', 'CAN-E052-003A', 'CAN-E052-004A', 'CAN-E052-005A', 'CAN-E052-006A', 'CAN-E052-007A', 'CAN-E052-008A', 'CAN-E052-009A', 'CAN-E052-010A'];
        $this->canoni['/gsu/postwarranty'] = ['CAN-G041A', 'CAN-G041B'];
        $this->canoni['/gsu/smartnet'] = ['CAN-G021A', 'CAN-G021B'];
        $this->canoni['/gsu/gestione-apparato'] = ['CAN-G022A', 'CAN-G022B'];
        $this->canoni['/gsu/software'] = ['SOFTWARE', 'CAN-SW001A', 'CAN-SW011A', 'CAN-SW021-001A', 'CAN-SW022-001A','CAN-SW022-002A','CAN-SW022-003A','CAN-SW022-004A','CAN-SW022-005A','CAN-SW022-006A','CAN-SW022-007A','CAN-SW022-008A','CAN-SW022-009A','CAN-SW031A','CAN-SW032A','CAN-SW033A','CAN-SW034A','CAN-SW035A','CAN-SW036A','CAN-SW037A','CAN-SW038A','CAN-SW039A','CAN-SW041A','CAN-SW042A','CAN-SW043A','CAN-SW044A','CAN-SW045A','CAN-SW046A','CAN-SW047A','CAN-SW048A','CAN-SW049A','CAN-SW051A','CAN-SW052A','CAN-SW053A','CAN-SW054A','CAN-SW055A','CAN-SW056A','CAN-SW057A','CAN-SW058A', 'CAN-SW062A', 'CAN-SW061A', 'CAN-SW067A'];
        $this->canoni['/gsu/teleassistenza'] = ['CAN-F002A', 'CAN-F002B'];
        $this->canoni['/gsu/voicegate'] = ['CAN-G031A', 'CAN-G031B'];
        $this->canoni['/gsu/ipmultimedia'] = ['CAN-G032-002A', 'CAN-G032-001B', 'CAN-G032-002B', 'CAN-G032-003B', 'CAN-G032-004B'];
        $this->canoni['/gsu/vpn'] = ['CAN-G011A', 'CAN-G011B', 'CAN-G011M'];
        $this->canoni['/gsu/mpls'] = ['CAN-L001M', 'CAN-L001B', 'CAN-L002M', 'CAN-L002B', 'CAN-L003M', 'CAN-L003B', 'CAN-L004M', 'CAN-L004B', 'CAN-L005B', 'CAN-L006B', 'CAN-L007B', 'CAN-L008B'];
        $this->canoni['/gsu/mpls-direct-access'] = ['CAN-M001M', 'CAN-M001B', 'CAN-M002M', 'CAN-M002B', 'CAN-M003M', 'CAN-M003B', 'CAN-M004M', 'CAN-M004B', 'CAN-M005B', 'CAN-M006B', 'CAN-M007B', 'CAN-M008B', 'CAN-M011B', 'CAN-M021B', 'CAN-M031B'];
        $this->canoni['/gsu/web-hat'] = ['CAN-E071A', 'CAN-E071B', 'CAN-E072A', 'CAN-E072B', 'CAN-E073A', 'CAN-E073B', 'CAN-E074A', 'CAN-E074B', 'CAN-E075A'];
        $this->canoni['/gsu/unigate'] = ['CAN-H001A'	,'CAN-H001B', 'CAN-H002A', 'CAN-H002B', 'CAN-H002-001A', 'CAN-H002-001B', 'CAN-H002-001B','CAN-H002-002A', 'CAN-H002-002B', 'CAN-H002-003A', 'CAN-H002-003B', 'CAN-H003A', 'CAN-H003B', 'CAN-H003B','CAN-H003-001A', 'CAN-H003-001B', 'CAN-H003-002A', 'CAN-H003-002B', 'CAN-H003-002B', 'CAN-H003-004B', 'CAN-H011B', 'CAN-H101M', 'CAN-H004-001B', 'CAN-H004-002B', 'CAN-H004-003B', 'CAN-H004-004B', 'CAN-H005-001B', 'CAN-H005-002B'];
        $this->canoni['/gsu/unigate-numeri'] = ['CAN-H102A', 'CAN-H102B','CAN-H101A', 'CAN-H101B'];
        $this->canoni['/gsu/url-filtering'] = ['CAN-F031A', 'CAN-F031B'];

    }
   
    public function getRouteByCanone($canone){
        foreach($this->canoni as $key => $values){
            if(in_array($canone, $values)){
                return $key;
            }
        }
        return "/gsu/main";
    }

}

