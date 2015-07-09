@extends('gsu::app')

@section('css')


    <style>
        table td{
            margin:2px;
            font-size: 10px;
        }
        .btn{
            min-width: 80px;
        }

        .dataTables_filter{
            display:block !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">

    <br>
    <input type="button" value="Visualizza Tutti" id="anagrafica_view" class="btn btn-default" onclick="window.location.href='{{url('/gsu/anagrafica')}}'">
    <br>

        <div class="row" id="loader">
            <img class="loader_img" src="{{ URL::asset('images/loader.gif')}}">
        </div>

    <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="display:none;">
        <thead>
        <tr>
            <th>CODICE</th>
            <th>DESCRIZIONE</th>
            <th>REFERENTE</th>
            <th>INDIRIZZO</th>
            <th>CAP</th>
            <th>LOCALITA</th>
            <th>PROVINCIA</th>
            <th>TELEFONO</th>
            <th>FAX</th>
            <th>EMAIL</th>
            <th>WEB</th>
            <th>PARTITA IVA</th>
            <th>CODICE FISCALE</th>
            <th>MAPPA</th>
        </tr>
        </thead>

        <tbody>
        @foreach($anagrafica as $row)
            <tr>
                <td>{{$row['SOGGETTO']}}</td>
                <td>{{$row['DESCRIZIONE']}}</td>
                <td>{{$row['CONTATTO']}}</td>
                <td>{{utf8_encode($row['INDIRIZZO'])}}</td>
                <td>{{$row['CAP']}}</td>
                <td>{{utf8_encode($row['LOCALITA'])}}</td>
                <td>{{$row['PROVINCIA']}}</td>
                <td>{{$row['TELEFONO']}}</td>
                <td>{{$row['Fax']}}</td>
                <td>{{$row['EMail']}}</td>
                <td>{{$row['WEB']}}</td>
                <td>{{$row['PARTITAIVA']}}</td>
                <td>{{$row['CODICEFISCALE']}}</td>
                <td><a target="_blank" href="http://maps.google.it/maps?q={{$row['INDIRIZZO']}}+{{$row['CAP']}}+{{$row['LOCALITA']}}+{{$row['PROVINCIA']}}+( {{$row['DESCRIZIONE']}} )&amp;hl=it&amp;z=16&amp;iwloc=A">Vai</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection


