@extends('gsu::app')

@section('css')


    <style>
        .row{
            margin:2px;
        }
        .btn{
            min-width: 80px;
        }

        .dataTables_filter{
            display:none !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="border">
            <form method="GET" action="{{url('/gsu/search')}}" name="form_search">
                <div class="row">
                    <div class="col-md-1 soggetto">CLIENTE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente')}}" id="cliente" class="search_anagrafica" name="cliente" ></div>
                    <div class="col-md-1 cliente">CLIENTE FINALE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente_finale')}}" id="cliente_finale" class="search_clienti" name="cliente_finale" ></div>
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
                    <div class="col-md-1">DESCRIZIONE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('descrizione')}}" id="descrizione" name="descrizione" ></div>
                    <div class="col-md-1">DESCRIZIONE 2</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('descrizione2')}}" id="descrizione2" name="descrizione2" ></div>

                    <div class="col-md-1"><input type="checkbox" <?php echo Input::get('daattivare') != 'on' ? '' :  "checked" ?> id="daattivare" name="daattivare">da attivare</div>
                    <div class="col-md-1"><input type="checkbox" <?php echo Input::get('attivati')!= 'on' ? '' :  "checked" ?> id="attivati" name="attivati">attivati</div>
                    <div class="col-md-1"><input type="checkbox" <?php echo Input::get('disattivati')!= 'on' ? '' :  "checked" ?> id="disattivati" name="disattivati">disattivati</div>
                    <div class="col-md-1"><input type="checkbox" <?php echo Input::get('dadisattivare')!= 'on' ? '' :  "checked" ?> id="dadisattivare" name="dadisattivare">da disattivare</div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><input type="submit" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                </div>
            </form>
        </div>
    </div>

    <br>

    <div class="row" id="loader">
        <img style="display:block;margin-left:auto;margin-right:auto;position: relative;top: 50%;transform: translateY(-50%);" src="{{ URL::asset('images/loader.gif')}}">
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
            <th>DESCRIZIONE</th>
            <th>DESCRIZIONE2</th>
            <th>QTAAFO70</th>
            <th>QTAGSU</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td>
                    <div class="stato_left {{$class[$req['MANUTENZIONE']]['GESTIONALE']['color']}}">{{$req['STATO']}}</div>
                    <div class="stato_right {{$class[$req['MANUTENZIONE']]['GSU']['color']}}">{{$class[$req['MANUTENZIONE']]['GSU']['text']}}</div>
                </td>
                <td><a href="{{url($class['link'][$req['MANUTENZIONE']])."?manutenzione=".$req['MANUTENZIONE']."&".$class[$req['MANUTENZIONE']]['GSU']['queryString']}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['DESCRCANONE']}}</td>
                <td>{{$req['DESCRCANONE2']}}</td>
                <td>{{$req['QTAAOF70']}}</td>
                <td>{{$req['QTAGSU']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection



