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
            <form method="GET" action="{{url('/gsu/url-filtering/search')}}" name="form_search">
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
                    <div class="col-md-1">MAC ADDRESS</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('mac_address')}}" id="mac_address" name="mac_address" ></div>
                    <div class="col-md-1">MODELLO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('modello')}}" id="modello" name="modello" ></div>
                    <div class="col-md-2">SN</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sn')}}" id="ip" name="sn" ></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">ACTIVATION KEY</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('activation_key')}}" id="activation_key" name="activation_key" ></div>
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
        <div class="col-md-2"><img src="{{ URL::asset('images/loader.gif')}}"></div>
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th class="col-sm-1">STATO</th>
            <th class="col-sm-1">MANTUTENZIONE</th>
            <th class="col-sm-1">DATA INIZIO CONTRATTO</th>
            <th class="col-sm-1">CANONE</th>
            <th class="col-sm-2 soggetto">CLIENTE</th>
            <th class="col-sm-2 cliente">CLIENTE FINALE</th>
            <th class="col-sm-2 destinatarioabituale">UBICAZIONE</th>
            <th class="col-sm-2">MAC ADDRESS</th>
            <th class="col-sm-2">MODELLO</th>
            <th class="col-sm-1">SERIALE</th>
            <th class="col-sm-1">ACTIVATION KEY</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr class="{{$class[$req['MANUTENZIONE']]['GSU']["ELIMINATO"]}}">
                <td>
                    <div class="stato_left {{$class[$req['MANUTENZIONE']]['GESTIONALE']['color']}}">{{$req['STATO']}}</div>
                    <div class="stato_right {{$class[$req['MANUTENZIONE']]['GSU']['color']}}">{{$class[$req['MANUTENZIONE']]['GSU']['text']}}</div>
                </td>
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDURLFILTERING']."&eliminati=".Input::get('eliminati')}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['MAC_ADDRESS']}}</td>
                <td>{{$req['MODELLO']}}</td>
                <td>{{$req['SN']}}</td>
                <td>{{$req['ACTIVATION_KEY']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
