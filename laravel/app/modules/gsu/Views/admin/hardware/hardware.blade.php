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
            <form method="GET" action="{{url('/gsu/hardware/search')}}" name="form_search">
                <div class="row">
                    <div class="col-md-1 soggetto">CLIENTE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente')}}" id="cliente" class="search_anagrafica" name="cliente" ></div>
                    <div class="col-md-1 cliente">CLIENTE FINALE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente_finale')}}" id="cliente_finale" name="cliente_finale" ></div>
                    <div class="col-md-2 destinatarioabituale">UBICAZIONE IMPIANTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('ubicazione')}}" id="ubicazione" name="ubicazione" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">MARCA</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('marca')}}" id="marca" name="marca" ></div>
                    <div class="col-md-1">MODELLO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('modello')}}" id="modello" name="modello" ></div>
                    <div class="col-md-2">PART NUMBER</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('pn')}}" id="pn" name="pn" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">SERIAL NUMBER</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sn')}}" id="sn" name="sn" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><input type="submit" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                    <div class="col-md-1 col-md-offset-4"><input type="checkbox" <?php echo Input::get('eliminati') != 'on' ? '' :  "checked" ?> id="eliminati" name="eliminati">eliminati</div>
                </div>
            </form>
        </div>
    </div>

    <br>

    <div class="row" id="loader">
        <img class="loader_img" src="{{ URL::asset('images/loader.gif')}}">
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>AZIONI</th>
            <th>COD. SERVIZIO</th>
            <th>DATA CONTRATTO</th>
            <th>CANONE</th>
            <th class="soggetto">CLIENTE</th>
            <th class="cliente">CLIENTE FINALE</th>
            <th class="destinatarioabituale">UBICAZIONE</th>
            <th>MARCA</th>
            <th>MODELLO</th>
            <th>PART NUMBER</th>
            <th>SERIALE</th>
            <th>PIN</th>
            <th>ACQUISTO</th>
            <th>SCADENZA</th>
            <th>RINNOVO</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr class="{{$class[$req['MANUTENZIONE']]['GSU']["ELIMINATO"]}}">
                <td>
                    <a class="stato_left btn-small edit" href="{{url('/gsu/hardware/edit')."?id=".$req['IDSERVER']."&eliminati=".Input::get('eliminati')}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="stato_right btn-small edit delete" href="#" data-toggle="modal" title="DELETE" data-manutenzione="{{$req['MANUTENZIONE'] or ""}}" data-delete-id="{{$req['IDSERVER'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                </td>
                <td><a href="{{url(isset($class['link'][$req['CANONE']]) ? '/gsu/hardware' : $class['link'][$req['CANONE']] )."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDSERVER']."&eliminati=".Input::get('eliminati')}}">{{$req['CODICE_R']  or "AGGIUNTO"}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['MARCA']}}</td>
                <td>{{$req['MODELLO']}}</td>
                <td>{{$req['PN']}}</td>
                <td>{{$req['SN']}}</td>
                <td>{{$req['PIN']}}</td>
                <td>{{$req['DATAACQUISTO']}}</td>
                <td>{{$req['SCADGARANZIAINIZ']}}</td>
                <td>{{$req['RINNOVOGARANZIA']}}</td>
            </tr>
        @endforeach
        </tbody>

            <tfoot>
            <tr>
                <th colspan="15"><a class="btn btn-small edit" href="{{url('/gsu/hardware/edit')."?isnew=1&manutenzione=".(isset($req['MANUTENZIONE']) ? $req['MANUTENZIONE'] : "" )}}" title="ADD NEW"><i class="glyphicon glyphicon-plus"></i>&nbsp; ADD NEW </a></th>
            </tr>
            </tfoot>
    </table>
    <span class="exportBox"></span>
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
                $.get( "{{url('/gsu/hardware/delete')}}", { id: id_elimina, manutenzione: manutenzione } )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            $("#cerca").trigger("click");
                        });
            });

        });
    </script>
@endsection