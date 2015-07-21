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
v            <th>STATO</th>
            <th>MANTUTENZIONE</th>
            <th>DATA INIZIO CONTRATTO</th>
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
                    <div class="stato_rivenditore {{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['color']}}" >{{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['text']}}</div>
                </td>
                <td><a href="{{url(isset($class['link'][$req['CANONE']]) ? '/gsu/hardware' : $class['link'][$req['CANONE']] )."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDSERVER']."&eliminati=".Input::get('eliminati')}}">{{$req['CODICE_R']}}</a></td>
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

    </table>
    <button style="margin:15px;" class="btn btn-success exportCSV">Export</button><span class="exportBox">Per esportare tutte le pagine selezionare "All" nel menu a tendina</span>
@endsection
