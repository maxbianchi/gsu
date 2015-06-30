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
                    <td>NOME DOMINIO</td>
                    <td><input type="text" name="nome_dominio" value="{{$request['NOMEDOMINIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>UTENTE</td>
                    <td><input type="text" name="utente" value="{{$request['UTENTE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td><input type="text" name="password" value="{{$request['PASSWORD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA1</td>
                    <td><input type="text" name="parola1" value="{{$request['PAROLA1'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA2</td>
                    <td><input type="text" name="parola2" value="{{$request['PAROLA2'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA3</td>
                    <td><input type="text" name="parola3" value="{{$request['PAROLA3'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA4</td>
                    <td><input type="text" name="parola4" value="{{$request['PAROLA4'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA5</td>
                    <td><input type="text" name="parola5" value="{{$request['PAROLA5'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA6</td>
                    <td><input type="text" name="parola6" value="{{$request['PAROLA6'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA7</td>
                    <td><input type="text" name="parola7" value="{{$request['PAROLA7'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA8</td>
                    <td><input type="text" name="parola8" value="{{$request['PAROLA8'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA9</td>
                    <td><input type="text" name="parola9" value="{{$request['PAROLA9'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PAROLA10</td>
                    <td><input type="text" name="parola10" value="{{$request['PAROLA10'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDMOTORIDIRICERCA'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>

            </form>
        </table>
        
    <hr>


@endsection
