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
            <form method="GET" action="{{url('/gsu/domini/search')}}" name="form_search">
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
                    <div class="col-md-1">CANONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('canone')}}" id="canone" name="canone" ></div>
                    <div class="col-md-1">MANUTENZIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('manutenzione')}}" id="manutenzione" name="manutenzione" ></div>
                    <div class="col-md-2">DATA INIZIO CONTRATTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('data_contratto')}}" id="data_contratto" name="data_contratto" class="datepicker" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">DATA REGISTRAZIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('data_registrazione')}}" class="datepicker" id="data_registrazione" name="data_registrazione" ></div>
                    <div class="col-md-1">NOME DOMINIO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('nome_dominio')}}" id="nome_dominio" name="nome_dominio" ></div>
                    <div class="col-md-2">SCADENZA</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('scadenza')}}" class="datepicker" id="scadenza" name="scadenza" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">SCADENZA EFFETTIVA</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('scadenza_effettiva')}}" class="datepicker" id="scadenza_effettiva" name="scadenza_effettiva" ></div>
                    <div class="col-md-1">TIPO DOMINIO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tipo_dominio')}}" id="tipo_dominio" name="tipo_dominio" ></div>
                    <div class="col-md-2">NOVIRUSNOSPAM</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('novirusnospam')}}" id="novirusnospam" name="novirusnospam" ></div>
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

    <table id="main" class="table table-striped table-bordered display" cellspacing="0"  style="display:none; width:100%">
        <thead>
        <tr>
            <th>AZIONI</th>
            <th>STATO</th>
            <th>MANTUTENZIONE</th>
            <th>DATA INIZIO CONTRATTO</th>
            <th>CANONE</th>
            <th class="soggetto">CLIENTE</th>
            <th class="cliente">CLIENTE FINALE</th>
            <th class="destinatarioabituale">UBICAZIONE</th>
            <th>DATA REGISTRAZIONE</th>
            <th>NOME DOMINIO</th>
            <th>SCADENZA</th>
            <th>SCADENZA EFFETTIVA</th>
            <th>TIPO DOMINIO</th>
            <th>NOVIRUSNOSPAM</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr class="{{$class[$req['MANUTENZIONE']]['GSU']["ELIMINATO"]}}">
                <td>
                    <a class="stato_left btn-small edit" href="{{url('/gsu/domini/edit')."?id=".$req['IDDOMINIO']."&eliminati=".Input::get('eliminati')}}" title="EDIT"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a class="stato_right btn-small edit delete" href="javascript:void(0);" data-toggle="modal" title="DELETE" manutenzione="{{$req['MANUTENZIONE'] or ""}}" delete-id="{{$req['IDDOMINIO'] or ""}}"><i class="glyphicon glyphicon-trash"></i> </a>
                </td>
                <td>
                    <div class="stato_left {{$class[$req['MANUTENZIONE']]['GESTIONALE']['color']}}">{{$req['STATO']}}</div>
                    <div class="stato_right {{$class[$req['MANUTENZIONE']]['GSU']['color']}}">{{$class[$req['MANUTENZIONE']]['GSU']['text']}}</div>
                </td>
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDDOMINIO']."&eliminati=".Input::get('eliminati')}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['DATAR']}}</td>
                <td>{{$req['NOMEDOMINIO']}}</td>
                <td>{{$req['SCADENZA']}}</td>
                <td>{{$req['SCADENZAEFFETTIVA']}}</td>
                <td>{{$req['TIPODOMINIO']}}</td>
                <td>{{$req['NOVIRUSNOSPAM']}}</td>
            </tr>
        @endforeach
        </tbody>

        @if(Input::get('add') == 1)
            <tfoot>
            <tr>
                <th colspan="14"><a class="btn btn-small edit" href="{{url('/gsu/domini/edit')."?isnew=1&manutenzione=".$req['MANUTENZIONE']}}" title="ADD NEW"><i class="glyphicon glyphicon-plus"></i>&nbsp; ADD NEW </a></th>
            </tr>
            </tfoot>
        @endif
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
                $.get( "{{url('/gsu/domini/delete')}}", { id: id_elimina, manutenzione: manutenzione } )
                        .done(function( data ) {
                            $("#delete").modal('toggle');
                            $("#cerca").trigger("click");
                        });
            });

        });
    </script>
@endsection