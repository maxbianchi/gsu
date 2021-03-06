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
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>TIPO LINEA</td>
                    <td><input type="text" name="tipo_linea" value="{{$request['TIPO_LINEA'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>LINEA FORNITORE</td>
                    <td><input type="text" name="linea_fornitore" value="{{$request['LINEA_FORNITORE'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>NUMERO TELEFONO</td>
                    <td><input type="text" name="numero_telefono" value="{{$request['NUMERO_TELEFONO'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>TGU</td>
                    <td><input type="text" name="tgu" value="{{$request['TGU'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>IP STATICI / SUBNET</td>
                    <td><input type="text" name="ip_statici" value="{{$request['IP_STATICI_SUBNET'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="ipsub" value="{{$request['IPSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>GATEWAY WAN / PUNTO A PUNTO</td>
                    <td><input type="text" name="gateway_wan_punto_punto" value="{{$request['GATEWAY_WAN_PUNTO_A_PUNTO'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="wansub" value="{{$request['WANSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>GATEWAY INTERFACCIA LAN</td>
                    <td><input type="text" name="gateway_interfaccia_lan" value="{{$request['GATEWAY_INTERFACCIA_LAN'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="lansub" value="{{$request['LANSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IP STATICO ROUTER</td>
                    <td><input type="text" name="ip_statico_router" value="{{$request['IP_STATICO_ROUTER'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="rutsub" value="{{$request['RUTSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NUMERO IP STATICI</td>
                    <td>
                        <select name="numero_ip_statici">
                            <option value="">--- Selezionare Numero Ip Statici ---</option>
                            <option value="1" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 1 ? 'selected="selected"' : ""  }}>1</option>
                            <option value="8" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 8 ? 'selected="selected"' : ""  }}>8</option>
                            <option value="16" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 16 ? 'selected="selected"' : ""  }}>16</option>
                            <option value="32" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 32 ? 'selected="selected"' : ""  }}>32</option>
                            <option value="64" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 64 ? 'selected="selected"' : ""  }}>64</option>
                            <option value="128" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 128 ? 'selected="selected"' : ""  }}>128</option>
                            <option value="256" {{isset($request['NUM_IP_STATICI']) && $request['NUM_IP_STATICI'] == 256 ? 'selected="selected"' : ""  }}>256</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>MODALITA'</td>
                    <td>
                        <select name="modalita">
                            <option value="">--- Selezionare Modalità ---</option>
                            <option value="FAST" {{isset($request['MODALITA']) && trim($request['MODALITA']) == "FAST" ? 'selected="selected"' : ""  }}>FAST</option>
                            <option value="INTERLEAVED" {{isset($request['MODALITA']) && trim($request['MODALITA']) == "INTERLEAVED" ? 'selected="selected"' : ""  }}>INTERLEAVED</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>DNS PRIMARIO</td>
                    <td>
                        <select name="dns_primario">
                            <option value="">--- Selezionare DNS ---</option>
                            <option value="8.8.8.8" {{isset($request['DNS_PRIMARIO']) && $request['DNS_PRIMARIO'] == "8.8.8.8" ? 'selected="selected"' : ""  }}>8.8.8.8</option>
                            <option value="8.8.4.4" {{isset($request['DNS_PRIMARIO']) && $request['DNS_PRIMARIO'] == "8.8.4.4" ? 'selected="selected"' : ""  }}>8.8.4.4</option>
                            <option value="151.99.125.1" {{isset($request['DNS_PRIMARIO']) && $request['DNS_PRIMARIO'] == "151.99.125.1" ? 'selected="selected"' : ""  }}>151.99.125.1</option>
                            <option value="151.99.0.100" {{isset($request['DNS_PRIMARIO']) && $request['DNS_PRIMARIO'] == "151.99.0.100" ? 'selected="selected"' : ""  }}>151.99.0.100</option>
                            <?php
                            $dnsprimario = ["8.8.8.8", "8.8.4.4", "151.99.125.1", "151.99.0.100"];
                            if(isset($request['DNS_PRIMARIO']) && !in_array($request['DNS_PRIMARIO'], $dnsprimario))
                                echo '<option value="'.$request['DNS_PRIMARIO'].'" selected="selected">'.$request['DNS_PRIMARIO'].'</option>';
                            ?>
                        </select>
                    </td>
                    <td>DNS SECONDARIO</td>
                    <td>
                        <select name="dns_secondario">
                            <option value="">--- Selezionare DNS ---</option>
                            <option value="8.8.8.8" {{isset($request['DNS_SECONDARIO']) && $request['DNS_SECONDARIO'] == "8.8.8.8" ? 'selected="selected"' : ""  }}>8.8.8.8</option>
                            <option value="8.8.4.4" {{isset($request['DNS_SECONDARIO']) && $request['DNS_SECONDARIO'] == "8.8.4.4" ? 'selected="selected"' : ""  }}>8.8.4.4</option>
                            <option value="151.99.125.1" {{isset($request['DNS_SECONDARIO']) && $request['DNS_SECONDARIO'] == "151.99.125.1" ? 'selected="selected"' : ""  }}>151.99.125.1</option>
                            <option value="151.99.0.100" {{isset($request['DNS_SECONDARIO']) && $request['DNS_SECONDARIO'] == "151.99.0.100" ? 'selected="selected"' : ""  }}>151.99.0.100</option>
                            <?php
                            $dnssecondario = ["8.8.8.8", "8.8.4.4", "151.99.125.1", "151.99.0.100"];
                            if(isset($request['DNS_SECONDARIO']) && !in_array($request['DNS_SECONDARIO'], $dnssecondario))
                                echo '<option value="'.$request['DNS_SECONDARIO'].'" selected="selected">'.$request['DNS_SECONDARIO'].'</option>';
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>NUMERO VERDE TECNICO</td>
                    <td>
                        <select name="numero_verde">
                            <option value="">--- Selezionare il Numero Verde ---</option>
                            <option value="800018914-1" {{isset($request['N_VERDE']) && $request['N_VERDE'] == "800018914-1" ? 'selected="selected"' : ""  }}>800018914-1 [ADSL e HDSL old]</option>
                            <option value="800191102-1" {{isset($request['N_VERDE']) && $request['N_VERDE'] == "800191102-1" ? 'selected="selected"' : ""  }}>800191102-1 [ADSL e HDSL new]</option>
                            <option value="800515494-3" {{isset($request['N_VERDE']) && $request['N_VERDE'] == "800515494-3" ? 'selected="selected"' : ""  }}>800515494-3 [SERVIZI PLUS / SINFONIA]</option>
                            <option value="800102120" {{isset($request['N_VERDE']) && $request['N_VERDE'] == "800102120" ? 'selected="selected"' : ""  }}>800102120 [SMART]</option>
                            <option value="0805084565" {{isset($request['N_VERDE']) && $request['N_VERDE'] == "0805084565" ? 'selected="selected"' : ""  }}>Portale NWS - Ass. - EasyIP [RADIUS]</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>SERVIZI PLUS / SINFONIA</td>
                    <td><input type="text" name="servizi_plus" value="{{$servizi_plus}}" style="background-color:{{$servizi_plus == "SI" ? "green" : "red" }}" class="servizi"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>VPI</td>
                    <td><input type="text" name="vpi" value="{{$request['VPI'] or "8"}}"></td>
                    <td>VCI</td>
                    <td><input type="text" name="vci" value="{{$request['VCI'] or "35"}}"></td>
                </tr>
                <tr>
                    <td>Installazione Modem</td>
                    <td>
                        <select name="installazione_modem">
                            <option value="">--- Selezionare Installazione ---</option>
                            <option value="x LAN" {{isset($request['INSTALLAZIONE_MODEM']) && $request['INSTALLAZIONE_MODEM'] == "x LAN" ? 'selected="selected"' : ""  }}>x LAN</option>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Incapsulamento</td>
                    <td>
                        <select name="incapsulamento">
                            <option value="">--- Selezionare Incapsulamento ---</option>
                            <option value="RFC 1483 Routed" {{isset($request['INCAPSULAMENTO']) && $request['INCAPSULAMENTO'] == "RFC 1483 Routed" ? 'selected="selected"' : ""  }}>RFC 1483 Routed</option>
                            <option value="RFC 2364 PPPoA" {{isset($request['INCAPSULAMENTO']) && $request['INCAPSULAMENTO'] == "RFC 2364 PPPoA" ? 'selected="selected"' : ""  }}>RFC 2364 PPPoA</option>
                            <option value="Frame relay" {{isset($request['INCAPSULAMENTO']) && $request['INCAPSULAMENTO'] == "Frame relay" ? 'selected="selected"' : ""  }}>Frame relay</option>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>DLCI</td>
                    <td><input type="text" name="dlci" value="{{$request['DLCI'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>LMI</td>
                    <td><input type="text" name="lmi_type" value="{{$request['LMI_TYPE'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or Input::get("manutenzione")}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDMPLS'] or ""}}">
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

            </form>
        </table>
        
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
        $request['SOGGETTO'] = trim($request['SOGGETTO']);
        $request['CLIENTE'] = trim($request['CLIENTE']);
        $request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
        ?>

        <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <tr>
                <td>
                    <a href="{{url('/gsu/apparati-networking/search')."?prodotto=Firewall&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">IP SAFE</a>
                </td>
                <td>
                    <a href="{{url('/gsu/apparati-networking/search')."?prodotto=Router&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ROUTER</a>
                </td>
                <td>
                    <a href="{{url('/gsu/apparati-networking/search')."?prodotto=Networking&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">NETWORKING</a>
                </td>
                <td>
                    <a href="{{url('/gsu/unigate/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">UNIGATE</a>
                </td>
                <td>
                    <a href="{{url('/gsu/ipstatici/search')."?prodotto=Firewall&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">IP STATICI</a>
                </td>
                <td>
                    <a href="{{url('/gsu/linea-aggiuntiva/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">LINEA AGGIUNTIVA</a>
                </td>
                <td>
                    <a href="{{url('/gsu/servizi-plus/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SERVIZI PLUS</a>
                </td>
            </tr>
        </table>


@endsection



@section('script')
    <script>
        $(document).ready(function () {
            @if($btn == 'back')
                $( ":text" ).prop('readonly', true);
                $( "select" ).prop('disabled', true);
            @endif

            $("#btn_salva").click(function(){
                         $.post( "{{url('/gsu/mpls/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });

        });
    </script>

@endsection