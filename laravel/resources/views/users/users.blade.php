@extends('app')

@section('css')

    <link rel="stylesheet" href="{{ URL::asset('css/ui.jqgrid.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Portale UniWeb 4.0

                        @if (Session::get('livello')  == 1)
                            <a href="{{ url('/adduser') }}" style="float:right;">Crea nuovo utente</a>
                        @endif

                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md4 col-md-offset-1">
                                    <table id="list"></table>
                                    <div id="pager"></div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/jquery.jqGrid.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/i18n/grid.locale-en.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var grid = $("#list");
            var mydata = <?php echo $utenti ?>;
            grid.jqGrid({
                datatype: "local",
                data: mydata,
                colNames:['Descrizione','Nome Utente', 'Password', 'Livello'],
                colModel:[
                    {name:'DESCRIZIONE',index:'DESCRIZIONE', width:400},
                    {name:'UTENTE',index:'UTENTE', width:200},
                    {name:'PASSWORD',index:'PASSWORD', width:200},
                    {name:'LIVELLO',index:'LIVELLO', width:100, align:"right"}
                ],
                search:true,
                pager:'#pager',
                jsonReader: {cell:""},
                rowNum: 20,
                rowList: [5, 10, 20, 50],
                sortname: 'DESCRIZIONE',
                sortorder: 'asc',
                viewrecords: true,
                height: "100%",
                caption: "Utenti registrati a sistema"
            });
            grid.jqGrid('navGrid','#pager',{add:false,edit:false,del:false,search:true,refresh:true},
                    {},{},{},{multipleSearch:true, multipleGroup:true, showQuery: true});
        });
    </script>
@endsection