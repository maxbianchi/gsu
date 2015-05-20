@extends('app')


@section('content')
    <div class="container">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Portale UniWeb 4.0

                        @if (Session::get('livello')  == 1)
                            <a href="{{ url('/adduser') }}" style="float:right;">Crea nuovo utente</a>
                        @endif

                    </div>

                    <div class="panel-body">
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($utenti as $utente)
                                            <tr>
                                                <td>
                                                    <a class="btn btn-small edit" href="{{url('/edituser')."?id=".$utente['IDUTENTE']}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                                                    <a class="btn btn-small edit delete" href="javascript:void(0);" data-toggle="modal" title="DELETE"  delete-id="{{$utente['IDUTENTE'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                                                </td>
                                                <td>{{$utente['DESCRIZIONE']}}</td>
                                                <td>{{$utente['UTENTE']}}</td>
                                                <td>{{$utente['PASSWORD']}}</td>
                                                <td>{{$utente['LIVELLO']}}</td>
                                            </tr>
                                            @endforeach
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection

