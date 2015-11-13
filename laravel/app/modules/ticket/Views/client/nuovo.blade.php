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
                <td></td>
                <td></td>
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
                <td>NOME REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="nome_referente" id="nome_referente" value="{{$request['NOME_REFERENTE'] or ""}}"></td>
                <td>TELEFONO REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="telefono_referente" id="telefono_referente" value="{{$res['TELEFONO_REFERENTE'] or ""}}"></td>
            </tr>
            <tr>
                <td>EMAIL REFERENTE</td>
                <td><input type="text" style="background-color: #FFC;" name="email_referente" id="email_referente" value="{{$res['EMAIL_REFERENTE'] or ""}}"></td>
                <td>ATTIVIT&Agrave; APERTA IL</td>
                <td><input type="text" name="apertail" readonly="readonly" disabled="disabled" value="{{$request['APERTAIL'] or ""}}"></td>
            </tr>
            <tr>
                <td>TGU / IMEI</td>
                <td><input type="text" style="background-color: #FFC;" name="tgu" id="tgu" value="{{$request['TGU'] or ""}}"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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
                <td></td>
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
        <input type="hidden" name="incaricoa" value="0">
        <input type="hidden" name="apertoda" value="0">
        <?php $soggetto = Session::get("user");
              $soggetto = $soggetto['SOGGETTO'];
        ?>
        <input type="hidden" value="{{$soggetto}}" name="soggetto" id="soggetto" >
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



                    $(".salva-ticket").click(function(){
                       $.post( "{{url('/ticket/salvanuovo')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    location.href = '{{ URL::previous() }}';
                                });
                    });


                    $("#soggetto").change(function(){
                        $.post( "{{url('/ticket/getdatacliente')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    data = JSON.parse(data);
                                    $("#email").val(data[0]['EMAIL']);
                                    $("#telefono_referente").val(data[0]['TELEFONO']);
                                });
                    });

                    $("#soggetto").trigger("change");
                });
            </script>

@endsection