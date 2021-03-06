@extends('app')


@section('content')
    <div class="container">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Portale UniWeb 4.1

                        @if (Session::get('livello')  == 1)
                            <a href="{{ url('/adduser') }}" style="float:right;">Crea nuovo utente</a>
                        @endif

                    </div>

                    <div class="panel-body">
                        @if (isset($message))
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Impossibile inviare la password all'indirizzo indicato.<br><br>
                                <ul>
                                    <li>{{ $errors }}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md4 col-md-offset-1">
                                    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>AZIONI</th>
                                            <th>DESCRIZIONE</th>
                                            <th>NOME UTENTE</th>
                                            <th>PASSWORD</th>
                                            <th>LIVELLO</th>
                                            <th>EMAIL</th>
                                            <th>INVIA MAIL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($utenti as $utente)
                                            <tr>
                                                <td>
                                                    <a class="btn btn-small edit" href="{{url('/edituser')."?id=".$utente['IDUTENTE']}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                                                    <a class="btn btn-small edit delete" href="#" data-toggle="modal" title="DELETE" data-manutenzione="" data-delete-id="{{$utente['IDUTENTE'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                                                </td>
                                                <td>{{$utente['DESCRIZIONE']}}</td>
                                                <td>{{$utente['UTENTE']}}</td>
                                                <td>{{$utente['PASSWORD']}}</td>
                                                <td>{{$utente['LIVELLO']}}</td>
                                                <td>{{$utente['EMAIL']}}</td>
                                                <td><a class="btn btn-small" href="{{url('/password/registrazione')."?id=".$utente['CODUTENTE']}}" title="Invia mail di conferma registrazione"><i class="glyphicon glyphicon-envelope"></i> </a></td>
                                            </tr>
                                            @endforeach
                                    </table>
                            </div>
                        </div>
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
    <script type="text/javascript">
        $(document).ready(function () {

            $("#btn_elimina").click(function(){
                $.get( "{{url('/deleteuser')}}", { id: id_elimina} )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            location.reload();
                        });
            });

        });
    </script>
@endsection