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
                    <td>TOKEN</td>
                    <td><input type="text" name="token" value="{{$request['TOKEN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERVICE</td>
                    <td><input type="text" name="service" value="{{$request['SERVICE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PRODUCT_CODE</td>
                    <td><input type="text" name="product_code" value="{{$request['PRODUCT_CODE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>CONTRATTO</td>
                    <td><input type="text" name="contratto" value="{{$request['CONTRATTO'] or ""}}"></td>
                </tr>
                 <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDAPPARATO'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>
            </form>
        </table>
        
    <hr>


@endsection
