@extends('gsu::app')

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

    <form action="#" method="post" id="form">


        <div class="container-fluid">
            <div class="border">
                <table class="tbl_clienti" style="width:100%">
                    <tbody>
                    <tr class="soggetto">
                        <td>CLIENTE</td>
                        <td>
                            <select name="cliente">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="cliente">
                        <td>CLIENTE FINALE</td>
                        <td>
                            <select name="cliente_finale">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['CLIENTE_CODICE']) && $request['CLIENTE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="destinatarioabituale">
                        <td>UBICAZIONE IMPIANTO</td>
                        <td>
                            <select name="ubicazione_impianto">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['DESTINATARIOABITUALE_CODICE']) && $request['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>




    <br><br>

        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">

                <tr>
                    <td>COD MANUTENZIONE </td>
                    <td class="manutenzione">{{$request['MANUTENZIONE'] or ""}}</td>
                </tr>
                <tr>
                    <td>ACQUISTO / NOLEGGIO</td>
                    <td>
                        <select name="acquisto_noleggio">
                            <option value="Acquisto" {{isset($request['ACQUISTO_NOLEGGIO']) && strtolower($request['ACQUISTO_NOLEGGIO']) == 'acquisto' ? 'selected="selected"' : ""  }}>Acquisto</option>
                            <option value="Noleggio" {{isset($request['ACQUISTO_NOLEGGIO']) && strtolower($request['ACQUISTO_NOLEGGIO']) == 'noleggio' ? 'selected="selected"' : ""  }}>Noleggio</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>DATA ACQUISTO</td>
                    <td><input type="text" name="dataacquisto" value="{{$request['DATAACQUISTO'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>MARCA</td>
                    <td><input type="text" name="marca" value="{{$request['MARCA'] or ""}}"></td>
                </tr>
                <tr>
                    <td>MODELLO</td>
                    <td><input type="text" name="modello" value="{{$request['MODELLO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PART NUMBER</td>
                    <td><input type="text" name="pn" value="{{$request['PN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERIALE</td>
                    <td><input type="text" name="sn" value="{{$request['SN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PIN</td>
                    <td><input type="text" name="pin" value="{{$request['PIN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>DATA SCAD GARANZIA INIZIALE</td>
                    <td><input type="text" name="scadegaranziainiz" value="{{$request['SCADGARANZIAINIZ'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>CODICE RINN GARANZIA</td>
                    <td><input type="text" name="rinnovogaranzia" value="{{$request['RINNOVOGARANZIA'] or ""}}" ></td>
                </tr>
                <tr>
                    <td>DATA SCAD GARANZIA</td>
                    <td><input type="text" name="scadrinnovogaranzia" value="{{$request['SCADRINNOVOGARANZIA'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>ACERADVANTAGE</td>
                    <td><input type="text" name="aceradvantage" value="{{$request['ACERADVANTAGE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PSWACER</td>
                    <td><input type="text" name="pswacer" value="{{$request['PSWACER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NUMERO ENERGYCARD</td>
                    <td><input type="text" name="numeroenergycard" value="{{$request['NUMEROENERGYCARD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SOS CLIENTE</td>
                    <td><input type="text" name="soscliente" value="{{$request['SOSCLIENTE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SOS CONTRATTO</td>
                    <td><input type="text" name="soscontratto" value="{{$request['SOSCONTRATTO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ASSISTENZA TECNICA HW</td>
                    <td><input type="text" name="assistenza_tecnica" value="{{$assistenzatecnica}}" style="background-color:{{$assistenzatecnica == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>POST WARRANTY HW</td>
                    <td><input type="text" name="post_warranty" value="{{$post_warranty}}" style="background-color:{{$post_warranty == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>DATA INSERIMENTO ( solo lettura )</td>
                    <td><input type="text" name="data_inserimento" value="{{$request['DATA_INSERIMENTO'] or ""}}" readonly disabled></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or Input::get("manutenzione")}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDSERVER'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">
                        @if($btn == 'save' && Input::get("eliminato") != 1)
                            <input type="button" value="SALVA" id="btn_salva" class="btn btn-primary btn-xs">
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-default btn-xs pull right">
                            <div class="pull-right"><input type="checkbox" name="eliminato" <?php echo Input::get('eliminati') != 'on' ? '' :  "checked" ?> >ELIMINATO</div>
                        @else
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">
                        @endif
                    </td>
                </tr>
        </table>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    if(!isset($request['SOGGETTO']))
        $request['SOGGETTO'] = "";
    if(!isset($request['CLIENTE']))
        $request['CLIENTE'] = "";
    if(!isset($request['DESTINATARIOABITUALE']))
        $request['DESTINATARIOABITUALE'] = "";
    if(!isset($request['SN']))
        $request['SN'] = "";
    if(!isset($request['IDSERVER']))
        $request['IDSERVER'] = "";
    $request['SOGGETTO'] = trim($request['SOGGETTO']);
    $request['CLIENTE'] = trim($request['CLIENTE']);
    $request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
    ?>

    <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
        <tr>
            <td>
                <a href="{{url('/gsu/hardware-pwd/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&apparato_id=".$request['IDSERVER']}}">PASSWORD</a>
            </td>
        </tr>
    </table>
    <br>
    <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
        <tr>
            <td>
                <a href="{{url('/gsu/assistenza-tecnica-hw/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SN']}}">ASSISTENZA TECNICA HW</a>
            </td>
            <td>
                <a href="{{url('/gsu/post-warranty/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SN']}}">POST WARRANTY HW</a>
            </td>
            <td>
                <a href="{{url('/gsu/housing/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SN']}}">HOUSING</a>
            </td>
        </tr>
    </table>
<br><br>
@endsection



@section('script')
    <script>
        $(document).ready(function () {
            @if($btn == 'back')
                $( ":text" ).prop('readonly', true);
                $( "select" ).prop('disabled', true);
            @endif

            $("#btn_salva").click(function(){
                         $.post( "{{url('/gsu/hardware/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });

                    });

        });
    </script>

@endsection