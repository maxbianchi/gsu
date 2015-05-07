@extends('gsu::app')




@section('content')
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-4 col-md-offset-8" ><div class="pull-right">Ragione sociale<input type="text" id="search" name="search"><input type="button" value="cerca"></div> </div>
        </div>
        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-4"><input type="button" value="TUTTE LE RICHIESTE" class="btn btn-primary"></div>
            <div class="col-md-offset-8" ></div>
        </div>
        <!-- GRUPPO A B C D L M -->
        Gruppi A - B -C -D -L - M
        <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="DIAL-UP ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="APPARATI DIAL-UP ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="ADSL ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="APPARATI ADSL ACCESS" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="LINEAR DIRECT ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="APPARATI LINEAR DIRECT ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="FLAT DIRECT ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="APPARATI FLAT DIRECT ACCESS" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="LINEA AGGIUNTIVA" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MPLS ADSL ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MPLS FLAT DIRECT ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"></div>
        </div>
    </div>



    <!-- GRUPPO E -->
    Gruppo E
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="DOMINIO" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="HOSTING" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="HOUSING" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SUPPORTO DATABASE" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="WEB MARKETING" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="NOVIRUS / NOSPAM / SCAN-MAIL" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="CASELLE DI POSTA" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="CMS" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="RELAY DI POSTA / SMTP AUTH" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="IP STATICI" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="DOMINIO PEC" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="CASELLE DI POSTA PEC" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="EMAIL BACKUP" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI POSTA AVANZATI" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>


    <!-- GRUPPO F -->
    Gruppo F
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="IP-SAFE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="URL FILTERING FIREWALL" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MULTIFUNZIONI" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="CENTRALINI" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="APPARATI MOBILE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="HARDWARE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="FAX VIRTUALE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="VIDEOCONFERENCE" class="btn btn-default btn-xs"></div>
        </div>
    </div>


    <!-- GRUPPO G -->
    Gruppo G
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="ASSISTENZA CENTRALINO" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="VPN" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SMARTNET ROUTER FIREWALL" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="TELEFONIA SU IP" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="POST WARRANTY HW" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="DPSS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI ACCESS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SERVIZI PLUS / SINFONIA" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="ASSISTENZA MULTIFUNZIONE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="ASSISTENZA TECNICA HW" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!-- GRUPPO H -->
    Gruppo H
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="UNIGATE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>



    <!-- GRUPPO I -->
    Gruppo I
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE SIM VOCE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE SIM M2M" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE SIM TWIN" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE EXTENSION" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE FAX E DATI" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONI ROAMING" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONI INTERCOM" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="TASSA GOVERNATIVA" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONE DATI" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE OPZIONE DATI ESTERO" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE ASSISTENZA TECNICA" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MOBILE FILTRO ACCESSI" class="btn btn-default btn-xs"></div>
        </div>
    </div>



    <!-- GRUPPO SOFTWARE -->
    Gruppo Software
    <div class="border">
        <div class="row">
            <div class="col-md-3"><input type="button" value="ANTIVIRUS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="BACKUP" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="MDAEMON" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="OUTLOOK CONNECTOR" class="btn btn-default btn-xs"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><input type="button" value="SECURITY PLUS" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="BACKUP WORKPLACE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="SOFTWARE" class="btn btn-default btn-xs"></div>
            <div class="col-md-3"><input type="button" value="ACTIVESYNC" class="btn btn-default btn-xs"></div>
        </div>
    </div>


</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $('.btn').click(function(){
                location.href='{{url("gsu/main")}}';
            });
        });
    </script>
@endsection
