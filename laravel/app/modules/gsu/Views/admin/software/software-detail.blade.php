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
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{Input::get('manutenzione')}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDSOFTWARE'] or ""}}">
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
        if(!isset($request['IDSOFTWARE']))
            $request['IDSOFTWARE'] = "";
        if(!isset($request['MANUTENZIONE']))
            $request['MANUTENZIONE'] = "";
        $request['SOGGETTO'] = trim($request['SOGGETTO']);
        $request['CLIENTE'] = trim($request['CLIENTE']);
        $request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
        ?>

        <table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
            <tr>
                <td>
                    <a href="{{url('/gsu/software-pwd/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&apparato_id=".$request['IDSOFTWARE']."&manutenzione=".$request['MANUTENZIONE']}}">PASSWORD</a>
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
                                $.post( "{{url('/gsu/software/save')}}", $("form#form").serialize())
                                        .done(function( data ) {
                                            $('#msg').modal('show');
                                            $("#btn_salva").hide();
                                        });
                            });

                });
            </script>

@endsection