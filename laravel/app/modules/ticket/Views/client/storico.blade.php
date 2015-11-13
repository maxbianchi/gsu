@extends('ticket::app')

@section('css')
    <style>
        .row{
            margin:2px;
        }
        .btn{
            min-width: 80px;
        }
    </style>
@endsection

@section('content')
    <br>
    <br>
    <form method="GET">
    <div class="row">
        <div class="col-xs-14 col-sm-6 col-md-10 col-lg-8">
            TICKET ID: <strong>{{$attivita['IDATTIVITA']}}</strong><br>
            TICKET APERTO IL: <strong>{{$attivita['APERTAIL']}} ALLE ORE: {{$attivita['ORAAPERTAIL']}}</strong><br>
            TITOLO TICKET: <strong>{{$attivita['TITOLO']}}</strong><br>
            MOTIVO CHIAMATA: <strong>{{$attivita['MOTIVO']}}</strong><br>
            <?php if(file_exists("/var/www/gsu/laravel/public/output/".$attivita['IDATTIVITA'].".pdf")): ?>
            VERBALE INTERVENTO: <a href="/output/{{$attivita['IDATTIVITA']}}.pdf" download title="Verbalino" alt="Verbalino"><img src="{{ URL::asset('images/pdf_icon.png') }}"></a>
            <?php
            endif;
            ?><br>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-14 col-sm-6 col-md-10 col-lg-8">
            <div class="container-fluid" style="">
                <div id="accordion">
                    <table border="0" class="table table-striped table-bordered display" id="main" cellspacing="0" width="100%">
                        <thead>
                        <tr style="width:100%">
                            <td>NR.TICKET INTERNO</td>
                            <td>DATA / ORA</td>
                            <td>STATO</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($storico as $res)
                            <tr style="<?php if($res['STATO'] == "CHIUSO") echo "color:red;text-decoration: line-through;"; elseif($res['STATO'] == "IN LAVORAZIONE UNIWEB") echo "color:green";elseif($res['STATO'] == "IN ATTESA CLIENTE") echo "color:orange"; ?>;cursor: pointer; cursor: hand;">
                                <td>{{$res['IDATTIVITA']}}</td>
                                <td>{{$res['DATACAMBIOSTATO']." - ".$res['ORACAMBIOSTATO']}}</td>
                                <td>{{$res['STATO']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span class="exportBox"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-14 col-sm-6 col-md-10 col-lg-8">
            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs" style="clear:both;">
            <input type="button" value="INVIA SOLLECITO" style="float:right;" class="btn btn-primary btn-xs sollecito">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="idattivita" value="{{$attivita['IDATTIVITA']}}">
            <input type="hidden" name="titolo" value="{{$attivita['TITOLO']}}">
            <input type="hidden" name="motivo" value="{{$attivita['MOTIVO']}}">
        </div>
    </div>
    </form>

    <div id="msg_sollecito" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sollecito inviato con successo</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script>

        $(document).ready(function () {

            function h(e) {
                $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
            }
            $('textarea').each(function () {
                h(this);
            }).on('input', function () {
                h(this);
            });


            $(".salva-attivita").click(function(){
                //Verifico che siano settati tempo e tecnico
                var msg = "";
                if($(this).closest('form').find(".incaricoa_attivita").val() == "")
                    msg = msg + " 'Tecnico'";
                if($(this).closest('form').find(".tempo").val() == "")
                    msg = msg + " 'Tempo'";
                if(msg != ""){
                    alert("Compilare i campi" + msg);
                    return false;
                }
                $.post( "{{url('/ticket/salvaattivita')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $('#msg').modal('show');
                            $("#attivita").val("");
                            //location.reload();
                        });
            });

            $(".salva-ticket").click(function(){
                //Verifico che siano settati in caricoa,apertada,cliente e email
                var msg = "";
                if($(this).closest('form').find(".cliente_val").val() == "")
                    msg = msg + " 'Cliente'";
                if($(this).closest('form').find(".apertada").val() == "")
                    msg = msg + " 'Attività Aperta da'";
                if($(this).closest('form').find(".categoria").val() == "")
                    msg = msg + " 'Categoria'";
                if(msg != ""){
                    alert("Compilare i campi" + msg);
                    return false;
                }

                //Se chiuso faccio post del form non ajax
                var stato = $(this).closest('form').find(".stato").val();

                if(stato == 4){
                    msg = "";
                    if($(this).closest('form').find(".incaricoa").val() == "")
                        msg = msg + " 'Attività in carico a'";
                    if(msg != ""){
                        alert("Compilare i campi" + msg);
                        return false;
                    }
                }

                var form = $(this).closest('form');
                $.post("{{url('/ticket/salvaticket')}}", $(this).closest('form').serialize())
                        .done(function (data) {
                            $('#msg').modal('show');
                            $("#btn_salva").hide();
                            if(stato != 4) {
                                location.reload()
                            } else {
                                form.submit();
                            }
                        });
            });

            $("#cliente").change(function(){
                $.post( "{{url('/ticket/getEmailCliente')}}", {'cliente' : $("#cliente").val(), '_token' : '{{ csrf_token() }}' })
                        .done(function( data ) {
                            data = JSON.parse(data);
                            $("#email").val(data[0]['EMAIL']);
                            //$("#nome_referente").val(data[0]['CONTATTO']);
                            $("#telefono_referente").val(data[0]['TELEFONO']);
                        });
            });

            $(".sollecito").click(function(){
                $.get( "{{url('/ticket/sollecitoticketcliente')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $('#msg_sollecito').modal('show');
                        });
            });

            /*$(".noEnter").keypress(function(evt) {
                var charCode=(evt.which)?evt.which:event.keyCode;
                if (charCode == 10 || charCode == 13)
                return false;
                return true;
            });*/


        });
    </script>

@endsection