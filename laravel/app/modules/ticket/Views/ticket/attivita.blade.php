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
    <div class="container-fluid">
        <form action="#" method="post" id="form">
        <div class="border">
            <table class="tbl_clienti" style="width:100%">
                <tbody>
                <tr class="soggetto">
                    <td>CLIENTE *</td>
                    <td>
                        <select name="cliente" id="cliente">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="destinatarioabituale">
                    <td>UBICAZIONE IMPIANTO</td>
                    <td>
                        <select name="ubicazione_impianto" id="ubicazione_impianto">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{isset($request['DESTINATARIOABITUALE_CODICE']) && $request['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

    <br><br>
    <fieldset class="dettaglio_dati">
        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">

                <tr>
                    <td>NR INTERNO TICKET </td>
                    <td class="manutenzione">{{$idattivita or ""}}</td>
                    <td>NR TICKET TELECOM</td>
                    <td><input type="text" name="tickettelecom" value="{{$request['TICKETTELECOM'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ATTIVIT&Agrave; APERTA DA *</td>
                    <td>
                        <select name="apertoda" id="apertoda" required>
                            <option value="">-----</option>
                            @foreach($tecnici as $tecnico)
                                <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($request['APERTODA']) && $request['APERTODA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>ATTIVIT&Agrave; IN CARICO A *</td>
                    <td>
                        <select name="incaricoa" id="incaricoa" required>
                            <option value="">-----</option>
                            @foreach($tecnici as $tecnico)
                                <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($request['INCARICOA']) && $request['INCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>EMAIL CLIENTE</td>
                    <td><input type="text" name="email" id="email" value="{{$res['EMAIL'] or ""}}"></td>
                    <td>ATTIVIT&Agrave; APERTA IL</td>
                    <td><input type="text" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
                </tr>
                <tr>
                    <td>TGU / IMEI</td>
                    <td><input type="text" name="tgu" id="tgu" value="{{$request['TGU'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>TITOLO ATTIVIT&Agrave;</td>
                    <td><input type="text" name="titolo" value="{{$request['TITOLO'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>MOTIVO DELLA CHIAMATA</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="4"><textarea name="motivo" cols="130">{{$request['MOTIVO'] or ""}}</textarea></td>
                </tr>
                <tr>
                    <td>ELENCO ATTIVIT&Agrave;</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="4"><textarea name="elenco_attivita" cols="130" readonly="readonly">{{$request['ELENCO ATTIVITA'] or ""}}</textarea></td>
                </tr>
                <tr>
                    <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                </tr>
                <tr>
                    <td>AGGIUNGI ATTIVIT&Agrave;</td>
                    <td></td>
                    <td>TECNICO</td>
                    <td>
                        <select name="incaricoa_attivita" class="incaricoa_attivita">
                            <option value="">-----</option>
                            @foreach($tecnici as $tecnico)
                                <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($request['IDTECNICO']) && $request['IDTECNICO'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>DURATA INTERVENTO MINUTI</td>
                    <td><input type="text" name="tempo" class="tempo" value="{{$request['TEMPO'] or ""}}" style="min-width:50px !important; width:50px;"></td>
                </tr>
                <tr>
                    <td colspan="4"><textarea name="attivita" id="attivita" cols="130">{{$request['DESCRIZIONE'] or ""}}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="button" value="AGGIUNGI ATTIVIT&Agrave;" class="btn btn-primary btn-xs salva-attivita"></td>
                </tr>
                <tr>
                    <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                </tr>
                <tr>
                    <td>CAMBIA STATO</td>
                    <td>
                        <select name="stato">
                            @foreach($stati as $stato)
                                <option value="{{$stato['IDSTATO'] or ""}}" {{isset($request['STATO']) && $request['STATO'] == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="button" value="SALVA TICKET" class="btn btn-primary btn-xs salva-ticket"></td>
                    <td><input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs"></td>
                </tr>
        </table>
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="idattivita" value="{{$idattivita or ""}}">
        </form>
        <hr>

        <div id="msg" class="modal fade" style="z-index:99999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Record inserito con successo</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-modal" data-dismiss="modal">OK</button>
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
                        if($(".incaricoa_attivita").val() == "")
                            msg = msg + " 'Tecnico'";
                        if($(".tempo").val() == "")
                            msg = msg + " 'Tempo'";
                        if(msg != ""){
                            alert("Compilare i campi" + msg);
                            return false;
                        }

                        $.post( "{{url('/ticket/salvaattivita')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    location.reload();
                                });
                    });

                    $(".salva-ticket").click(function(){
                        //Verifico che siano settati in caricoa,apertada,cliente e email
                        var msg = "";
                        if($("#cliente").val() == "")
                            msg = msg + " 'Cliente'";
                        if($("#apertada").val() == "")
                            msg = msg + " 'Attività Aperta da'";
                        if($("#incaricoa").val() == "")
                            msg = msg + " 'Attività In Carico a'";
                        if($("#email").val() == "")
                            msg = msg + " 'Email'";
                        if(msg != ""){
                            alert("Compilare i campi" + msg);
                            return false;
                        }

                        $.post( "{{url('/ticket/salvaticket')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                        $.post( "{{url('/ticket/mailaperturaticket')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });


                    $("#cliente").change(function(){
                        $.post( "{{url('/ticket/getEmailCliente')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    $("#email").val(data[0]['EMAIL']);
                                });
                    });

                    $("#cliente").val('{{Input::get('cliente')}}').trigger("change");
                    $("#ubicazione_impianto").val('{{Input::get('ubicazione')}}').trigger("change");
                    $("#tgu").val('{{Input::get('tgu')}}').trigger("change");

                });
            </script>

@endsection