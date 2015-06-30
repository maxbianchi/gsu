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
            <form method="GET" action="{{url('/gsu/vpn/search')}}" name="form_search">
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
                    <div class="col-md-1">SEDE 1</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sede1')}}" id="sede1" name="sede1" ></div>
                    <div class="col-md-1">SEDE 2</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sede2')}}" id="sede2" name="sede2" ></div>
                    <div class="col-md-2">SEDE 3</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sede3')}}" id="sede3" name="sede3"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">SEDE 4</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sede4')}}" id="sede4" name="sede4" ></div>
                    <div class="col-md-1">SEDE 5</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('sede5')}}" id="sede5" name="sede5" ></div>
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
        <div class="col-md-2"><img src="{{ URL::asset('images/loader.gif')}}"></div>
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>MANTUTENZIONE</th>
            <th>STATO</th>
            <th>DATA INIZIO CONTRATTO</th>
            <th>CANONE</th>
            <th class="soggetto">CLIENTE</th>
            <th class="cliente">CLIENTE FINALE</th>
            <th class="destinatarioabituale">UBICAZIONE</th>
            <th>SEDE 1</th>
            <th>SEDE 2</th>
            <th>SEDE 3</th>
            <th>SEDE 4</th>
            <th>SEDE 5</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr class="{{$class[$req['MANUTENZIONE']]['GSU']["ELIMINATO"]}}">
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDVPN']."&eliminati=".Input::get('eliminati')}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>
                    <div class="stato_rivenditore {{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['color']}}" >{{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['text']}}</div>
                </td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['SEDE1']}}</td>
                <td>{{$req['SEDE2']}}</td>
                <td>{{$req['SEDE3']}}</td>
                <td>{{$req['SEDE4']}}</td>
                <td>{{$req['SEDE5']}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection
