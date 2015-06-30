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
                    <td><input type="text" name="seriale" value="{{$request['SN'] or ""}}"></td>
                </tr>
                 <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['ID'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">
                        @if($btn == 'save')
                            <input type="button" value="SALVA" id="btn_salva" class="btn btn-primary btn-xs">
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-default btn-xs">
                            <div class="pull-right"><input type="checkbox" name="eliminato" <?php echo Input::get('eliminati') != 'on' ? '' :  "checked" ?> >ELIMINATO</div>
                        @else
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">
                        @endif
                    </td>
                </tr>
            </form>
        </table>
        
    <hr>


        <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <tr>
                <td>
                    <a href="{{url('/gsu/multifunzione/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">MULTIFUNZIONE</a>
                </td>
                <td>
                    <a href="{{url('/gsu/assistenza-tecnica-consumabile-nero/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">CONSUMABILE NERO</a>
                </td>
                <td>
                    <a href="{{url('/gsu/assistenza-tecnica-consumabile-colori/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">CONSUMABILE COLORI</a>
                </td>
            </tr>
        </table>

@endsection


