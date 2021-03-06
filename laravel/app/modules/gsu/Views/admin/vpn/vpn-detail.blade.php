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
                    <td>SEDE 1</td>
                    <td><input type="text" name="sede1" value="{{$request['SEDE1'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SEDE 2</td>
                    <td><input type="text" name="sede2" value="{{$request['SEDE2'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SEDE 3</td>
                    <td><input type="text" name="sede3" value="{{$request['SEDE3'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SEDE 4</td>
                    <td><input type="text" name="sede4" value="{{$request['SEDE4'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SEDE 5</td>
                    <td><input type="text" name="sede5" value="{{$request['SEDE5'] or ""}}"></td>
                </tr>
                 <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or Input::get("manutenzione")}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDVPN'] or ""}}">
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
                         $.post( "{{url('/gsu/vpn/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });
                    });

        });
    </script>

@endsection