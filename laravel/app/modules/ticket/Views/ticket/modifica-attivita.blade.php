@extends('ticket::app')

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
    <div class="container-fluid">

        @foreach($result as $request)
            <form action="#" method="post" id="form">
                <br><br>
                <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                    <tr>
                        <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                    </tr>
                    <tr>
                        <td>ATTIVIT&Agrave;</td>
                        <td></td>
                        <td>TECNICO</td>
                        <td>
                            <select name="incaricoa_attivita">
                                @foreach($tecnici as $tecnico)
                                    <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($request['INCARICOA']) && $request['INCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>DURATA INTERVENTO MINUTI</td>
                        <td><input type="text" name="tempo" value="{{$request['TEMPO'] or ""}}" style="min-width:50px !important; width:50px;"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><textarea name="attivita" id="attivita" cols="130">{{$request['DESCRIZIONE'] or ""}}</textarea></td>
                    </tr>
                    <tr>
                        <td><input type="button" value="ELIMINA ATTIVIT&Agrave;" class="btn btn-primary btn-xs elimina-attivita"></td>
                        <td></td>
                        <td></td>
                        <td><input type="button" value="MODIFICA ATTIVIT&Agrave;" class="btn btn-primary btn-xs salva-attivita"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                    </tr>
                </table>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" class="id" value="{{$request['ID'] or ""}}">
                <input type="hidden" name="idattivita" class="idattivita" value="{{$request['IDATTIVITA'] or ""}}">
            </form>
        @endforeach
        <hr>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
            <tr>
                <td colspan="4"><input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs"></td>
            </tr>
        </table>


    </div>
    <div id="msg" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Record inserito con successo</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-modal" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div id="delete" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Eliminare il record selezionato ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-primary" id="btn_elimina">ELIMINA</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script>

        $(document).ready(function () {

            var idattivita = "";
            var id_singola_attivita = "";
            function h(e) {
                $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
            }
            $('textarea').each(function () {
                h(this);
            }).on('input', function () {
                h(this);
            });

            $(".elimina-attivita").click(function(){
                idattivita = $(this).closest('form').find(".idattivita").val();
                id_singola_attivita = $(this).closest('form').find(".id").val();
                $('#delete').modal('show');
            });

            $("#btn_elimina").click(function(){
                console.log(id_singola_attivita);
                $.get( "{{url('/ticket/eliminaattivita')}}", { id: id_singola_attivita } )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            location.reload();
                        });
            });

            $(".salva-attivita").click(function(){
                $.post( "{{url('/ticket/salvaattivita')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $('#msg').modal('show');
                            location.reload();
                        });
            });

        });
    </script>

@endsection