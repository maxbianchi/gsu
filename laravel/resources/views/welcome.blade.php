@extends('app')


@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-12" style="padding:0px;">
                <img style="display:block;margin-left:auto;margin-right:auto;width:100%;padding:0px !important;" src="{{ URL::asset('images/areariservata.jpg') }}">
            </div>
        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1">Visualizza i tuoi <b>servizi attivi</b></div>
                        <div class="col-md-6">Visualizza il tuo <b>traffico mobile</b></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!--/**/-->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('/gsu/index')}}'">GSU</button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:180px;" src="{{ URL::asset('images/logo.png') }}">
                        </div>
                        <!--/**/-->
                        <div class="col-md-1 col-md-offset-3">
                            <button type="button" class="btn btn-primary mobile">MOBILE</button>
                        </div>

                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:180px;" src="{{ URL::asset('images/telecom-italia.gif') }}">
                        </div>
                        <!--/**/-->


                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1">Visualizza il tuo <b>traffico Voip</b></div>
                        <div class="col-md-6">Utilizza il servizio ORION per <b>monitorare i tuoi servizi di connettivit&agrave;</b></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!--/**/-->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary unigate">UNIGATE</button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <img src="{{ URL::asset('images/logo_unigate.png') }}">
                        </div>
                        <!--/**/-->
                        <div class="col-md-1 col-md-offset-3" >
                            <button type="button" class="btn btn-primary orion">ORION</button>
                        </div>

                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:260px;" src="{{ URL::asset('images/orion.gif') }}">
                        </div>
                        <!--/**/-->


                    </div>
                </div>

            </div>

        </div>


        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1">Visualizza il tuo <b>traffico webfax</b></div>
                        <div class="col-md-6"></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!--/**/-->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary webfax">WEBFAX</button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:190px;" src="{{ URL::asset('images/webfax.png') }}">
                        </div>
                        <!--/**/-->

                        <!--/**/-->


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
            min-width:150px !important;
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