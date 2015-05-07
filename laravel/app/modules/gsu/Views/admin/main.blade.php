@extends('app')

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
            <div class="row">
                <div class="col-md-1">CLIENTE</div>
                <div class="col-md-2"><input type="text" value="" id="cliente" name="cliente"></div>
                <div class="col-md-1">CLIENTE FINALE</div>
                <div class="col-md-2"><input type="text" value="" id="cliente_finale" name="cliente_finale"></div>
                <div class="col-md-1">UBICAZIONE IMPIANTO</div>
                <div class="col-md-2"><input type="text" value="" id="ubicazione" name="ubicazione"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-1">CANONE</div>
                <div class="col-md-2"><input type="text" value="" id="canone" name="canone"></div>
                <div class="col-md-1">MANUTENZIONE</div>
                <div class="col-md-2"><input type="text" value="" id="manutenzione" name="manutenzione"></div>
                <div class="col-md-1">DATA INIZIO CONTRATTO</div>
                <div class="col-md-2"><input type="text" value="" id="data_contratto" name="data_contratto"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-1">DESCRIZIONE</div>
                <div class="col-md-2"><input type="text" value="" id="descrizione" name="descrizione"></div>
                <div class="col-md-1">DESCRIZIONE 2</div>
                <div class="col-md-2"><input type="text" value="" id="descrizione2" name="descrizione2"></div>
                <div class="col-md-1"></div>
                <div class="col-md-2"></div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-2"><input type="button" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                <div class="col-md-2"><input type="button" value="REIMPOSTA" id="reimposta" name="reimposta" class="btn btn-default btn-xs"></div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>


    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
        </tfoot>

        <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        </tbody>
    </table>


@endsection



@section('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').dataTable();
        });
    </script>
@endsection