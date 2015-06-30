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
    @if(View::exists('gsu::varie.cliente-details'))
        @include('gsu::varie.cliente-details')
    @endif

    <br><br>
    <fieldset class="dettaglio_dati">
        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
            <form action="#" method="post" id="form">
                <tr>
                    <td>COD MANUTENZIONE </td>
                    <td class="manutenzione">{{$request['MANUTENZIONE'] or ""}}</td>
                </tr>
                <tr>
                    <td>SERIALE</td>
                    <td><input type="text" name="seriale" value="{{$request['SERIALE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NOME HOST</td>
                    <td><input type="text" name="nomepc" value="{{$request['NOMEPC'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SISTEMA OPERATIVO</td>
                    <td><input type="text" name="os" value="{{$request['OS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ACCESSO</td>
                    <td><input type="text" name="accesso" value="{{$request['ACCESSO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>INDIRIZZO IP</td>
                    <td><input type="text" name="ip" value="{{$request['IP'] or ""}}"></td>
                </tr>
                <tr>
                    <td>INDIRIZZO IP PUBBLICO</td>
                    <td><input type="text" name="ippubblico" value="{{$request['IPPUBBLICO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NOTE</td>
                    <td><textarea rows="8" cols="70" name="note" value="{{$request['NOTE'] or ""}}">{{$request['NOTE'] or ""}}</textarea></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDTELEASSISTENZA'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>
            </form>
        </table>
        
    <hr>

         <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <tr>
                <td>
                    <a href="{{url('/gsu/hardware-pwd/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&apparato_id=".$request['IDTELEASSISTENZA']."&id=".$request['IDTELEASSISTENZA']."&seriale=".$request['SERIALE']}}">PASSWORD</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('/gsu/search')."?canone=CAN-G101A&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SERIALE']}}">SERVER</a>
                </td>
                <td>
                    <a href="{{url('/gsu/search')."?canone=CAN-G102A&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SERIALE']}}">CLIENT</a>
                </td>
                <td>
                    <a href="{{url('/gsu/search')."?canone=CAN-G101-&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&seriale=".$request['SERIALE']}}">UTENTE AGGIUNTIVO</a>
                </td>
                <td>
                    <a href="{{url('/gsu/hardware/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&sn=".$request['SERIALE']}}">HARDWARE</a>
                </td>
            </tr>
        </table>

@endsection

