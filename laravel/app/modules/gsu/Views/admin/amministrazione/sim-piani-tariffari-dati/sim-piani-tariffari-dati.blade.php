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
    <br>

    <div class="row" id="loader">

    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>AZIONI</th>
            <th>ID</th>
            <th>NOME PIANO</th>
            <th>DESCRIZIONE PIANO</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td class="col-md-1">
                    <a class="stato_left btn-small edit" href="{{url('/gsu/amministrazionesim-piani-tariffari-dati/edit')."?id=".$req['ID_PIANO']."&eliminati=".Input::get('eliminati')}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="stato_right btn-small edit delete" href="#" data-toggle="modal" title="DELETE" data-manutenzione="{{$req['MANUTENZIONE'] or ""}}" data-delete-id="{{$req['ID_PIANO'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                </td>
                <td class="col-md-2">{{utf8_encode($req['ID_PIANO'])}}</td>
                <td class="col-md-2">{{utf8_encode($req['NOME_PIANO'])}}</td>
                <td class="col-md-7">{{utf8_encode($req['DES_PIANO'])}}</td>
            </tr>
        @endforeach
        </tbody>

            <tfoot>
            <tr>
                <th colspan="4"><a class="btn btn-small edit" href="{{url('/gsu/amministrazionesim-piani-tariffari-dati/edit')."?isnew=1"}}" title="ADD NEW"><i class="glyphicon glyphicon-plus"></i>&nbsp; ADD NEW </a></th>
            </tr>
            </tfoot>

    </table>

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

    <script type="text/javascript">
        $(document).ready(function () {

            $("#btn_elimina").click(function(){
                $.get( "{{url('/gsu/amministrazionesim-piani-tariffari-dati/delete')}}", { id: id_elimina } )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            location.reload();
                        });
            });

        });
    </script>
@endsection