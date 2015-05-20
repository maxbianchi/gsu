@extends('app')

@section('content')
    <div class="container">
        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Portale UniWeb 4.0</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md4 col-md-offset-1">
                                <form action="#" method="POST" id="form_utente" onsubmit="return false;">
                                    <fieldset>
                                        <legend>Crea nuovo riferimento</legend>
                                        <table class="adduser">
                                            <tr>
                                                <td>SOGGETTO</td>
                                                <td colspan="2">
                                                    <select id="soggetto">
                                                        @foreach ($utenti as $key => $utente)
                                                            @if($utente['DESCRIZIONE'] != "")
                                                                <option value="<?php echo $utente['SOGGETTO'] ?>"><?php echo utf8_encode($utente['DESCRIZIONE'].' , '.$utente['INDIRIZZO'].' , '.$utente['LOCALITA']).'  ('.$utente['PROVINCIA'].')'?></option>"
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CLIENTE</td>
                                                <td colspan="2">
                                                    <select id="cliente">
                                                        @foreach ($utenti as $key => $utente)
                                                            @if($utente['DESCRIZIONE'] != "")
                                                                <option value="<?php echo $utente['SOGGETTO'] ?>"><?php echo utf8_encode($utente['DESCRIZIONE'].' , '.$utente['INDIRIZZO'].' , '.$utente['LOCALITA']).'  ('.$utente['PROVINCIA'].')'?></option>"
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>UBICAZIONE</td>
                                                <td colspan="2">
                                                    <select id="ubicazione">
                                                        @foreach ($utenti as $key => $utente)
                                                            @if($utente['DESCRIZIONE'] != "")
                                                                <option value="<?php echo $utente['SOGGETTO'] ?>"><?php echo utf8_encode($utente['DESCRIZIONE'].' , '.$utente['INDIRIZZO'].' , '.$utente['LOCALITA']).'  ('.$utente['PROVINCIA'].')'?></option>"
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="submit" id="btn" value="SALVA"></td>
                                                <td><input type="button" id="back" value="Indietro" style="float:right;"></td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div class="modal fade" id="savedModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">User control panel</h4>
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
            $("#btn").click(function(){
                var soggetto = $("#soggetto").val();
                var cliente = $("#cliente").val();
                var ubicazione = $("#ubicazione").val();

                $_token = "{{ csrf_token() }}";
                $.post("{{ url('/riferimenti/savenew') }}", {soggetto: soggetto, cliente: cliente, ubicazione: ubicazione, _token: $_token})
                        .done(function (data) {
                            $(".msg").html(data);
                            $('#savedModal').modal({
                                show: 'true'
                            });
                        })
                        .fail(function() {
                            $(".msg").html("Si è verificato un errore durante il salvataggio");
                            $('#savedModal').modal({
                                show: 'true'
                            });
                        });
            });
            $("#back").click(function(){
               location.href='{{ url('/riferimenti') }}';
            });
        });
    </script>
@endsection