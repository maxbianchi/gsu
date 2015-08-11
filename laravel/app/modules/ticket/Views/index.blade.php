@extends('ticket::app')




@section('content')
<br><br>
<br><br>

<table>
    <tr>
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
    <tr>
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
                        <td colspan="2">
                            CLIENTE
                        </td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            Ragione Sociale
                        </td>
                        <td style="width:80%">
                            <input type="text" value="" id="ragionesociale" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Indirizzo
                        </td>
                        <td>
                            <input type="text" value="" id="indirizzo" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Citt&agrave;
                        </td>
                        <td>
                            <input type="text" value="" id="citta" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            UBICAZIONE
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Indirizzo
                        </td>
                        <td>
                            <input type="text" value="" id="ubicazione_indirizzo" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Citt&agrave;
                        </td>
                        <td>
                            <input type="text" value="" id="ubicazione_citta" class="edit" style="width:100%">
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
                            <input type="text" value="" id="riferimento" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tel.
                        </td>
                        <td>
                            <input type="text" value="" id="telefono" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mail:
                        </td>
                        <td>
                            <input type="text" value="" id="mail" class="edit" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <div style="border:solid 1px; text-align: center;">RDI - Rapporto di intervento tecnico nr. 20150707 del 07/07/2015</div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <div style="border:solid 1px; text-align: center;">
                    <table>
                        <tr>
                            <td style="text-align: center;">
                                Matricola <input type="text" value="" id="matricola" class="edit" style="width:100%">
                            </td>
                            <td style="text-align: center;">
                                Lettura Tot bn <input type="text" value="" id="tot_bn" class="edit" style="width:100%">
                            </td>
                            <td style="text-align: center;">
                                Lettura Tot colore <input type="text" value="" id="tot_colore" class="edit" style="width:100%">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Modello  <input type="text" value="" id="modello" class="edit" style="width:100%">
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <div style="border:solid 1px; text-align: center;">
                    Motivo della chiamata <textarea value="" id="motivo" class="edit-textarea" style="width:100%" rows="3"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <div style="border:solid 1px; text-align: center;">
                    Descrizione Intervento <textarea value="" id="descrizione" class="edit-textarea" style="width:100%" rows="3"></textarea>
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
                           <input type="text" value="" id="codice1" class="edit" style="width:100%">
                       </td>
                       <td style="width:40%">
                           <input type="text" value="" id="descrizione1" class="edit" style="width:100%">
                       </td>
                       <td  style="width:10%">
                           <input type="text" value="" id="qta1" class="edit" style="width:100%">
                       </td>
                       <td  style="width:30%">
                           <input type="text" value="" id="note1" class="edit" style="width:100%">
                       </td>
                   </tr>
                   <tr>
                       <td style="width:20%">
                           <input type="text" value="" id="codice2" class="edit" style="width:100%">
                       </td>
                       <td style="width:40%">
                           <input type="text" value="" id="descrizione2" class="edit" style="width:100%">
                       </td>
                       <td  style="width:10%">
                           <input type="text" value="" id="qta2" class="edit" style="width:100%">
                       </td>
                       <td  style="width:30%">
                           <input type="text" value="" id="note2" class="edit" style="width:100%">
                       </td>
                   </tr>
                   <tr>
                       <td style="width:20%">
                           <input type="text" value="" id="codice3" class="edit" style="width:100%">
                       </td>
                       <td style="width:40%">
                           <input type="text" value="" id="descrizione3" class="edit" style="width:100%">
                       </td>
                       <td  style="width:10%">
                           <input type="text" value="" id="qta3" class="edit" style="width:100%">
                       </td>
                       <td  style="width:30%">
                           <input type="text" value="" id="note3" class="edit" style="width:100%">
                       </td>
                   </tr>

               </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <table style="width:100%">
                    <tr>
                        <td style="width:20%">
                            Data Intervento
                        </td>
                        <td style="width:20%">
                            <input type="text" value="" id="data_intervento" class="edit-date datepicker" style="width:100%">
                        </td>
                        <td  style="width:20%">
                            Intervento Remoto
                        </td>
                        <td  style="width:30%">
                            <input type="checkbox" value="" id="data_intervento" class="edit-checkbox" style="width:100%">
                        </td>
                    </tr>
                    </table>
                    <table>
                    <tr>
                        <td style="width:10%">
                            Tempo Viaggio
                        </td>
                        <td style="width:10%">
                            <input type="text" value="" id="descrizione1" class="edit" style="width:100%">
                        </td>
                        <td  style="width:10%">
                            Ora inizio intervento
                        </td>
                        <td  style="width:10%">
                            <input type="text" value="" id="note1" class="edit" style="width:100%">
                        </td>
                        <td  style="width:10%">
                            Ora fine intervento
                        </td>
                        <td  style="width:10%">
                            <input type="text" value="" id="note1" class="edit" style="width:100%">
                        </td>
                    </tr>
                        <tr>
                            <td style="width:10%">
                                Tempo Viaggio
                            </td>
                            <td style="width:10%">
                                <input type="text" value="" id="descrizione1" class="edit" style="width:100%">
                            </td>
                            <td  style="width:10%">
                                Ora inizio intervento
                            </td>
                            <td  style="width:10%">
                                <input type="text" value="" id="note1" class="edit" style="width:100%">
                            </td>
                            <td  style="width:10%">
                                Ora fine intervento
                            </td>
                            <td  style="width:10%">
                                <input type="text" value="" id="note1" class="edit" style="width:100%">
                            </td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px;">
                <div style="border:solid 1px; text-align: center;">
                    Note sull'intervento <textarea value="" id="note" class="edit-textarea" style="width:100%" rows="3">eefwrrtwtrt</textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width:100%">
                    <tr>
                        <td style="width:50%">
                            Intervento risolutivo <input type="checkbox" value="" id="data_intervento" name="data_intervento" class="edit-checkbox">SI <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">NO
                        </td>
                        <td style="width:50%">
                            In garanzia <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">SI <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">NO
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            Macchina in funzione <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">SI <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">NO
                        </td>
                        <td style="width:50%">
                            Macchina ferma <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">SI <input type="checkbox" value="" id="data_intervento" class="edit-checkbox">NO
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%" colspan="2">
                <table style="width:100%" border="1">
                    <tr>
                        <td style="width:50%; height: 50pt;" valign="top">
                            Timbro e firma del cliente
                        </td>
                        <td style="width:50%; height: 50pt;" valign="top">
                            Tecnico
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </div>


<br>
<br>
    <input type="button" value="toPDF" onclick="toPDF();">


@endsection

@section('script')
    <script type="text/javascript">


        function toPDF() {
            var html="<!DOCTYPE html><body>";
            html+= document.getElementById('toPrint').innerHTML;
            html+="</body></html>";

            $.post( "/ticket/pdf", { html: html, '_token': '{{ csrf_token() }}'})
                    .done(function( data ) {
                    });
        }

        $(function() {
            $("#cliente").change(function () {
                var id = $("#cliente").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            $("#ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#indirizzo").val(data[0]['INDIRIZZO']);
                            $("#indirizzo").attr("value", (data[0]['INDIRIZZO']));
                            $("#citta").val(data[0]['LOCALITA']);
                            $("#citta").attr("value", (data[0]['LOCALITA']));
                        });
            });
            $("#ubicazione").change(function () {
                var id = $("#ubicazione").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            $("#ubicazione_indirizzo").val(data[0]['DESCRIZIONE']);
                            $("#ubicazione_indirizzo").attr("value", (data[0]['DESCRIZIONE']));
                            $("#ubicazione_citta").val(data[0]['INDIRIZZO']);
                            $("#ubicazione_citta").attr("value", (data[0]['INDIRIZZO']));
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

        });

    </script>
@endsection