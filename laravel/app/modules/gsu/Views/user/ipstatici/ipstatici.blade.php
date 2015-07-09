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
            <form method="GET" action="{{url('/gsu/ipstatici/search')}}" name="form_search">
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
                    <div class="col-md-1">TGU LINEA</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tgu_linea')}}" id="tgu_linea" name="tgu_linea" ></div>
                    <div class="col-md-1">NUMERO IP</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('numero_ip')}}" id="numero_ip" name="numero_ip" ></div>
                    <div class="col-md-2">TIPO ACCOUNT</div>
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
            <th>STATO</th>
            <th>MANTUTENZIONE</th>
            <th>DATA INIZIO CONTRATTO</th>
            <th>CANONE</th>
            <th class="soggetto">CLIENTE</th>
            <th class="cliente">CLIENTE FINALE</th>
            <th class="destinatarioabituale">UBICAZIONE</th>
            <th>TGU LINEA</th>
            <th>NUMERO IP</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr class="{{$class[$req['MANUTENZIONE']]['GSU']["ELIMINATO"]}}">
                <td>
                    <div class="stato_rivenditore {{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['color']}}" >{{$class[$req['MANUTENZIONE']]['GSU']['rivenditore']['text']}}</div>
                </td>
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDIPSTATICO']."&eliminati=".Input::get('eliminati')}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['TGU_LINEA']}}</td>
                <td>{{$req['NUM_IP']}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
