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
        <div class="col-md-2"><img src="{{ URL::asset('images/loader.gif')}}"></div>
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>AZIONI</th>
            <th>ID</th>
            <th>NOME</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td class="col-md-1">
                    <a class="stato_left btn-small edit" href="{{url('/gsu/amministrazioneunigate/edit')."?id=".$req['IDAPPARATO']."&eliminati=".Input::get('eliminati')}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="stato_right btn-small edit delete" href="javascript:void(0);" data-toggle="modal" title="DELETE"  delete-id="{{$req['IDAPPARATO'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                </td>
                <td class="col-md-2">{{$req['IDAPPARATO']}}</td>
                <td class="col-md-9">{{$req['APPARATO']}}</td>
            </tr>
        @endforeach
        </tbody>

            <tfoot>
            <tr>
                <th colspan="3"><a class="btn btn-small edit" href="{{url('/gsu/amministrazioneunigate/edit')."?isnew=1"}}" title="ADD NEW"><i class="glyphicon glyphicon-plus"></i>&nbsp; ADD NEW </a></th>
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
                $.get( "{{url('/gsu/amministrazioneunigate/delete')}}", { id: id_elimina } )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            location.reload();
                        });
            });

        });
    </script>
@endsection