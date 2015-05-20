@extends('app')

@section('content')
    <div class="container">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{url('/riferimenti/addnew')}}">Crea nuovo</a>
                    <span class="pull-right autoimport"><a  href="javascript:void(0);">Importazione da AOF70</a></span>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md4 col-md-offset-1">
                                <form action="#" method="POST" id="form_utente" onsubmit="return false;">
                                    <fieldset>
                                        <legend>Riferimenti clienti</legend>
                                        <table id="main" class="table table-striped table-bordered display" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <td>
                                                    SOGGETTO
                                                </td>
                                                <td>
                                                    CLIENTE
                                                </td>
                                                <td>
                                                    UBICAZIONE
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riferimenti as $rif)
                                                    <tr>
                                                        <td>
                                                            {{$rif['SOGGETTO']}}
                                                        </td>
                                                        <td>
                                                            {{$rif['CLIENTE_FINALE']}}
                                                        </td>
                                                        <td>
                                                            {{$rif['UBICAZIONE_IMPIANTO']}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Autoimportazione Riferimenti</h4>
                </div>
                <div class="modal-body">
                    <h3><span class="msg"></span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".autoimport").click(function(){
                $.get( "{{url('/riferimenti/autoimport')}}")
                        .done(function( data ) {
                            $(".msg").html('Riferimenti importati: ' + data);
                            $("#resultModal").modal('show');
                        });
            });
        });
    </script>
@endsection