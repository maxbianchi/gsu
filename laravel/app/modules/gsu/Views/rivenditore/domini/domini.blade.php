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
                    <div class="col-md-offset-8"><input type="button" value="REIMPOSTA" id="reimposta" name="reimposta" class="btn btn-default btn-xs"></div>

                </div>
            </form>
        </div>
    </div>

    <br>

    <div class="row" id="loader">
        <div class="col-md-2"><img src="{{ URL::asset('images/loader.gif')}}"></div>
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0"  style="display:none; width:100%">
        <thead>
        <tr>
            <th style="width:5%">MANTUTENZIONE</th>
            <th style="width:5%">DATA INIZIO CONTRATTO</th>
            <th style="width:5%">CANONE</th>
            <th style="width:20%" class="soggetto">CLIENTE</th>
            <th style="width:20%" class="cliente">CLIENTE FINALE</th>
            <th style="width:20%" class="destinatarioabituale">UBICAZIONE</th>
            <th style="width:5%">DATA REGISTRAZIONE</th>
            <th style="width:10%">NOME DOMINIO</th>
            <th style="width:5%">SCADENZA</th>
            <th style="width:5%">SCADENZA EFFETTIVA</th>
            <th style="width:6%">TIPO DOMINIO</th>
            <th style="width:2%">NOVIRUSNOSPAM</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td><a href="{{url($class['link'][$req['CANONE']])."/show?manutenzione=".$req['MANUTENZIONE']."&id=".$req['IDDOMINIO']}}">{{$req['MANUTENZIONE']}}</a></td>
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

    </table>
@endsection

