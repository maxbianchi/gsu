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
                    <td>APPARECCHIO</td>
                    <td>
                        <select name="apparecchio">
                            <option value="" {{!isset($request['APPARECCHIO']) || empty($request['APPARECCHIO'])  ? 'selected="selected"' : ""  }}>--- Selezionare il tipo di apparecchio ---</option>
                            @foreach($apparecchi as $row)
                                <option value="{{$row['APPARATO']}}" {{isset($request['APPARECCHIO']) && strtolower($request['APPARECCHIO']) == strtolower($row['APPARATO']) ? 'selected="selected"' : ""  }}>{{$row['APPARATO']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>SERIAL NUMBER</td>
                    <td><input type="text" name="sn" value="{{$request['SN'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>NUMERO TELEFONICO</td>
                    <td><input type="text" name="numerotelefonico" value="{{$request['NUMEROTELEFONICO'] or ""}}"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>IP PUBBLICO</td>
                    <td><input type="text" name="ip_statico_router" value="{{$request['IP_STATICO_ROUTER'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="rutsub" value="{{$request['RUTSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IP PRIVATO</td>
                    <td><input type="text" name="gateway_interfaccia_lan" value="{{$request['GATEWAY_INTERFACCIA_LAN'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="lansub" value="{{$request['LANSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>APPARECCHIO SUPPLEMENTARE</td>
                    <td><input type="text" name="apparecchiosupplementare" value="{{$request['APPARECCHIOSUPPLEMENTARE'] or ""}}"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>ADAPTER SERIAL NUMBER</td>
                    <td><input type="text" name="adaptersn" value="{{$request['ADAPTERSN'] or ""}}"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>IP PUBBLICO</td>
                    <td><input type="text" name="ip_statici" value="{{$request['IP_STATICI'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="ipsub" value="{{$request['IPSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IP PRIVATO</td>
                    <td><input type="text" name="gateway_wan_punto_a_punto" value="{{$request['GATEWAY_WAN_PUNTO_A_PUNTO'] or ""}}"></td>
                    <td>SUBNET MASK</td>
                    <td><input type="text" name="wansub" value="{{$request['WANSUB'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDUNIGATE'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">
                        @if($btn == 'save' && Input::get("eliminato") != 1)
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

    <div id="msg" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Record Inserito con successo</h4>
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
        if(!isset($request['IDUNIGATE']))
            $request['IDUNIGATE'] = "";
        if(!isset($request['MANUTENZIONE']))
            $request['MANUTENZIONE'] = "";
        ?>

        <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <td>
                <a href="{{url('/gsu/unigate-pwd/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&apparato_id=".$request['IDUNIGATE']."&id=".$request['IDUNIGATE']."&manutenzione=".$request['MANUTENZIONE']}}">PASSWORD</a>
            </td>
            <tr>
                <td>
                    <a href="{{url('/gsu/dial-up/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">DIAL UP ACCESS</a>
                </td>
                <td>
                    <a href="{{url('/gsu/adsl/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ADSL ACCESS</a>
                </td>
                <td>
                    <a href="{{url('/gsu/direct-access/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">DIRECT ACCESS</a>
                </td>
                <td>
                    <a href="{{url('/gsu/sim/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SIM VOCE</a>
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
                         $.post( "{{url('/gsu/unigate/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });

        });
    </script>

@endsection