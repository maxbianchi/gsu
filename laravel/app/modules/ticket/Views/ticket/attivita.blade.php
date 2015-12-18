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
                            <input type="text" value="" name="search_cliente" id="search_cliente" >
                            <select name="cliente" id="cliente">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ".$user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="cliente">
                        <td>CLIENTE FINALE</td>
                        <td>
                            <input type="text" value="" name="search_cliente_finale" id="search_cliente_finale" >
                            <select name="cliente_finale" id="cliente_finale">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['CLIENTE_FINALE_CODICE']) && $request['CLIENTE_FINALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ".$user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="destinatarioabituale">
                        <td>UBICAZIONE IMPIANTO</td>
                        <td>
                            <input type="text" value="" name="search_ubicazione" id="search_ubicazione" >
                            <select name="ubicazione_impianto" id="ubicazione_impianto">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['DESTINATARIOABITUALE_CODICE']) && $request['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ".$user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
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
                <td>NR TICKET FORNITORE</td>
                <td><input type="text" style="background-color: #FFC;" name="tickettelecom" value="{{$request['TICKETTELECOM'] or ""}}"></td>
            </tr>
            <tr>
                <td>ATTIVIT&Agrave; APERTA DA *</td>
                <td>
                    <select name="apertoda" id="apertoda" required style="background-color: #FFC;">
                        <option value="">-----</option>
                        @foreach($tecnici as $tecnico)
                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Session::has('idtecnico') && Session::get('idtecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                        @endforeach
                    </select>
                </td>
                <td>ATTIVIT&Agrave; IN CARICO A</td>
                <td>
                    <select name="incaricoa" id="incaricoa" required style="background-color: #FFC;">
                        <option value="0">-----</option>
                        @foreach($tecnici as $tecnico)
                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($request['INCARICOA']) && $request['INCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>EMAIL FATTURAZIONE</td>
                <td><input type="text" style="background-color: #FFC;" name="email" id="email" value="{{$res['EMAIL'] or ""}}"></td>
                <td>CATEGORIA *</td>
                <td>
                    <select name="categoria" id="categoria" class="categoria" style="background-color: #FFC;">
                        <option value="">-----</option>
                        @foreach($categorie as $categoria)
                            <option value="{{$categoria['IDCATEGORIA'] or ""}}" {{isset($res['IDCATEGORIA']) && $res['IDCATEGORIA'] == $categoria['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$categoria['DESCRIZIONE'] or ""}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>TIPOLOGIA ASSISTENZA</td>
                <td><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled" name="tipologia_assistenza" id="tipologia_assistenza" value=""></td>
            </tr>
            <tr>
                <td>NOME REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="nome_referente" id="nome_referente" value="{{$request['NOME_REFERENTE'] or ""}}"></td>
                <td>TELEFONO REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="telefono_referente" id="telefono_referente" value="{{$res['TELEFONO_REFERENTE'] or ""}}"></td>
            </tr>
            <tr>
                <td>EMAIL REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="email_referente" id="email_referente" value="{{$res['EMAIL_REFERENTE'] or ""}}"></td>
                <td>ATTIVIT&Agrave; APERTA IL</td>
                <td><input type="text" style="background-color: #FFC;" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
            </tr>
            <tr>
                <td>TGU / IMEI</td>
                <td><input type="text" style="background-color: #FFC;" name="tgu" id="tgu" value="{{$request['TGU'] or ""}}"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>CONFERMA ORDINE</td>
                <td><input type="text" style="background-color: #FFC;" name="conferma_ordine" id="conferma_ordine" value="{{$request['CONFERMA_ORDINE'] or ""}}"></td>
                <td>COD. SERVIZIO</td>
                <td><input type="text" style="background-color: #FFC;" name="cod_servizio" id="cod_servizio" value="{{$request['COD_SERVIZIO'] or ""}}"></td>
            </tr>
            <tr>
                <td>TITOLO ATTIVIT&Agrave;</td>
                <td><input type="text" style="background-color: #FFC;" name="titolo" value="{{$request['TITOLO'] or ""}}"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>MOTIVO DELLA CHIAMATA</td>
                <td colspan="3"><textarea style="background-color: #FFC;" name="motivo" class="noEnter" cols="130">{{$request['MOTIVO'] or ""}}</textarea></td>
            </tr>
            <tr>
                <td>DETTAGLIO ATTIVIT&Agrave;</td>
                <td colspan="3"><textarea style="background-color: #eee;" name="elenco_attivita" cols="130" readonly="readonly">{{$request['ELENCO ATTIVITA'] or ""}}</textarea></td>
            </tr>
            <tr>
                <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
            </tr>
            <tr>
                <td>AGGIUNGI ATTIVIT&Agrave;</td>
                <td></td>
                <td>TECNICO</td>
                <td>
                    <select name="incaricoa_attivita" class="incaricoa_attivita" style="background-color: #FFC;">
                        <option value="">-----</option>
                        @foreach($tecnici as $tecnico)
                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Session::has('idtecnico') && Session::get('idtecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>DURATA INTERVENTO MINUTI</td>
                <td><input type="text" style="background-color: #FFC;" name="tempo" class="tempo" value="{{$request['TEMPO'] or "0"}}" style="min-width:50px !important; width:50px;"></td>
            </tr>
            <tr>
                <td colspan="4"><textarea style="background-color: #FFC;" name="attivita" id="attivita" cols="130">{{$request['DESCRIZIONE'] or ""}}</textarea></td>
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
                    <select name="stato"  readonly="readonly" style="background-color: #eee;">
                        <option value="1">APERTO</option>
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

        <div id="msg_bloccato" class="modal fade" style="z-index:99999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ATTENZIONE utente bloccato !</h4>
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
                                    $('#msg').modal('show');
                                    $("#attivita").val("");
                                    //location.reload();
                                });
                    });

                    $(".salva-ticket").click(function(){
                        //Verifico che siano settati in caricoa,apertada,cliente e email
                        var msg = "";
                        if($("#cliente").val() == "")
                            msg = msg + " 'Cliente'";
                        if($("#apertada").val() == "")
                            msg = msg + " 'Attività Aperta da'";
                        if($("#categoria").val() == "")
                            msg = msg + " 'Categoria'";
                        if(msg != ""){
                            alert("Compilare i campi" + msg);
                            return false;
                        }

                        $.post( "{{url('/ticket/salvaticket')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    location.href = '{{ URL::previous() }}';
                                });
                        $.post( "{{url('/ticket/mailaperturaticket')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });


                    $("#cliente").change(function(){

                        $.post( "{{url('/ticket/checkBlocked')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    if(data[0].Blocked == 1)
                                    {
                                        $('#msg_bloccato').modal('show');
                                    }
                                });

                        $.post( "{{url('/ticket/getCategorie')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    var $select = $('#categoria');
                                    $select.find('option').remove();
                                    $.each(data, function (key, data) {
                                        $select.append('<option value=' + data.Codice + '>' + data.Descrizione + '</option>');
                                    })
                                });
                        $.post( "{{url('/ticket/getEmailCliente')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    $("#email").val(data[0]['EMAIL']);
                                    //$("#nome_referente").val(data[0]['CONTATTO']);
                                    $("#telefono_referente").val(data[0]['TELEFONO']);
                                });
                        $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                .done(function (data) {
                                    data = JSON.parse(data);
                                    $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                });
                    });

                    $("#categoria").change(function(){
                        $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                .done(function (data) {

                                    data = JSON.parse(data);
                                    console.log(data[0].TipologiaAssistenza);
                                    $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                });
                    });

                    $("#cliente").val('{{Input::get('cliente')}}').trigger("change");
                    $("#cliente_finale").val('{{Input::get('cliente_finale')}}').trigger("change");
                    $("#ubicazione_impianto").val('{{Input::get('ubicazione')}}').trigger("change");
                    $("#tgu").val('{{Input::get('tgu')}}').trigger("change");

                    /*$(".noEnter").keypress(function(evt) {
                        var charCode=(evt.which)?evt.which:event.keyCode;
                        if (charCode == 10 || charCode == 13)
                            return false;
                        return true;
                    });*/

                });
            </script>

@endsection