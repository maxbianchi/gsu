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
                    <td>TIPO</td>
                    <td><input type="text" name="tipo" value="{{$request['TIPO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERVER</td>
                    <td><input type="text" name="server" value="{{$request['SERVER_'] or ""}}"></td>
                </tr>
                <tr>
                    <td>GESTIONE</td>
                    <td><input type="text" name="gestione" value="{{$request['GESTIONE'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDHOUSING'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>

            </form>
        </table>
        
    <hr>

        <?php
        if(!isset($request['SOGGETTO']))
            $request['SOGGETTO'] = "";
        if(!isset($request['CLIENTE']))
            $request['CLIENTE'] = "";
        if(!isset($request['DESTINATARIOABITUALE']))
            $request['DESTINATARIOABITUALE'] = "";
        if(!isset($request['SERIALE']))
            $request['SERIALE'] = "";
        $request['SOGGETTO'] = trim($request['SOGGETTO']);
        $request['CLIENTE'] = trim($request['CLIENTE']);
        $request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
        ?>

        <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <tr>
                <td>
                    <a href="{{url('/gsu/assistenza-tecnica-hw/search')."?canone=CAN-G10&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ASSISTENZA TECNICA HW</a>
                </td>
                <td>
                    <a href="{{url('/gsu/hardware/search')."?sn=".$request['SERIALE']."&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">HARDWARE</a>
                </td>
            </tr>
        </table>


        @endsection
