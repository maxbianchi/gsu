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


    <br><br>
    <fieldset class="dettaglio_dati">
        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
            <form action="#" method="post" id="form">

                <tr>
                    <td>LINEA UNIWEB</td>
                    <td><input type="text" name="linea_uniweb" value="{{$request['LINEA_UNIWEB'] or ""}}"></td>
                </tr>
                <tr>
                    <td>LINEA FORNITORE</td>
                    <td><input type="text" name="linea_fornitore" value="{{$request['LINEA_FORNITORE'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDLINEA'] or ""}}">
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

@endsection



@section('script')
    <script>
        $(document).ready(function () {
            @if($btn == 'back')
                $( ":text" ).prop('readonly', true);
                $( "select" ).prop('disabled', true);
            @endif

            $("#btn_salva").click(function(){
                         $.post( "{{url('/gsu/amministrazionetipo-linea/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });

                    });

        });
    </script>

@endsection