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
                            <select name="cliente" disabled="disabled">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['SOGGETTO_CODICE']) && $request['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="cliente">
                        <td>CLIENTE FINALE</td>
                        <td>
                            <select name="cliente_finale" disabled="disabled">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['CLIENTE_CODICE']) && $request['CLIENTE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="destinatarioabituale">
                        <td>UBICAZIONE IMPIANTO</td>
                        <td>
                            <select name="ubicazione_impianto" disabled="disabled">
                                <option value="">-----</option>
                                @foreach($users as $user)
                                    <option value="{{$user['SOGGETTO']}}" {{isset($request['DESTINATARIOABITUALE_CODICE']) && $request['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
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
                    <td>TIPO SERVIZIO</td>
                    <td><input type="text" name="tipo_servizio" value="{{$request['TIPO_SERVIZIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERVER</td>
                    <td><input type="text" name="server" value="{{$request['SERVER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>DIRECTORY</td>
                    <td><input type="text" name="directory" value="{{$request['DIRECTORY'] or ""}}"></td>
                </tr>
                <tr>
                    <td>LOGIN</td>
                    <td><input type="text" name="login" value="{{$request['LOGIN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td><input type="text" name="password" value="{{$request['PASSWORD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ANALISI LOG</td>
                    <td><input type="text" name="analisi_log" value="{{$request['ANALISI_LOG'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDSERVIZIOWEB'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>
        </table>
    </form>
    <hr>

@endsection
