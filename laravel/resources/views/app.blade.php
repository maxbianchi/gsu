<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Uniweb srl - portale 4.1</title>

    <link href="{{ asset('/css/jqueryui/1.11.4/themes/redmond/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.dataTables.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    @yield('css')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                <a href="{{ url('/dashboard') }}"><img src="{{ URL::asset('images/logo_slogan.png') }}" alt="Uniweb 4.1 Dashboard" style="width:150px;" title="Uniweb 4.1 Dashboard"></a>

                <div style="margin-left: 40%;position: absolute;top: 15px;"><b>{{utf8_encode(Session::get('user')['username']." - ".Session::get('user')['DESCRIZIONE']." ".Session::get('user')['INDIRIZZO']." ".Session::get('user')['LOCALITA']) }}</b></div>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Session::get('livello')  == 1)
                            <li><a href="{{ url('/riferimenti') }}">Gestione Riferimenti</a></li>
                            <li><a href="{{ url('/users') }}">Gestione Utenti</a></li>
                        @endif
                        @if (Session::get('logged')  == 1)
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
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>

    @yield('script')

    <div id="footer" class="container_12">
        <div class="container">
        <div class="row">
        <table>
            <tr>
                <td style="width:20%;text-align:left;border:none !important;" valign="top" class="footer_td">
                    <img src="{{ URL::asset('images/logo1.png') }}" style="width:60%;">
                </td>
                <td style="width:20%;" valign="top" class="footer_td">
                    <strong>Uniweb Srl</strong><br>
                    Cantu' (CO) - 22063 <br> Via Milano, 51 <br> <a href="{{url('/cookie-policy')}}">Cookie policy</a>
                </td>
                <td style="width:20%;" valign="top" class="footer_td">
                    Tel. +39 031 701728 r.a. <br> Fax +39 031 7073755  <br> E-mail:<a href="mailto:info@uniweb.it">info@uniweb.it</a> <br> Pec: info@pec.uniweb.it
                </td>
                <td style="width:20%;" valign="top" class="footer_td">
                    CF / P.IVA 02478160134 <br> Reg. Imp. di Como n. 02478160134 <br> Cap. Soc.: € 15.000,00 i.v. <br> CCIAA Como REA n. 262922
                </td>
                <td style="width:20%;" class="footer_td">
                    <img src="{{ URL::asset('images/iso.png') }}" style="width:90%;float:right;" valign="top">
                </td>
            </tr>
        </table>
        </div>
        </div>
    </div>


</body>
</html>
