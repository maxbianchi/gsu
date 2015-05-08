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
    <div class="container-fluid">
        <div class="border">
            <form method="GET" action="{{url('/gsu/dial-up/search')}}" name="form_search">
                <div class="row">
                    <div class="col-md-1">CLIENTE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente')}}" id="cliente" name="cliente" placeholder="CLIENTE"></div>
                    <div class="col-md-1">CLIENTE FINALE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente_finale')}}" id="cliente_finale" name="cliente_finale" placeholder="CLIENTE FINALE"></div>
                    <div class="col-md-1">UBICAZIONE IMPIANTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('ubicazione')}}" id="ubicazione" name="ubicazione" placeholder="UBICAZIONE IMPIANTO"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">CANONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('canone')}}" id="canone" name="canone" placeholder="CANONE"></div>
                    <div class="col-md-1">MANUTENZIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('manutenzione')}}" id="manutenzione" name="manutenzione" placeholder="MANUTENZIONE"></div>
                    <div class="col-md-1">DATA INIZIO CONTRATTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('data_contratto')}}" id="data_contratto" name="data_contratto" class="datepicker" placeholder="DATA INIZIO CONTRATTO"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">CONNESSIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('connessione')}}" id="connessione" name="connessione" placeholder="CONNESSIONE"></div>
                    <div class="col-md-1">TIPO CONNESSIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tipo_connessione')}}" id="tipo_connessione" name="tipo_connessione" placeholder="TIPO CONNESSIONE"></div>
                    <div class="col-md-1">IP</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('ip')}}" id="ip" name="ip" placeholder="IP"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><input type="submit" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                    <div class="col-md-offset-7"><input type="button" value="REIMPOSTA" id="reimposta" name="reimposta" class="btn btn-default btn-xs"></div>

                </div>
            </form>
        </div>
    </div>

    <br>

    <div class="row" id="loader">
        <div class="col-md-2"><img src="{{ URL::asset('images/loader.gif')}}"></div>
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th class="col-sm-1">AZIONI</th>
            <th class="col-sm-1">MANTUTENZIONE</th>
            <th class="col-sm-1">DATA INIZIO CONTRATTO</th>
            <th class="col-sm-1">CANONE</th>
            <th class="col-sm-2">CLIENTE</th>
            <th class="col-sm-2">CLIENTE FINALE</th>
            <th class="col-sm-2">UBICAZIONE</th>
            <th class="col-sm-2">CONNESSIONE</th>
            <th class="col-sm-2">TIPO CONNESSIONE</th>
            <th class="col-sm-1">IP</th>
            <th class="col-sm-1">NOTE</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td>

                </td>
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDDIALUP']}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td>{{$req['SOGGETTO']}}</td>
                <td>{{$req['CLIENTE']}}</td>
                <td>{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['CONNESSIONE']}}</td>
                <td>{{$req['TIPO_CONNESSIONE']}}</td>
                <td>{{$req['IP']}}</td>
                <td>{{$req['NOTE']}}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <th class="col-sm-1">AZIONI</th>
            <th class="col-sm-1">MANTUTENZIONE</th>
            <th class="col-sm-1">DATA INIZIO CONTRATTO</th>
            <th class="col-sm-1">CANONE</th>
            <th class="col-sm-2">CLIENTE</th>
            <th class="col-sm-2">CLIENTE FINALE</th>
            <th class="col-sm-2">UBICAZIONE</th>
            <th class="col-sm-2">CONNESSIONE</th>
            <th class="col-sm-2">TIPO CONNESSIONE</th>
            <th class="col-sm-1">IP</th>
            <th class="col-sm-1">NOTE</th>
        </tr>
        </tfoot>


    </table>


@endsection



@section('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#main').dataTable({
                "iDisplayLength": 30,
                "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
                "aaSorting": [],
                "fnInitComplete": function(oSettings, json) {
                    $("#loader").hide();
                    $("#main").show();
                }
            });

            $("#reimposta").click(function(){
               $("input[type=text]").val("");
                $("input[type=checkbox]").attr("checked", false);
            });

            $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

        });
    </script>
@endsection