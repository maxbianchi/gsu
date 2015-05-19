@extends('app')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/ui.jqgrid.css') }}" />
@endsection

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
                                            <th>DESCRIZIONE</th>
                                            <th>NOME UTENTE</th>
                                            <th>PASSWORD</th>
                                            <th>LIVELLO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($utenti as $utente)
                                            <tr>
                                                <td>{{$utente['DESCRIZIONE']}}</td>
                                                <td>{{$utente['UTENTE']}}</td>
                                                <td>{{$utente['PASSWORD']}}</td>
                                                <td>{{$utente['LIVELLO']}}</td>
                                            </tr>
                                            @endforeach;
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/jquery.jqGrid.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/i18n/grid.locale-en.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#main').dataTable({
                "iDisplayLength": 30,
                "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
                "aaSorting": [],
                "fnInitComplete": function(oSettings, json) {
                    $("#main").show();
                }
            });
        });
    </script>
@endsection