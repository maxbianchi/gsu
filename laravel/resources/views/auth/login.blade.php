@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login_style.css') }}" />
@endsection

@section('content')

    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <img src="{{ URL::asset('images/areariservata_login.jpg') }}" alt="Uniweb 4.0 Dashboard" title="Uniweb 4.0 Dashboard" style="width:84%; padding-left:10px;">
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading " style="text-align: right;">Benvenuto nel Nuovo <b>Portale Uniweb 4.1</b>, la tua area riservata!</div>
                    <div class="panel-body">
                        <div><b><a href="{{ url('/registrazione') }}" style="text-decoration: underline;">Se non sei ancora registrato clicca qui</a></b></div>
                        @if (count(Session::get('errors')) > 0)
                            <div class="alert alert-danger">
                                {{ Session::get('errors') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ url('/login') }}" class="form-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h1><span class="sign-up">Log in</span> </h1>
                            <p class="float">
                                <label for="login"><i class="icon-user"></i>Username</label>
                                <input type="text" name="username" placeholder="Username or email" required>
                            </p>
                            <p class="float">
                                <label for="password"><i class="icon-lock"></i>Password</label>
                                <input type="password" name="password" placeholder="Password" class="showpassword" required>
                            </p>
                            <div class="center">

                                <input type="submit" name="submit" value="Log in">
                            </div>

                            <p style="padding-top:10px;"><a href="{{url('/password')}}" title="Recupera la tua password di accesso">Hai dimenticato la tua password?</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.cookiebar.css') }}" />
    <script type="text/javascript" src="{{ asset('/js/jquery.cookiebar.js') }}"></script>
    <script>
        $(document).ready(function(){
            $.cookieBar({
            });

            $("#banner").find("img").hover(function(){
                $("#banner").find("img").attr("alt","TORNA AL SITO UNIWEB");
                $("#banner").find("img").attr("title","TORNA AL SITO UNIWEB");
            });
            $("#banner").click(function(){
                $("#banner").attr("href","http://www.uniweb.it");
            });


        });
    </script>

@endsection
