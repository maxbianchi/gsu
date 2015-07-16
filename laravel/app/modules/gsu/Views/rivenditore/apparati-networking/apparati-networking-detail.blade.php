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
                    <tr class="destinatarioabituale" >
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
                    <td>PRODOTTO</td>
                    <td><input type="text" name="prodotto" value="{{$request['PRODOTTO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ACQUISTO / NOLEGGIO</td>
                    <td><input type="text" name="acquisto_noleggio" value="{{$request['ACQUISTO_NOLEGGIO'] or ""}}"></td>
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
                    <td>SERIAL NUMBER</td>
                    <td><input type="text" name="sn" value="{{$request['SN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERIAL NUMBER</td>
                    <td><input type="text" name="sn" value="{{$request['SN'] or ""}}"></td>
                </tr>
                <tr>
                    <td>RAM</td>
                    <td><input type="text" name="ram" value="{{$request['RAM'] or ""}}"></td>
                </tr>
                <tr>
                    <td>FLASH</td>
                    <td><input type="text" name="flash" value="{{$request['FLASH'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SOFTWARE</td>
                    <td><input type="text" name="software" value="{{$request['SOFTWARE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IOS</td>
                    <td><input type="text" name="ios" value="{{$request['IOS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ASDM_PDM</td>
                    <td><input type="text" name="asdm_pdm" value="{{$request['ASDM_PDM'] or ""}}"></td>
                </tr>
                <tr>
                    <td>DES_AES</td>
                    <td><input type="text" name="des_aes" value="{{$request['DES_AES'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SCADENZA GARANZIA</td>
                    <td><input type="text" name="scadenza_garanzia" value="{{$request['SCADENZAGARANZIA'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>SCADENZA RINNOVO GARANZIA</td>
                    <td><input type="text" name="scarinngaranzia" value="{{$request['SCARINNGARANZIA'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>URL FILTERING</td>
                    <td><input type="text" name="urlfiltering" value="{{$urlfiltering}}" style="background-color:{{$urlfiltering == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>SMART NET</td>
                    <td><input type="text" name="smartnet" value="{{$smartnet}}" style="background-color:{{$smartnet == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>VPN</td>
                    <td><input type="text" name="vpn" value="{{$vpn}}" style="background-color:{{$vpn == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>IP MULTIMEDIA</td>
                    <td><input type="text" name="ipmultimedia" value="{{$ipmultimedia}}" style="background-color:{{$ipmultimedia == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>GESTIONE APPARATO</td>
                    <td><input type="text" name="gestioneapparato" value="{{$gestioneapparato}}" style="background-color:{{$gestioneapparato == "SI" ? "green" : "red" }}" class="servizi"></td>
                </tr>
                <tr>
                    <td>IP PUBBLICO</td>
                    <td><input type="text" name="ip_statico_router" value="{{$request['IP_STATICO_ROUTER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IP PRIVATO</td>
                    <td><input type="text" name="gateway_interfaccia_lan" value="{{$request['GATEWAY_INTERFACCIA_LAN'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['ID'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>
        </table>
    </form>
    <hr>

    <?php
    if(!isset($request['SOGGETTO']))
        $request['SOGGETTO'] = "";
    if(!isset($request['CLIENTE']))
        $request['CLIENTE'] = "";
    if(!isset($request['DESTINATARIOABITUALE']))
        $request['DESTINATARIOABITUALE'] = "";
    if(!isset($request['ID']))
        $request['ID'] = "";
    $request['SOGGETTO'] = trim($request['SOGGETTO']);
    $request['CLIENTE'] = trim($request['CLIENTE']);
    $request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
    ?>

    <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
        <tr>
            <td>
                <a href="{{url('/gsu/dial-up/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">DIAL UP</a>
            </td>
            <td>
                <a href="{{url('/gsu/adsl/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ADSL ACCESS</a>
            </td>
            <td>
                <a href="{{url('/gsu/direct-access/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">DIRECT ACCESS</a>
            </td>
            <td>
                <a href="{{url('/gsu/mpls/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">MPLS ADSL ACCESS</a>
            </td>
            <td>
                <a href="{{url('/gsu/mpls-direct-access/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">MPLS DIRECT ACCESS</a>
            </td>
            <td>
                <a href="{{url('/gsu/url-filtering/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">URL FILTERING</a>
            </td>
            <td>
                <a href="{{url('/gsu/smartnet/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SMART NET</a>
            </td>
            <td>
                <a href="{{url('/gsu/gestione-apparati/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">GESTIONE APPARATO</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{url('/gsu/vpn/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">VPN</a>
            </td>
            <td colspan="7">
                <a href="{{url('/gsu/ipmultimedia/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">IP MULTIMEDIA</a>
            </td>
        </tr>
    </table>

    <br><br>

@endsection
