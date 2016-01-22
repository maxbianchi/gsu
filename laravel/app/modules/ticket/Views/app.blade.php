<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Uniweb srl - portale 4.0</title>

    <link href="{{ asset('/css/jqueryui/1.11.4/themes/redmond/jquery-ui.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/3.3.4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/3.3.4/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ URL::asset('css/sm-core-css.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/sm-blue/sm-blue.css') }}" />
    <style type="text/css">
        #main-menu {
            position:relative;
            z-index:9999;
            width:auto;
        }
        #main-menu ul {
            width:12em; /* fixed width only please - you can use the "subMenusMinWidth"/"subMenusMaxWidth" script options to override this if you like */
        }

        /*.dataTables_filter{
            display:none;
        }*/
    </style>
    @yield('css')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="gsu">
<div id="container">
	<nav class="navbar navbar-default" style="margin-bottom:0px !important">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                <a href="{{ url('/dashboard') }}"><img src="{{ URL::asset('images/Banner.png') }}" alt="Uniweb 4.0 Dashboard" title="Uniweb 4.0 Dashboard"></a>
                <div style="margin-left: 40%;position: absolute;top: 16px;"><b>{{utf8_encode(Session::get('user')['username']." - ".Session::get('user')['DESCRIZIONE']." ".Session::get('user')['INDIRIZZO']." ".Session::get('user')['LOCALITA']) }}</b>
                    <span style="padding-left:100px!important;color:#283891;font-size:22px;"><?php !empty($tableName) ? print_r("SEZIONE $tableName") : ""?></span>
                </div>


			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Session::get('logged')  == 1)
                            <li><a href="{{URL::asset('manuali/MANUALE-ATTIVITA.pdf')}}" title="MANUALE"><b>MANUALE</b></a></li>
                            <li><a href="{{ url('/logout') }}" title="Logout"><b>Logout</b></a></li>
                        @endif
                    </ul>
				</ul>
			</div>
		</div>
	</nav>


        <div id="content">
	        @yield('content')
        </div>
</div>
	<!-- Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery/2.1.3/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/bootstrap/3.3.4/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jqueryui/1.11.4/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.tableTools.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.smartmenus.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#main-menu').smartmenus({
                subMenusSubOffsetX: 1,
                subMenusSubOffsetY: -8
            });

            @if (Session::get('livello')  == 1)

            $('.search_fornitore').autocomplete({
                source: '/ticket/getclienti',
                minLength: 2,
                select: function(event, ui) {
                }
            });

            $('#search_fornitore').autocomplete({
                source: '/ticket/getclienti',
                minLength: 2,
                select: function(event, ui) {
                    $.get("{{url('/ticket/getsingleuser')}}", { 'descrizione' : $('#search_cliente').val()})
                            .done(function (json) {
                                $("#fornitore").html("");
                                json = JSON.parse(json);
                                $("#fornitore").append('<option value="">-----</option>')
                                $(json).each(function(index,data){
                                    $("#fornitore").append('<option value="' + data.SOGGETTO + '">' + data.DESCRIZIONE + ' - ' + data.INDIRIZZO + ' - ' + data.LOCALITA + ' - ' + data.PROVINCIA + ' - ' + data.SOGGETTO + ' - PIVA: ' + data.PARTITAIVA + '</option>')
                                })

                            });
                }
            });

                $('.search_anagrafica').autocomplete({
                    source: '/ticket/getclienti',
                    minLength: 2,
                    select: function(event, ui) {
                    }
                });

                $('#search_cliente').autocomplete({
                    source: '/ticket/getclienti',
                    minLength: 2,
                    select: function(event, ui) {
                        $.get("{{url('/ticket/getsingleuser')}}", { 'descrizione' : $('#search_cliente').val()})
                                .done(function (json) {
                                    $("#cliente").html("");
                                    json = JSON.parse(json);
                                    $("#cliente").append('<option value="">-----</option>')
                                    $(json).each(function(index,data){
                                        $("#cliente").append('<option value="' + data.SOGGETTO + '">' + data.DESCRIZIONE + ' - ' + data.INDIRIZZO + ' - ' + data.LOCALITA + ' - ' + data.PROVINCIA + ' - ' + data.SOGGETTO + ' - PIVA: ' + data.PARTITAIVA + '</option>')
                                    })

                                });
                    }
                });

                $('#search_cliente_finale').autocomplete({
                    source: '/ticket/getclienti',
                    minLength: 2,
                    select: function(event, ui) {
                        $.get("{{url('/ticket/getsingleuser')}}", { 'descrizione' : $('#search_cliente_finale').val()})
                                .done(function (json) {
                                    $("#cliente_finale").html("");
                                    $("#cliente_finale").append('<option value="">-----</option>')
                                    json = JSON.parse(json);
                                    $(json).each(function(index,data){
                                        $("#cliente_finale").append('<option value="' + data.SOGGETTO + '">' + data.DESCRIZIONE + ' - ' + data.INDIRIZZO + ' - ' + data.LOCALITA + ' - ' + data.PROVINCIA + ' - ' + data.SOGGETTO + ' - PIVA: ' + data.PARTITAIVA + '</option>')
                                    })

                                });
                    }
                });

            $('#search_ubicazione').autocomplete({
                source: '/ticket/getclienti',
                minLength: 2,
                select: function(event, ui) {
                    $.get("{{url('/ticket/getsingleuser')}}", { 'descrizione' : $('#search_ubicazione').val()})
                            .done(function (json) {
                                $("#ubicazione_impianto").html("");
                                json = JSON.parse(json);
                                $("#ubicazione_impianto").append('<option value="">-----</option>')
                                $(json).each(function(index,data){
                                    $("#ubicazione_impianto").append('<option value="' + data.SOGGETTO + '">' + data.DESCRIZIONE + ' - ' + data.INDIRIZZO + ' - ' + data.LOCALITA + ' - ' + data.PROVINCIA + ' - ' + data.SOGGETTO + ' - PIVA: ' + data.PARTITAIVA + '</option>')
                                })

                            });
                }
            });
            @endif;

            @if (Session::get('livello')  == 2)
                $('.search_clienti').autocomplete({
                    source: '/gsu/getclienti',
                    minLength: 2,
                    select: function(event, ui) {
                        $.get("{{url('/ticket/getsingleuser')}}", { 'descrizione' : $('#search_cliente_finale').val()})
                                .done(function (json) {
                                    $("#cliente_finale").html("");
                                    json = JSON.parse(json);
                                    $(json).each(function(index,data){
                                        $("#cliente_finale").append('<option value="' + data.SOGGETTO + '">' + data.DESCRIZIONE + ' - ' + data.INDIRIZZO + ' - ' + data.LOCALITA + ' - ' + data.PROVINCIA + ' - ' + data.SOGGETTO + '</option>')
                                    })

                                });
                    }
                });

                $("#cliente").attr("disabled", "disabled");
            @endif;

            @if (Session::get('livello')  == 3)
                $("#cliente").attr("disabled", "disabled");
                $("#cliente_finale").attr("disabled", "disabled");
            @endif;

        });
    </script>

    @yield('script')


    <!--<div id="footer" class="container_12">
        <strong>Uniweb Srl</strong>
        - Via Milano, 51 - 22063 Cantú (CO) - CF / P.IVA 02478160134
        <br>
        Tel. +39 031 701728 r.a. - Fax +39 031 7073755 - E-mail:
        <a href="mailto:info@uniweb.it">info@uniweb.it</a>
        <br>
        Reg. Imp. di Como n° 02478160134 - Capitale Sociale: € 15.000,00 i.v. - CCIAA Como REA n° 262922 - <a href="{{url('/cookie-policy')}}">Cookie policy</a>
    </div>-->


</body>
</html>
