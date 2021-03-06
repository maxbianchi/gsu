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
                    <tr class="sedeoperativa">
                        <td>SEDE OPERATIVA</td>
                        <td>
                            <input type="text" value="" name="search_sedeoperativa" id="search_sedeoperativa" >
                            <select name="sedeoperativa" id="sedeoperativa">
                                <option value="">-----</option>
                                @foreach($sedioperative as $sede)
                                    <option value="{{$sede['CustSupp']}}" {{isset($request['SEDE_OPERATIVA']) && $request['SEDE_OPERATIVA'] == $sede['CustSupp'] ? 'selected="selected"' : ""  }}>{{$sede['CompanyName']." - ".$sede['Address']." - ".$sede['City']." - ".$sede['County']." - ".$sede['CustSupp']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
    </div>

    <!-- TABS -->

    <ul class="nav nav-tabs" id="mioTab">
        <li class="active"><a href="#uno" data-toggle="tab">Ticket</a></li>
        <li><a href="#home" data-toggle="tab">Cliente</a></li>
        <li><a href="#due" data-toggle="tab">Fornitore</a></li>
        <li><a href="#tre" data-toggle="tab">Servizio</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="home"><h1>Cliente</h1>
            <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                <tr>
                    <td>NR INTERNO TICKET </td>
                    <td class="manutenzione"><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled"  value="{{$idattivita or ""}}"></td>
                    <td>ATTIVIT&Agrave; APERTA IL</td>
                    <td><input type="text" style="background-color: #eee;" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
                </tr>
                <tr>
                    <td>EMAIL FATTURAZIONE</td>
                    <td><input type="text" style="background-color: #FFC;" name="email" id="email" value="{{$res['EMAIL'] or ""}}"></td>
                    <td></td>
                    <td></td>
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
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane active" id="uno"><h1>Ticket</h1>
            <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                <tr>
                    <td>NR INTERNO TICKET </td>
                    <td class="manutenzione"><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled"  value="{{$idattivita or ""}}"></td>
                    <td>ATTIVIT&Agrave; APERTA IL</td>
                    <td><input type="text" style="background-color: #eee;" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
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
                <tr>
                    <td>CATEGORIA *</td>
                    <td>
                        <select name="categoria" id="categoria" class="categoria" style="background-color: #FFC;">
                            <option value="">-----</option>
                            @foreach($sistemisti as $sistemista)
                                <option value="{{$sistemista['IDCATEGORIA'] or ""}}" {{isset($res['IDCATEGORIA']) && $res['IDCATEGORIA'] == $sistemista['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$sistemista['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>TIPOLOGIA ASSISTENZA</td>
                    <td><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled" name="tipologia_assistenza" id="tipologia_assistenza" value=""></td>
                </tr>
                <tr>
                    <td>GENERE</td>
                    <td>
                        <select name="genere" id="genere" class="genere" style="background-color: #FFC;">
                            @foreach($genere as $row)
                                <option value="{{$row['IDCATEGORIA'] or ""}}" {{isset($result['IDGENERE']) && $result['IDGENERE'] == $row['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$row['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>CARNET DISPONIBILI NR.</td>
                    <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="carnet_disponibili" id="carnet_disponibili" value=""></td>

                </tr>
                <tr>
                    <td>Tipologia</td>
                    <td><select name="ingaranzia" style="background-color: #FFC;">
                            <option value="1">A CONSUNTIVO</option>
                            <option value="0">A CONTRATTO (in garanzia)</option>
                        </select></td>
                    <td>TICKET DISPONIBILI VAL. €</td>
                    <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="ticket_disponibili" id="ticket_disponibili" value=""></td>
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

            </table>
        </div>
        <div class="tab-pane" id="due"><h1>Fornitore</h1>
            <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                <tr>
                    <td>NR INTERNO TICKET </td>
                    <td class="manutenzione"><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled"  value="{{$idattivita or ""}}"></td>
                    <td>ATTIVIT&Agrave; APERTA IL</td>
                    <td><input type="text" style="background-color: #eee;" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
                </tr>
                <tr class="soggetto">
                    <td>FORNITORE</td>
                    <td style="background-color:#FFC">
                        <input type="text" value="" name="search_fornitore" id="search_fornitore" >
                        <select name="fornitore" id="fornitore" style="max-width:600px;">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ".$user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>NR TICKET FORNITORE</td>
                    <td><input type="text" style="background-color: #FFC;" name="tickettelecom" value="{{$request['TICKETTELECOM'] or ""}}"></td>
                    <td>ORDINE FORNITORE</td>
                    <td><input type="text" style="background-color: #FFC;" name="ordinefornitore" value="{{$request['ORDINE_FORNITORE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NOME REFERENTE</td>
                    <td><input type="text" style="background-color: #FFC;" name="nomefornitore" value="{{$request['NOME_FORNITORE'] or ""}}"></td>
                    <td>TELEFONO REFERENTE</td>
                    <td><input type="text" style="background-color: #FFC;" name="telefonofornitore" id="telefonofornitore" value="{{$request['TELEFONO_FORNITORE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>EMAIL REFERENTE</td>
                    <td><input type="text" style="background-color: #FFC;" name="emailfornitore" id="emailfornitore" value="{{$res['EMAIL_FORNITORE'] or ""}}"></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="tab-pane" id="tre"><h1>Servizio</h1>
            <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                <tr>
                    <td>TGU</td>
                    <td><input type="text" style="background-color: #FFC;" name="tgu" id="tgu" value="{{$request['TGU'] or ""}}"></td>
                    <td>IMEI</td>
                    <td><input type="text" style="background-color: #FFC;" name="imei" id="imei" value="{{$request['IMEI'] or ""}}"></td>
                </tr>
                <tr>
                    <td>TEL</td>
                    <td><input type="text" style="background-color: #FFC;" name="tel" id="tel" value="{{$request['TEL'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>CONFERMA ORDINE</td>
                    <td><input type="text" style="background-color: #FFC;" name="conferma_ordine" id="conferma_ordine" value="{{$request['CONFERMA_ORDINE'] or ""}}"></td>
                    <td>COD. SERVIZIO</td>
                    <td><input type="text" style="background-color: #FFC;" name="cod_servizio" id="cod_servizio" value="{{$request['COD_SERVIZIO'] or ""}}"></td>
                </tr>
            </table>
        </div>
    </div>
    <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
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
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="idattivita" id="idattivita" value="{{$idattivita or ""}}">
    </form>
    </table>

    <!-- END TABS -->
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

                    var email = 0;
                    var fornitore = 0;

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
                                    location.href = '{{url('/ticket/alltickets')}}';
                                });
                        $.post( "{{url('/ticket/mailaperturaticket')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });

                    $("#fornitore").change(function() {
                        $.post("{{url('/ticket/getEmailFornitore')}}", {
                            'cliente': $("#fornitore").val(),
                            'idattivita': $("#idattivita").val(),
                            '_token': '{{ csrf_token() }}'
                        })
                                .done(function (data) {
                                    if (fornitore != 0) {
                                        console.log("PIPPO");
                                        data = JSON.parse(data);
                                        $("#emailfornitore").val(data[0]['EMAIL']);
                                        //$("#nome_referente").val(data[0]['CONTATTO']);
                                        $("#telefonofornitore").val(data[0]['TELEFONO']);
                                    }
                                });
                    });
                    fornitore = 1;

                    $("#cliente").change(function(){
                        $.post( "{{url('/ticket/getCategorie')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $("#sedeoperativa").val($("#cliente").val()).change();
                                    $("#sedeoperativa").attr('disabled',true);
                                    data = JSON.parse(data);
                                    var $select = $('#categoria');
                                    $select.find('option').remove();
                                    $.each(data, function (key, data) {
                                        $select.append('<option value=' + data.Codice + '>' + data.Descrizione + '</option>');
                                    })
                                    $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                            .done(function (data) {
                                                data = JSON.parse(data);
                                                $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                                $("#ticket_disponibili").val(0);
                                                if($("#tipologia_assistenza").val() == "TICKET") {
                                                    $.get("{{url('/ticket/getTicketDisponibili')}}", {
                                                        categoria: $("#categoria").val(),
                                                        cliente: $("#cliente").val()
                                                    })
                                                            .done(function (data) {
                                                                data = JSON.parse(data);
                                                                $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                                            });
                                                }
                                            });
                                });
                        $.get( "{{url('/ticket/getCarnetDisponibili')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    var count = 0;
                                    $.each(data, function (key, data) {
                                        count++;
                                    })
                                    $("#carnet_disponibili").val(count);
                                    console.log(count);
                                });

                        if(email != 0) {
                            $.post("{{url('/ticket/getEmailCliente')}}", $("form#form").serialize())
                                    .done(function (data) {
                                        data = JSON.parse(data);
                                        $("#email").val(data[0]['EMAIL']);
                                        //$("#nome_referente").val(data[0]['CONTATTO']);
                                        $("#telefono_referente").val(data[0]['TELEFONO']);
                                        $("#email_referente").val(data[0]['EMAIL_REFERENTE']);
                                    });
                        }
                        email = 1;

                        $.get( "{{url('/ticket/checkBlocked')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    if(data[0].Blocked == 1)
                                    {
                                        $('#msg_bloccato').modal('show');
                                    }
                                });
                    });

                    $("#categoria").change(function(){
                        $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                .done(function (data) {

                                    data = JSON.parse(data);
                                    $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                    $.get( "{{url('/ticket/getCarnetDisponibili')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                            .done(function( data ) {
                                                data = JSON.parse(data);
                                                var count = 0;
                                                $.each(data, function (key, data) {
                                                    count++;
                                                })
                                                $("#carnet_disponibili").val(count);
                                                console.log(count);
                                            });
                                    $("#ticket_disponibili").val(0);
                                    if($("#tipologia_assistenza").val() == "TICKET") {
                                        $.get("{{url('/ticket/getTicketDisponibili')}}", {
                                            categoria: $("#categoria").val(),
                                            cliente: $("#cliente").val()
                                        })
                                                .done(function (data) {
                                                    data = JSON.parse(data);
                                                    $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                                    console.log(data[0].JBS_ValoreTotaleEuro);
                                                });
                                    }

                                });
                    });


                    $("#cliente").val('{{Input::get('cliente')}}').trigger("change");
                    $("#cliente_finale").val('{{Input::get('cliente_finale')}}').trigger("change");
                    $("#ubicazione_impianto").val('{{Input::get('ubicazione')}}').trigger("change");
                    $("#tgu").val('{{Input::get('tgu')}}').trigger("change");
                    $("#ticket_disponibili").val(0);
                    $("#sedeoperativa").attr('disabled',true);
                    if($("#tipologia_assistenza").val() == "TICKET") {
                        $.get("{{url('/ticket/getTicketDisponibili')}}", {
                            categoria: $("#categoria").val(),
                            cliente: $("#cliente").val()
                        })
                                .done(function (data) {
                                    data = JSON.parse(data);
                                    $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                    console.log(data[0].JBS_ValoreTotaleEuro);
                                });
                    }



                    function h(e) {
                        $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
                    }
                    $('textarea').each(function () {
                        h(this);
                    }).on('input', function () {
                        h(this);
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