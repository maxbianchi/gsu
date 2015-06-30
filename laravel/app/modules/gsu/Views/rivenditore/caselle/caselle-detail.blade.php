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
                    <td>TIPO UTENTE</td>
                    <td>
                        <select name="tipo_utente">
                            <option value="A" {{isset($request['TIPO_UTENTE']) && $request['TIPO_UTENTE'] == "A" ? 'selected="selected"' : ""  }}>Aziendale</option>
                            <option value="P" {{isset($request['TIPO_UTENTE']) && $request['TIPO_UTENTE'] == "P" ? 'selected="selected"' : ""  }}>Privato</option>
                            <option value="R" {{isset($request['TIPO_UTENTE']) && $request['TIPO_UTENTE'] == "R" ? 'selected="selected"' : ""  }}>Rivenditore</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>TIPO CASELLA</td>
                    <td>
                        <select name="tipo">
                            <option value="Alias" {{isset($request['TIPO']) && $request['TIPO'] == "Alias" ? 'selected="selected"' : ""  }}>Alias</option>
                            <option value="Interno" {{isset($request['TIPO']) && $request['TIPO'] == "Interno" ? 'selected="selected"' : ""  }}>Interno</option>
                            <option value="Relay di Posta"	{{isset($request['TIPO']) && $request['TIPO'] == "Relay di Posta" ? 'selected="selected"' : ""  }}>Relay di Posta</option>
                            <option value="Smtp Auth" {{isset($request['TIPO']) && $request['TIPO'] == "Smtp Auth" ? 'selected="selected"' : ""  }}>Smtp Auth</option>
                            <option value="PEC"		{{isset($request['TIPO']) && $request['TIPO'] == "PEC" ? 'selected="selected"' : ""  }}>PEC</option>
                            <option value="" 		{{isset($request['TIPO']) && ($request['TIPO'] == "1" || empty($request['TIPO'])) ? 'selected="selected"' : ""  }}></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>MEGABYTE</td>
                    <td><input type="text" name="megabyte" value="{{$request['MEGABYTE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ACCOUNT</td>
                    <td><input type="text" name="account" value="{{$request['ACCOUNT'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td><input type="text" name="password" value="{{$request['PASSWORD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>EMAIL</td>
                    <td><input type="text" name="email" value="{{$request['EMAIL'] or ""}}"></td>
                </tr>
                <tr>
                    <td>POP3</td>
                    <td><input type="text" name="pop3" value="{{$request['POP3'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SMTP</td>
                    <td><input type="text" name="smtp" value="{{$request['SMTP'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NOTE</td>
                    <td><input type="text" name="note" value="{{$request['NOTE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_1</td>
                    <td><input type="text" name="alias_1" value="{{$request['ALIAS_1'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_2</td>
                    <td><input type="text" name="alias_2" value="{{$request['ALIAS_2'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_3</td>
                    <td><input type="text" name="alias_3" value="{{$request['ALIAS_3'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_4</td>
                    <td><input type="text" name="alias_4" value="{{$request['ALIAS_4'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_5</td>
                    <td><input type="text" name="alias_5" value="{{$request['ALIAS_5'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_6</td>
                    <td><input type="text" name="alias_6" value="{{$request['ALIAS_6'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_7</td>
                    <td><input type="text" name="alias_7" value="{{$request['ALIAS_7'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_8</td>
                    <td><input type="text" name="alias_8" value="{{$request['ALIAS_8'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_9</td>
                    <td><input type="text" name="alias_9" value="{{$request['ALIAS_9'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_10</td>
                    <td><input type="text" name="alias_10" value="{{$request['ALIAS_10'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_11</td>
                    <td><input type="text" name="alias_11" value="{{$request['ALIAS_11'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ALIAS_12</td>
                    <td><input type="text" name="alias_12" value="{{$request['ALIAS_12'] or ""}}"></td>
                </tr>
                <tr>
                    <td>FORWARD</td>
                    <td><input type="text" name="forward" value="{{$request['FORWARD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>COPIA</td>
                    <td><input type="text" name="copia" value="{{$request['COPIA'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ACTIVE SYNC</td>
                    <td><input type="text" name="activesync" value="{{$activesync or ""}}" style="background-color:{{$activesync == "SI" ? "green" : "red" }}"></td>
                </tr>
                <tr>
                    <td>OUTLOOK CONNECTOR</td>
                    <td><input type="text" name="outlookconnector" value="{{$outlookconnector or ""}}" style="background-color:{{$outlookconnector == "SI" ? "green" : "red" }}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDCASELLA'] or ""}}">
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
                    <a href="{{url('/gsu/search')."?canone=CAN-G104A&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">MAIL SERVER</a>
                </td>
                <td>
                    <a href="{{url('/gsu/activesync/search')."?canone=CAN-E132&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ACTIVESYNC</a>
                </td>
                <td>
                    <a href="{{url('/gsu/outlookconnector/search')."?canone=CAN-E131&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">OUTLOOK CONNECTOR</a>
                </td>
            </tr>
        </table>


@endsection
