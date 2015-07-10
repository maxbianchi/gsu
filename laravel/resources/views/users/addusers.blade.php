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
                                        <legend>Crea nuovo utente</legend>
                                        <table class="adduser">
                                            <tr>
                                                <td colspan="2">
                                                    <select id="codutente" name="codutente">
                                                        @foreach ($utenti as $key => $utente)
                                                            @if($utente['DESCRIZIONE'] != "")
                                                                <option value="<?php echo $utente['SOGGETTO'] ?>" {{isset($request['CODUTENTE']) && $request['CODUTENTE'] == $utente['SOGGETTO'] ? 'selected="selected"' : ""  }}><?php echo utf8_encode($utente['DESCRIZIONE'].' , '.$utente['INDIRIZZO'].' , '.$utente['LOCALITA']).'  ('.$utente['PROVINCIA'].') - '.$utente['SOGGETTO']?></option>"
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nome Utente</td>
                                                <td><input type="text" id="username" name="username" value="{{$request['UTENTE'] or ""}}" required="required"></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td><input type="text" id="password" name="password" value="{{$request['PASSWORD'] or ""}}" required="required"></td>
                                            </tr>
                                            <tr>
                                                <td>Livello</td>
                                                <td>
                                                    <select id="livello">
                                                        <option value="3" {{isset($request['LIVELLO']) && $request['LIVELLO'] == 3 ? 'selected="selected"' : ""  }}>Utente</option>
                                                        <option value="2" {{isset($request['LIVELLO']) && $request['LIVELLO'] == 2 ? 'selected="selected"' : ""  }}>Rivenditore</option>
                                                        <option value="1" {{isset($request['LIVELLO']) && $request['LIVELLO'] == 1 ? 'selected="selected"' : ""  }}>Amministratore</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" id="id" name="id" value="{{Input::get("id")}}">
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
                var sUsername = $("#username").val();
                var sPassword = $("#password").val();
                var sLivello = $("#livello").val();
                var sCodutente = $("#codutente").val();
                var id = $("#id").val();
                $_token = "{{ csrf_token() }}";
                $.post("{{ url('/createuser') }}", {username: sUsername, password: sPassword, livello: sLivello, codutente: sCodutente, id: id,  _token: $_token})
                        .done(function (json) {
                            var parsed = JSON.parse(json);
                            $(".msg").html(parsed.msg);
                            $('#savedModal').modal({
                                show: 'true'
                            });
                        });
            });
            $("#back").click(function(){
               location.href='{{ url('/users') }}';
            });
        });
    </script>
@endsection