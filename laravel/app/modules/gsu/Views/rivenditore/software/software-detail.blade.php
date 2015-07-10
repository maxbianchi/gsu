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
                    <td>TIPO LICENZA</td>
                    <td>
                        <select name="tipo_licenza">
                            <option value="" {{isset($request['TIPO_LICENZA']) && $request['TIPO_LICENZA'] == "" ? 'selected="selected"' : ""  }}>--- Nessuna licenza ---</option>
                            <option value="Box" {{isset($request['TIPO_LICENZA']) && $request['TIPO_LICENZA'] == "Box" ? 'selected="selected"' : ""  }}>Box</option>
                            <option value="Multilicenza" {{isset($request['TIPO_LICENZA']) && $request['TIPO_LICENZA'] == "Multilicenza" ? 'selected="selected"' : ""  }}>Multilicenza</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>QUANTITA</td>
                    <td><input type="text" name="quantita" value="{{$request['QUANTITA'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SCADENZA</td>
                    <td><input type="text" name="scadenza" value="{{$request['SCADENZA'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERIALE</td>
                    <td><input type="text" name="seriale" value="{{$request['SERIALE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NOTE</td>
                    <td><textarea name="note" rows="10" cols="80">{{$request['NOTE'] or ""}}</textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDSOFTWARE'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>
            </form>
        </table>

        <hr>

 @endsection
