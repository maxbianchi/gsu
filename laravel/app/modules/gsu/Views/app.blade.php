<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

    <link href="{{ asset('/css/jqueryui/1.8.14/themes/redmond/jquery-ui.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/3.3.4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/3.3.4/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.dataTables.css') }}" rel="stylesheet">



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

        .dataTables_filter{
            display:none;
        }
    </style>
    @yield('css')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
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
                <div style="margin-left: 40%;position: absolute;top: 15px;">{{Session::get('user')['DESCRIZIONE']." ".Session::get('user')['INDIRIZZO']." ".Session::get('user')['LOCALITA']}}</div>
                
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Session::get('logged')  == 1)
                            <li><a href="{{ url('/logout') }}" title="Logout">Logout</a></li>
                        @endif
                    </ul>
				</ul>
			</div>
		</div>
	</nav>

    @if(View::exists('gsu::varie.menu'))
        @include('gsu::varie.menu')
    @endif

	@yield('content')


	<!-- Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery/2.1.3/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/bootstrap/3.3.4/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jqueryui/1.11.4/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.smartmenus.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#main-menu').smartmenus({
                subMenusSubOffsetX: 1,
                subMenusSubOffsetY: -8
            });
        });
    </script>

    @yield('script')
</body>
</html>
