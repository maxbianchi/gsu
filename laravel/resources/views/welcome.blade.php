@extends('app')


@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-12" style="padding:0px;">
                <img style="display:block;margin-left:auto;margin-right:auto;width:100%;padding:0px !important;" src="{{ URL::asset('images/areariservata3.jpg') }}">
            </div>
        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1">Visualizza i tuoi <b>servizi attivi</b></div>
                        <div class="col-md-4 col-md-offset-2">Visualizza il tuo <b>traffico mobile</b></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!--/**/-->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" onclick="window.open('{{url('/gsu/index')}}' ,'_blank')">GSU</button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:130px;margin-top:-10px;" src="{{ URL::asset('images/logo_slogan.png') }}">
                        </div>
                        <!--/**/-->
                        <div class="col-md-1 col-md-offset-3">
                            <button type="button" class="btn btn-primary mobile">MOBILE</button>
                        </div>

                        <div class="col-md-2 col-md-offset-1">
                            <!--<img style="width:180px;" src="{{ URL::asset('images/telecom-italia.gif') }}">-->
                            <img style="height:35px;" src="{{ URL::asset('images/logotim.png') }}">
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
                        <div class="col-md-5 col-md-offset-1">Visualizza il tuo <b>traffico Voip e CSE</b></div>
                        <div class="col-md-6 pull-right text-right">Utilizza il servizio ORION per <b>monitorare i tuoi servizi di connettivit&agrave;</b></div>
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
                            <img style="width:100px;" src="{{ URL::asset('images/orion.gif') }}">
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
                        <div class="col-md-4 col-md-offset-2">Apri un <b>attivit&agrave; / Ticket</b></div>
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
                        @if (Session::get('livello')  == 1)
                        <div class="col-md-1 col-md-offset-3" >
                            <button type="button" class="btn btn-primary" onclick="window.open('{{url('/ticket/alltickets?stato=0&tecnico=').Session::get('idtecnico')}}' ,'_blank')">ATTIVITA/TICKET</button>
                        </div>

                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:190px;" src="{{ URL::asset('images/ticket.jpg') }}">
                        </div>
                        @else
                            <div class="col-md-1 col-md-offset-3" >
                                <button type="button" class="btn btn-primary" onclick="window.open('{{url('/ticket/clientticket?stato=0')}}' ,'_blank')">ATTIVITA/TICKET</button>
                            </div>

                            <div class="col-md-2 col-md-offset-1">
                                <img style="width:190px;" src="{{ URL::asset('images/ticket.jpg') }}">
                            </div>
                        @endif
                        <!--/**/-->


                    </div>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-1"><b>Unithings</b></div>
                        <div class="col-md-4 col-md-offset-2"><b>Unistore</b></div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <!--/**/-->
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary unithings" onclick="window.open('{{url('http://www.unithings.it')}}' ,'_blank')" >Unithings</button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <img style="width:150px;position:relative;top:-10px;" src="{{ URL::asset('images/unithings.png') }}">
                        </div>
                        <!--/**/-->
                        <div class="col-md-1 col-md-offset-3" >
                            <button type="button" class="btn btn-primary unistore" onclick="window.open('{{url('https://controlpanel.cloud.uniweb.it/single.html')}}' ,'_blank')">UNISTORE</button>
                        </div>

                        <div class="col-md-2 col-md-offset-1">
                            <!--<img style="width:190px;" src="{{ URL::asset('images/ticket.jpg') }}">-->
                        </div>

                                    <!--/**/-->


                    </div>
                </div>

            </div>

        </div>

    </div>





    <form method="post" action="http://mobile.uniweb.it/index.asp" id="form_mobile" target="_blank">
        <input type="hidden" name="UTENTELOG" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="PASSWORDLOG" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://unigate.uniweb.it/index.asp" id="form_unigate" target="_blank">
        <input type="hidden" name="username" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="password" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://npm.uniweb.it/Orion/Login.aspx/" id="form_orion" target="_blank">
        <input type="hidden" name="ctl00$ContentPlaceHolder1$Username" value="{{Session::get('user')['username']}}">
        <input type="hidden" name="ctl00$ContentPlaceHolder1$Password" value="{{Session::get('user')['password']}}">
    </form>
    <form method="post" action="http://webfax.uniweb.it/" id="form_webfax" target="_blank">
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