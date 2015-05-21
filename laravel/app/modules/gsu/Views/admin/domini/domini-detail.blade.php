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
    @if(View::exists('gsu::varie.cliente-details'))
        @include('gsu::varie.cliente-details')
    @endif

    <br><br>
    <fieldset class="dettaglio_dati">
        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
            <form action="#" method="post" id="form">
                <tr>
                    <td>COD MANUTENZIONE </td>
                    <td class="manutenzione">{{$request['MANUTENZIONE'] or ""}}</td>
                </tr>
                <tr>
                    <td>TIPO DOMINIO</td>
                    <td>
                        <select name="tipo_dominio">
                            <option value="Normale" {{isset($request['TIPODOMINIO']) && $request['TIPODOMINIO'] == "Normale" ? 'selected="selected"' : ""  }}>Normale</option>
                            <option value="PEC"	{{isset($request['TIPODOMINIO']) && $request['TIPODOMINIO'] == "PEC" ? 'selected="selected"' : ""  }}>PEC</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>DATA REGISTRAZIONE</td>
                    <td><input type="text" name="data_registrazione" value="{{$request['DATAR'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>NOME DOMINIO</td>
                    <td><input type="text" name="nome_dominio" value="{{$request['NOMEDOMINIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SCADENZA</td>
                    <td><input type="text" name="scadenza" value="{{$request['SCADENZA'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>SCADENZA EFFETTIVA</td>
                    <td><input type="text" name="scadenza_effettiva" value="{{$request['SCADENZAEFFETTIVA'] or ""}}" class="datepicker"></td>
                </tr>
                <tr>
                    <td>NOVIRUSNOSPAM</td>
                    <td><input type="text" name="novirusnospam" value="{{$request['NOVIRUSNOSPAM'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDDOMINIO'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">
                        @if($btn == 'save')
                            <input type="button" value="SALVA" id="btn_salva" class="btn btn-primary btn-xs">
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-default btn-xs pull right">
                            <div class="pull-right"><input type="checkbox" name="eliminato" <?php echo Input::get('eliminati') != 'on' ? '' :  "checked" ?> >ELIMINATO</div>
                        @else
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">
                        @endif
                    </td>
                </tr>

            </form>
        </table>
        
    <hr>

    <div id="msg" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Record inserito con successo</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script>
        $(document).ready(function () {
            @if($btn == 'back')
                $( ":text" ).prop('readonly', true);
                $( "select" ).prop('disabled', true);
            @endif

             $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });

            $("#btn_salva").click(function(){
                         $.post( "{{url('/gsu/domini/save')}}", $("form#form").serialize())
                                .done(function( data ) {
                                    $('#msg').modal('show');
                                    $("#btn_salva").hide();
                                });

                    });

        });
    </script>

@endsection