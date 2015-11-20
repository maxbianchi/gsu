@extends('ticket::app')

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
    <br><br>
    <a class="edit" style="padding-left:20px;" href="{{url('/ticket/creaattivita')}}" title="AGGIUNGI NUOVA ATTIVITA&grave;"><i class="glyphicon glyphicon-plus"></i></a><a class="edit" href="{{url('/ticket/creaattivita')}}" title="AGGIUNGI NUOVA ATTIVITA&grave;">&nbsp;AGGIUNGI NUOVA ATTIVITA&grave; </a>
    <br><br>

    <div class="container-fluid">
        <div class="border">
            <form method="GET" action="{{url('/ticket/alltickets')}}" name="form_search">
                <div class="row">
                    <div class="col-md-1 soggetto">CLIENTE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente')}}" id="cliente" class="search_anagrafica" name="cliente" ></div>
                    <div class="col-md-1 ">TITOLO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('titolo')}}" id="titolo" name="titolo" ></div>
                    <div class="col-md-2 ">CONFERMA ORDINE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('conferma_ordine')}}" id="conferma_ordine" name="conferma_ordine" ></div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">IN CARICO A</div>
                    <div class="col-md-2"><select name="tecnico">
                            <option value="">TUTTI</option>
                            @foreach($tecnici as $tecnico)
                                <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Input::get('tecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-1">TICKET FORNITORE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tickettelecom')}}" id="tickettelecom" name="tickettelecom" ></div>
                    <div class="col-md-2">STATO</div>
                    <div class="col-md-2"><select name="stato">
                            <option value="">TUTTI</option>
                            <option value="-1" {{Input::get('stato') == '-1' ? 'selected="selected"' : ""  }}>NON ASSEGNATO</option>
                            @foreach($stati as $stato)
                                <option value="{{$stato['IDSTATO'] or ""}}" {{Input::get('stato') == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">TGU</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tgu')}}" id="tgu" name="tgu" ></div>
                    <div class="col-md-1">TICKET INTERNO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('idattivita')}}" id="idattivita" name="idattivita" ></div>
                    <div class="col-md-2">CATEGORIA</div>
                    <div class="col-md-2">
                        <select name="categoria">
                            <option value="">TUTTE</option>
                            @foreach($categorie as $categoria)
                                <option value="{{$categoria['IDCATEGORIA'] or ""}}" {{Input::get('categoria') == $categoria['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$categoria['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">DA DATA INTERVENTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('data_intervento_da')}}" name="data_intervento_da" class="datepicker"></div>
                    <div class="col-md-1">A DATA INTERVENTO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('data_intervento_a')}}" name="data_intervento_a" class="datepicker"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><input type="submit" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                </div>
            </form>
        </div>
    </div>

     <div class="col-xs-4 col-md-2 hidden-xs" style="border:1px solid #E7E7E7; background-color: #F5F5F5;">
        <div class="well" style="width:100%; padding: 8px 0;">
            <div style="overflow-y: scroll; overflow-x: hidden; height: 100%;">
                <ul class="nav nav-list">
                    <li><label class="tree-toggler nav-header">Stato</label>
                        <ul class="nav nav-list tree">
                            <li><a href="{{url('/ticket/alltickets').'?stato=-1'}}">NON ASSEGNATI</a></li>
                        </ul>
                    </li>
                    <li><label class="tree-toggler nav-header">Tecnico</label>
                        <ul class="nav nav-list tree">
                            @foreach($tecnici as $tecnico)
                                <li><a href="{{url('/ticket/alltickets').'?tecnico='.$tecnico['IDTECNICO']}}">{{$tecnico['DESCRIZIONE']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li><label class="tree-toggler nav-header">Categoria</label>
                        <ul class="nav nav-list tree">
                            @foreach($categorie as $categoria)
                                <li><a href="{{url('/ticket/alltickets').'?categoria='.$categoria['IDCATEGORIA']}}">{{$categoria['DESCRIZIONE']}}</a></li>
                        @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-14 col-sm-6 col-md-10 col-lg-8">
        <div class="container-fluid">
            <div id="accordion">
                <?php $idattivita = 0;?>
                <table border="0" class="table table-striped table-bordered display" id="main" cellspacing="0" width="100%">
                    <thead>
                    <tr style="width:100%">
                        <td>CONFERMA ORDINE</td>
                        <td>CLIENTE</td>
                        <td>TITOLO</td>
                        <td>NR.TICKET INTERNO</td>
                        <td>TGU/IMEI</td>
                        <td>TICKET FORNITORE</td>
                        <td>IN CARICO A</td>
                        <td>STATO</td>
                        <td>DATA INTERVENTO</td>
                        <td>ELABORATO</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $res)
                        <?php if($idattivita == $res['IDATTIVITA']){
                            continue; }
                        $attivita = $result;
                        $idattivita = $res['IDATTIVITA'];
                        ?>

                        <tr style="<?php if($res['STATO'] == "CHIUSO") echo "color:red;text-decoration: line-through;"; elseif($res['STATO'] == "IN LAVORAZIONE UNIWEB") echo "color:green";elseif($res['STATO'] == "IN ATTESA CLIENTE") echo "color:orange"; ?>;cursor: pointer; cursor: hand;">
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['CONFERMA_ORDINE']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['SOGGETTO_NOME']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['TITOLO']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['IDATTIVITA']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['TGU']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['TICKETTELECOM']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['INCARICOA']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['STATO']}}</td>
                            <td class="clickable" data-idattivita="{{$res['IDATTIVITA']}}">{{$res['DATA_INTERVENTO']}}</td>
                            <td><?php if($res['STATO'] == "CHIUSO") echo "<input type='checkbox' class='elaborato' data-idattivita='$idattivita'"; ?></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <span class="exportBox"></span>
            </div>
        </div>
    </div>


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

    <div id="msg_elaborato" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Archiviare il record elaborato ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-primary elaborato-save">Conferma</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script>
        var idattivita="";
        $(document).ready(function () {

            function h(e) {
                $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
            }
            $('textarea').each(function () {
                h(this);
            }).on('input', function () {
                h(this);
            });


            $(".salva-attivita").click(function(){
                //Verifico che siano settati tempo e tecnico
                var msg = "";
                if($(this).closest('form').find(".incaricoa_attivita").val() == "")
                    msg = msg + " 'Tecnico'";
                if($(this).closest('form').find(".tempo").val() == "")
                    msg = msg + " 'Tempo'";
                if(msg != ""){
                    alert("Compilare i campi" + msg);
                    return false;
                }
                $.post( "{{url('/ticket/salvaattivita')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $('#msg').modal('show');
                            //location.reload();
                        });
            });

            $(".salva-ticket").click(function(){
                //Verifico che siano settati in caricoa,apertada,cliente e email
                var msg = "";
                if($(this).closest('form').find(".cliente_val").val() == "")
                    msg = msg + " 'Cliente'";
                if($(this).closest('form').find(".apertada").val() == "")
                    msg = msg + " 'Attività Aperta da'";
                if($(this).closest('form').find(".categoria").val() == "")
                    msg = msg + " 'Categoria'";
                if($(this).closest('form').find(".email").val() == "")
                    msg = msg + " 'Email'";
                if(msg != ""){
                    alert("Compilare i campi" + msg);
                    return false;
                }

                //Se chiuso faccio post del form non ajax
                var stato = $(this).closest('form').find(".stato").val();

                if(stato == 4){
                    msg = "";
                    if($(this).closest('form').find(".incaricoa").val() == "")
                        msg = msg + " 'Attività in carico a'";
                    if(msg != ""){
                        alert("Compilare i campi" + msg);
                        return false;
                    }
                }

                var form = $(this).closest('form');
                $.post("{{url('/ticket/salvaticket')}}", $(this).closest('form').serialize())
                        .done(function (data) {
                            $('#msg').modal('show');
                            $("#btn_salva").hide();
                            if(stato != 4) {
                                location.reload()
                            } else {
                                form.submit();
                            }
                        });
            });

            $('label.tree-toggler').click(function () {
                $(this).parent().children('ul.tree').toggle(300);
            });

            $( document ).delegate(".clickable","click",function(){
                var idattivita = $(this).data("idattivita");
                window.location.href='{{url('/ticket/tickets').'?idattivita='}}' + idattivita;
            });

            $( document ).delegate(".elaborato","click",function(){
                if($(this).is(':checked')) {
                    idattivita = $(this).data("idattivita");
                    $('#msg_elaborato').modal('show');
                }
            });

            $(".elaborato-save").click(function(){
                $.get("{{url('/ticket/elaborato')}}", {idattivita: idattivita})
                        .done(function (data) {
                            $('#msg_elaborato').modal('hide');
                        });
            });

        });


    </script>

@endsection