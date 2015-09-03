@extends('ticket::app')

@section('content')
    <br><br>
    <br><br>

    <form action="#" method="POST" name="form" id="form">
        <table>
            <tr class="soggetto">
                <td>CLIENTE</td>
                <td colspan="3">
                    <select name="cliente" id="cliente">
                        <option value="">-----</option>
                        @foreach($users as $user)
                            <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr class="cliente">
                <td>CLIENTE FINALE</td>
                <td>
                    <select name="cliente_finale" id="cliente_finale">
                        <option value="">-----</option>
                        @foreach($users as $user)
                            <option value="{{$user['SOGGETTO']}}" {{isset($request['CLIENTE_FINALE_CODICE']) && $request['CLIENTE_FINALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="destinatarioabituale">
                <td>UBICAZIONE</td>
                <td colspan="3">
                    <select name="ubicazione" id="ubicazione">
                        <option value="">-----</option>
                        @foreach($users as $user)
                            <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>

        <br><br>
        <br><br>

        <div id="toPrint" style="width:595pt; height:842pt;">

            <table style="width:100%;font-family: Arial; font-size:10px;" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" style="width:30%;">
                        <img src="{{ URL::asset('images/Banner.png') }}" >
                    </td>
                    <td style="width:70%;" colspan="2">
                        <table style="width:100%">
                            <tr>
                                <td style="width:20%">
                                    CLIENTE
                                </td>
                                <td style="width:80%">
                                    <input type="text" value="" id="ragionesociale" name="ragionesociale" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Citt&agrave;
                                </td>
                                <td>
                                    <input type="text" value="" id="citta" name="citta" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Indirizzo
                                </td>
                                <td>
                                    <input type="text" value="" id="indirizzo" name="indirizzo" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <input type="text" value="{{Input::get('email')}}" id="email" name="email" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    CLIENTE FINALE
                                </td>
                                <td>
                                    <input type="text" value="" id="cliente_finale_ragionesociale" name="cliente_finale_ragionesociale" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Citt&agrave;
                                </td>
                                <td>
                                    <input type="text" value="" id="cliente_finale_citta" name="cliente_finale_citta" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Indirizzo
                                </td>
                                <td>
                                    <input type="text" value="" id="cliente_finale_indirizzo" name="cliente_finale_indirizzo" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    UBICAZIONE
                                </td>
                                <td>
                                    <input type="text" value="" id="ubicazione_ragionesociale" name="ubicazione_ragionesociale" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Citt&agrave;
                                </td>
                                <td>
                                    <input type="text" value="" id="ubicazione_citta" name="ubicazione_citta" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Indirizzo
                                </td>
                                <td>
                                    <input type="text" value="" id="ubicazione_indirizzo" name="ubicazione_indirizzo" class="edit" style="width:100%">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Riferimento
                                </td>
                                <td>
                                    <input type="text" value="{{Input::get('nome_referente')}}" id="riferimento" name="riferimento" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tel.
                                </td>
                                <td>
                                    <input type="text" value="{{Input::get('telefono_referente')}}" id="telefono" name="telefono" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <div style="border:solid 1px; text-align: center;">RDI - Rapporto di intervento tecnico nr. {{Input::get('idattivita')}} del <?php echo date("d-m-Y"); ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <div style="border:solid 1px; text-align: center;">
                            <table>
                                <tr>
                                    <td style="text-align: center;">
                                        Matricola <input type="text" value="" id="matricola" name="matricola" class="edit" style="width:100%">
                                    </td>
                                    <td style="text-align: center;">
                                        Modello  <input type="text" value="" id="modello" name="modello" class="edit" style="width:100%">
                                    </td>
                                    <td style="text-align: center;">
                                        Lettura Tot bn <input type="text" value="" id="tot_bn" name="tot_bn" class="edit" style="width:100%">
                                    </td>
                                    <td style="text-align: center;">
                                        Lettura Tot colore <input type="text" value="" id="tot_colore" name="tot_colore" class="edit" style="width:100%">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <div style="border:solid 1px; text-align: center;">
                            Motivo della chiamata <textarea value="{{Input::get('motivo')}}" id="motivo" name="motivo" class="edit-textarea" style="width:100%" rows="4">{{Input::get('motivo')}}</textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <div style="border:solid 1px; text-align: center;">
                            Descrizione Intervento <textarea value="" id="descrizione" name="descrizione" class="edit-textarea" style="width:100%" rows="6"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <table border="1" style="width:100%">
                            <tr>
                                <td style="width:20%">
                                    Codice
                                </td>
                                <td style="width:40%">
                                    Descrizione
                                </td>
                                <td  style="width:10%">
                                    Q.ta
                                </td>
                                <td  style="width:30%">
                                    Note
                                </td>
                            </tr>
                            <tr>
                                <td style="width:20%">
                                    <input type="text" value="" id="codice1" name="codice1" class="edit" style="width:100%">
                                </td>
                                <td style="width:40%">
                                    <input type="text" value="" id="descrizione1" name="descrizione1" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="qta1" name="qta1" class="edit" style="width:100%">
                                </td>
                                <td  style="width:30%">
                                    <input type="text" value="" id="note1" name="note1" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:20%">
                                    <input type="text" value="" id="codice2" name="codice2" class="edit" style="width:100%">
                                </td>
                                <td style="width:40%">
                                    <input type="text" value="" id="descrizione2" name="descrizione2" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="qta2" name="qta2" class="edit" style="width:100%">
                                </td>
                                <td  style="width:30%">
                                    <input type="text" value="" id="note2" name="note2" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:20%">
                                    <input type="text" value="" id="codice3" name="codice3" class="edit" style="width:100%">
                                </td>
                                <td style="width:40%">
                                    <input type="text" value="" id="descrizione3" name="descrizione3" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="qta3" name="qta3" class="edit" style="width:100%">
                                </td>
                                <td  style="width:30%">
                                    <input type="text" value="" id="note3" name="note3" class="edit" style="width:100%">
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <table>
                            <tr>
                                <td style="width:10%">
                                    Data Intervento
                                </td>
                                <td style="width:10%">
                                    <input type="text" value="" id="data_intervento" name="data_intervento" class="edit-date datepicker" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Intervento Remoto
                                </td>
                                <td  style="width:10%">
                                    <input type="checkbox" value="" name="intervento_remoto" class="edit-checkbox" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Tempo totale min.
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="{{Input::get('tempo_totale')}}" id="tempo" name="tempo" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10%">
                                    Tempo Viaggio
                                </td>
                                <td style="width:10%">
                                    <input type="text" value="" id="tempo_viaggio" name="tempo_viaggio" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Ora inizio intervento
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="ora_inizio" name="ora_inizio" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Ora fine intervento
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="ora_fine" name="ora_fine" class="edit" style="width:100%">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:10%">
                                    Tempo Viaggio
                                </td>
                                <td style="width:10%">
                                    <input type="text" value="" id="tempo_viaggio2" name="tempo_viaggio2" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Ora inizio intervento
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="ora_inizio2" name="ora_inizio2" class="edit" style="width:100%">
                                </td>
                                <td  style="width:10%">
                                    Ora fine intervento
                                </td>
                                <td  style="width:10%">
                                    <input type="text" value="" id="ora_fine2" name="ora_fine2" class="edit" style="width:100%">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <div style="border:solid 1px; text-align: center;">
                            Note sull'intervento <textarea value="" id="note" name="note" class="edit-textarea" style="width:100%" rows="4"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table style="width:100%">
                            <tr>
                                <td style="width:50%">
                                    Intervento risolutivo <input type="checkbox" value="" name="intervento_risolutivo_si" class="edit-checkbox">SI <input type="checkbox" value="" name="intervento_risolutivo_no" class="edit-checkbox">NO
                                </td>
                                <td style="width:50%">
                                    In garanzia <input type="checkbox" value="" name="garanzia_si" class="edit-checkbox">SI <input type="checkbox" value="" name="garanzia_no" class="edit-checkbox">NO
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">
                                    Macchina in funzione <input type="checkbox" value="" name="macchina_funzione_si" class="edit-checkbox">SI <input type="checkbox" value="" name="macchina_funzione_no" class="edit-checkbox">NO
                                </td>
                                <td style="width:50%">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:100%" colspan="2">
                        <table style="width:100%" border="1">
                            <tr>
                                <td style="width:50%; height: 60pt;" valign="top">
                                    Timbro e firma del cliente
                                </td>
                                <td style="width:50%; height: 60pt;text-align: center" valign="top">
                                    Tecnico<br><h2>{{$tecnico}}</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="container_12" style="text-align: center;">
                            <strong>Uniweb Srl</strong>
                            - Via Milano, 51 - 22063 Cantú (CO) - CF / P.IVA 02478160134
                            <br>
                            Tel. +39 031 701728 r.a. - Fax +39 031 7073755 - E-mail:
                            <a href="mailto:info@uniweb.it">info@uniweb.it</a>
                            <br>
                            Reg. Imp. di Como n° 02478160134 - Capitale Sociale: € 15.000,00 i.v. - CCIAA Como REA n° 262922 - <a href="{{url('/cookie-policy')}}">Cookie policy</a>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="incaricoa" value="{{Input::get('incaricoa')}}">
    <input type="hidden" name="idattivita" value="{{Input::get('idattivita')}}">
        <br>
        <br>
        <br>
        <br>
        <input type="button" value="SALVA" onclick="toPDF();">
    </form>



    <br>
    <br>

@endsection

@section('script')
    <script type="text/javascript">


        function toPDF() {

            //SALVO SU DB

            $.post( "{{url('/ticket/salvaverbalino')}}", $("#form").serialize())
                    .done(function( data ) {
                        //CREO PDF E LO SALVO
                        var html="<!DOCTYPE html><body>";
                        html+= document.getElementById('toPrint').innerHTML;
                        html+="</body></html>";

                        $.post( "/ticket/pdf", { html: html, '_token': '{{ csrf_token() }}', idattivita: '{{Input::get('idattivita')}}', email: '{{Input::get('email')}}', motivo: '{{Input::get('motivo')}}' })
                                .done(function( data ) {
                                    location.href = '{{url('/ticket/tickets?stato=1')}}';
                                });
                    });
        }

        $(function() {
            $("#cliente").change(function () {
                var id = $("#cliente").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });
            $("#cliente_finale").change(function () {
                var id = $("#cliente_finale").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#cliente_finale_ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#cliente_finale_ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#cliente_finale_indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#cliente_finale_indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#cliente_finale_citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#cliente_finale_citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });
            $("#ubicazione").change(function () {
                var id = $("#ubicazione").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#ubicazione_ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#ubicazione_ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#ubicazione_indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#ubicazione_indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#ubicazione_citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#ubicazione_citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });

            $(".edit").on("keyup", function(){
                $(this).attr("value", $(this).val());
            });

            $(".edit-date").on("change", function(){
                $(this).attr("value", $(this).val());
            });

            $(".edit-textarea").on("keyup", function(){
                $(this).html($(this).val());
            });

            $(".edit-checkbox").on("change", function(){
                if( $(this).prop('checked'))
                    $(this).attr("checked","checked");
                else
                    $(this).removeAttr('checked');
            });

            $("#cliente").val('{{Input::get('cliente')}}').trigger("change");
            $("#cliente_finale").val('{{Input::get('cliente_finale')}}').trigger("change");
            $("#ubicazione").val('{{Input::get('ubicazione_impianto')}}').trigger("change");

            $('textarea').each(function () {
                h(this);
            }).on('input', function () {
                h(this);
            });

        });

    </script>
@endsection