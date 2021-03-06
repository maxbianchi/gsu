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
                    <div class="col-md-1">NUMERO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('descrizione2')}}" id="descrizione2" name="descrizione2" ></div>

                    <div class="col-md-1" style="color:red;"><input type="checkbox" <?php echo Input::get('daattivare') != 'on' ? '' :  "checked" ?> id="daattivare" name="daattivare">da attivare</div>
                    <div class="col-md-1" style="color:red;"><input type="checkbox" <?php echo Input::get('attivati')!= 'on' ? '' :  "checked" ?> id="attivati" name="attivati">attivati</div>
                    <div class="col-md-1" style="color:red;"><input type="checkbox" <?php echo Input::get('disattivati')!= 'on' ? '' :  "checked" ?> id="disattivati" name="disattivati">disattivati</div>
                    <div class="col-md-1" style="color:red;"><input type="checkbox" <?php echo Input::get('dadisattivare')!= 'on' ? '' :  "checked" ?> id="dadisattivare" name="dadisattivare">da disattivare</div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">NR CONTRATTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('nrcontratto')}}" id="nrcontratto" name="nrcontratto" ></div>
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
        <img class="loader_img" src="{{ URL::asset('images/loader.gif')}}">
    </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>STATO</th>
            <th>COD. CONTRATTO</th>
            <th>DATA CONTRATTO</th>
            <th>COD. SERVIZIO</th>
            <th>ATTIV. SERVIZIO</th>
            <th>FINE SERVIZIO</th>
            <th>DISATT. SERVIZIO</th>
            <th>*CANONE</th>
            <th class="soggetto">CLIENTE</th>
            <th class="cliente">CLIENTE FINALE</th>
            <th class="destinatarioabituale">UBICAZIONE</th>
            <th>DESCRIZIONE</th>
            <th>NUMERO</th>
            <th>QTAAFO70</th>
            <th>QTAGSU</th>
            <th>VAL. UNITARIO</th>
            <th>SCONTO</th>
            <th>NETTO</th>
            <th>VAL. ACQUISTO</th>
        </tr>
        </thead>

        <tbody>
        @foreach($request as $req)
            <tr>
                <td>
                    <div class="stato_left {{$class[$req['MANUTENZIONE']]['GESTIONALE']['color']}}">{{$req['STATO']}}</div>
                    <div class="stato_right {{$class[$req['MANUTENZIONE']]['GSU']['color']}}">{{$class[$req['MANUTENZIONE']]['GSU']['text']}}</div>
                </td>
                <td><a href="#" data-numero-contratto="{{$req['NRCONTRATTO']}}" class="numero_contratto">{{$req['NRCONTRATTO']}}</a></td>
                <td>{{$req['DATAAPERTURA']}}</td>
                <td><a href="{{url($class['link'][$req['MANUTENZIONE']])."?manutenzione=".$req['MANUTENZIONE']."&".$class[$req['MANUTENZIONE']]['GSU']['queryString']}}">{{$req['MANUTENZIONE']}}</a></td>
                <td>{{$req['DATADOCUMENTO']}}</td>
                <td>{{$req['DATASCADENZA']}}</td>
                <td>{{$req['DATADISATTIVAZIONE']}}</td>
                <td>{{$req['CANONE']}}</td>
                <td class="soggetto">{{$req['SOGGETTO']}}</td>
                <td class="cliente">{{$req['CLIENTE']}}</td>
                <td class="destinatarioabituale">{{$req['DESTINATARIOABITUALE']}}</td>
                <td>{{$req['DESCRCANONE']}}</td>
                <td>{{$req['DESCRCANONE2']}}</td>
                <td>{{$req['QTAAOF70']}}</td>
                <td>{{$req['QTAGSU']}}</td>
                <td>{{$req['VALOREUNITARIO']}}</td>
                <td>{{$req['FORMULASCONTO']}}</td>
                <td>{{$req['TOTRIGANETTO']}}</td>
                <td>{{$req['VALOREACQUISTO']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <span class="exportBox"></span>
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {

            $('body').on('click', '.numero_contratto', function() {
                $("#nrcontratto").val($(this).attr("data-numero-contratto"));
                $("#cerca").trigger("click");
            });

        });
    </script>
@endsection


