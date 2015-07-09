@extends('app')


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <img style="display:block;margin-left:auto;margin-right:auto;" src="{{ URL::asset('images/areariservata.jpg') }}">
            </div>
        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading"><ul type="square"><li>Visualizza i tuoi <b>servizi attivi</b> presso UNIWEB tramite il portale uniweb 4.0</li></ul><span class="pull-right"></span></div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('/gsu/index')}}'">GSU</button>
                        </div>

                        <div class="col-md-3">
                            <img style="width:180px;" src="{{ URL::asset('images/logo.png') }}">
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading"><ul type="square"><li>Visualizza il tuo <b>traffico mobile</b> dal portale uniweb mobile 4.0</li></ul><span class="pull-right"></span></div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <button type="button" class="btn btn-primary mobile">MOBILE</button>
                        </div>

                        <div class="col-md-3">
                            <img style="width:180px;" src="{{ URL::asset('images/telecom-italia.gif') }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading"><ul type="square"><li>Visualizza il tuo <b>traffico Voip</b> tramite il portale uniweb 4.0</li></ul><span class="pull-right"></span></div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <button type="button" class="btn btn-primary unigate">UNIGATE</button>
                        </div>

                        <div class="col-md-3">
                            <img src="{{ URL::asset('images/logo_unigate.png') }}">
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading"><ul type="square"><li>Utilizza il servizio ORION per monitorare il tuo servizio web</li></ul><span class="pull-right"></span></div>

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <button type="button" class="btn btn-primary orion">ORION</button>
                        </div>

                        <div class="col-md-3">
                            <img style="width:290px;" src="{{ URL::asset('images/orion.gif') }}">
                        </div>

                    </div>
                </div>

            </div>

        </div>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading"><ul type="square"><li>Utilizza il servizio webfax tramite il portale uniweb 4.0</li></ul><span class="pull-right"></span></div>

            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-3 col-md-offset-2">
                        <button type="button" class="btn btn-primary webfax">WEBFAX</button>
                    </div>

                    <div class="col-md-3">
                        <img style="width:190px;" src="{{ URL::asset('images/webfax.png') }}">
                    </div>

                </div>
            </div>

        </div>

    </div>
    </div>



    <form method="post" action="http://mobile.uniweb.it/index.asp" id="form_mobile">
        <input type="hidden" name="UTENTELOG" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="PASSWORDLOG" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://unigate.uniweb.it/index.asp" id="form_unigate">
        <input type="hidden" name="username" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="password" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://npm.uniweb.it/Orion/Login.aspx/" id="form_orion">
        <input type="hidden" name="ctl00$ContentPlaceHolder1$Username" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="ctl00$ContentPlaceHolder1$Password" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://webfax.uniweb.it/" id="form_webfax">
        <input type="hidden" name="username" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="password" value="{{Session::get('user')['password']}}">
    </form>

    <style>
        .form-group .btn{
            min-width:240px !important;
        }
    </style>

@endsection

@section('script')
    <script>
        $(function() {
            $(".mobile").click(function(){
                $("#form_mobile").submit();
            });
            $(".unigate").click(function(){
                $("#form_unigate").submit();
            });
            $(".webfax").click(function(){
                $("#form_webfax").submit();
            });
            $(".orion").click(function(){
                $("#form_orion").submit();
            });
        });
    </script>
@endsection