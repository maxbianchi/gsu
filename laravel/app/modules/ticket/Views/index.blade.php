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

    <table style="width:100%; font-size:9px;" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top" style="width:30%;">
                <img src="{{ URL::asset('images/Banner.png') }}" >
            </td>
            <td style="width:70%;">
                <table>
                    <tr>
                        <td>
                            CLIENTE
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ragione Sociale
                        </td>
                        <td style="width:100%">
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
                        <td>
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
                            <hr></hr>
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
    </table>
    </div>


<br>
<br>
    <input type="button" value="toPDF" onclick="toPDF();">


@endsection

@section('script')
    <script type="text/javascript">


        function toPDF() {
            var html="<html><body>";
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

        });

    </script>
@endsection