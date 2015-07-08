@extends('gsu::app')




@section('content')

    <?php

    $livello = Session::get('livello');
    $checkBoxStart = "&daattivare=on&attivati=on&disattivati=on&dadisattivare=on";
    if($livello == 1) {
        $checkBoxStart = "&daattivare=on";
    }

    ?>

    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-4"><input type="button" value="TUTTE LE RICHIESTE" class="btn btn-primary" pagina="{{url('/gsu/main')."?".$checkBoxStart}}"></div>
            <div class="col-md-4 col-md-offset-4" >
                @if (Session::get('livello')  == 1)
                    <div class="pull-right ui-widget">Ricerca anagrafica<form method="get" action="{{url('/gsu/anagrafica')."?".$checkBoxStart}}"><input type="text" id="search_anagrafica" class="search_anagrafica" name="search_anagrafica"><input type="submit" value="cerca"></form></div>
                @endif
            </div>
        </div>

        <!-- GRUPPO A B C D L M -->
        Gruppi A - B -C -D -L - M
        <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="DIAL-UP ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-A0').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="APPARATI DIAL-UP ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-A1').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="ADSL ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-B0').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="APPARATI ADSL ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-B1').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="LINEA DIRECT ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-C0').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="APPARATI LINEAR DIRECT ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-C1').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="FLAT DIRECT ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-D0').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="APPARATI FLAT DIRECT ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-D1').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="LINEA AGGIUNTIVA" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-B20').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MPLS ADSL ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-L0').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MPLS FLAT DIRECT ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-M0').$checkBoxStart}}"></div>
            <div class="col-md-3"></div>
        </div>
    </div>



    <!-- GRUPPO E -->
    Gruppo E
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="DOMINIO" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E00').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="HOSTING" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E01').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="HOUSING" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E02').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SUPPORTO DATABASE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E03').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="WEB MARKETING" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E04').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="NOVIRUS / NOSPAM / SCAN-MAIL" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E05').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="CASELLE DI POSTA" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E06').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="CMS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E07').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="RELAY DI POSTA / SMTP AUTH" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E08&filtro=Relay').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="IP STATICI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E09').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="DOMINIO PEC" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E10').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="CASELLE DI POSTA PEC" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E11').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="EMAIL BACKUP" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E12').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI POSTA AVANZATI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-E13').$checkBoxStart}}"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>


    <!-- GRUPPO F -->
    Gruppo F
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="IP-SAFE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F02').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="URL FILTERING FIREWALL" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F03').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MULTIFUNZIONI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F10').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="CENTRALINI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F20').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="APPARATI MOBILE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F30').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="HARDWARE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F40').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="FAX VIRTUALE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F01').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="VIDEOCONFERENCE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-F04').$checkBoxStart}}"></div>
        </div>
    </div>


    <!-- GRUPPO G -->
    Gruppo G
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="ASSISTENZA CENTRALINO" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G00').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="VPN" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G01').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SMARTNET ROUTER FIREWALL" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G02').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="TELEFONIA SU IP" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G03').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="POST WARRANTY HW" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G04').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="DPSS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G05').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI ACCESS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G06').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI PLUS / SINFONIA" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G07').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="ASSISTENZA MULTIFUNZIONE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G08').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="ASSISTENZA TECNICA HW" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-G10').$checkBoxStart}}"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!-- GRUPPO H -->
    Gruppo H
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="UNIGATE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-H').$checkBoxStart}}"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>



    <!-- GRUPPO I -->
    Gruppo I
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE SIM VOCE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I00').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE SIM M2M" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I01').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE SIM TWIN" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I02').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE EXTENSION" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I03').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE FAX E DATI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I04').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONI ROAMING" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I05').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONI INTERCOM" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I06').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="TASSA GOVERNATIVA" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I10').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONE DATI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I11').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONE DATI ESTERO" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I12').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE ASSISTENZA TECNICA" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I20').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MOBILE FILTRO ACCESSI" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-I21').$checkBoxStart}}"></div>
        </div>
    </div>



    <!-- GRUPPO SOFTWARE -->
    Gruppo Software
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="ANTIVIRUS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW00').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="BACKUP" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW01').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="MDAEMON" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW02').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="OUTLOOK CONNECTOR" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW03').$checkBoxStart}}"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="SECURITY PLUS" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW04').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="BACKUP WORKPLACE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW05').$checkBoxStart}}"></div>
            <div class="col-md-3"><input type="button" value="SOFTWARE" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=SOFTWARE').$checkBoxStart}}"> </div>
            <div class="col-md-3"><input type="button" value="ACTIVESYNC" class="btn btn-default btn-xs" pagina="{{url('/gsu/search?canone=CAN-SW06').$checkBoxStart}}"></div>
        </div>
    </div>


</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('.btn').click(function(element){
                var pagina = $(this).attr("pagina");
                location.href=pagina;
            });
        });
    </script>
@endsection
