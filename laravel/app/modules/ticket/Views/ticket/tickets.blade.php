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
    <a class="btn btn-small edit" href="{{url('/ticket/creaattivita')}}" title="AGGIUNGI NUOVA ATTIVITA&grave;"><i class="glyphicon glyphicon-plus"></i>&nbsp;AGGIUNGI NUOVA ATTIVITA&grave; </a>
    <br><br>

    <div class="container-fluid">
        <div class="border">
            <form method="GET" action="{{url('/ticket/tickets')}}" name="form_search">
                <div class="row">
                    <div class="col-md-1 soggetto">CLIENTE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('cliente')}}" id="cliente" class="search_anagrafica" name="cliente" ></div>
                    <div class="col-md-1 "></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2 "></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">IN CARICO A</div>
                    <div class="col-md-2"><select name="tecnico">
                            <option value="">TUTTI</option>
                            @foreach($tecnici as $tecnico)
                                <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Input::get('tecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-1">TICKET TELECOM</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tickettelecom')}}" id="tickettelecom" name="tickettelecom" ></div>
                    <div class="col-md-2">STATO</div>
                    <div class="col-md-2"><select name="stato">
                            @foreach($stati as $stato)
                                <option value="{{$stato['IDSTATO'] or ""}}" {{Input::get('stato') == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-1">TGU</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tgu')}}" id="tgu" name="tgu" ></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><input type="submit" value="CERCA" id="cerca" name="cerca" class="btn btn-primary btn-xs"></div>
                </div>
            </form>
        </div>
    </div>

    <br><br>
    <div class="container-fluid">
        <div id="accordion">
            <?php $idattivita = 0;

            ?>
            @foreach($result as $res)
                <?php if($idattivita == $res['IDATTIVITA']){
                        continue; }
                    $attivita = $result;
                    $idattivita = $res['IDATTIVITA'];
                    ?>
                <h3 style="<?php if($res['STATO'] == "CHIUSO") echo "color:red;text-decoration: line-through;" ?>">{{$res['SOGGETTO_NOME']." - ".$res['TITOLO']." - NR TICKET INTERNO ".$res['IDATTIVITA']." - TGU/IMEI ".$res['TGU']." - TICKET TELECOM ".$res['TICKETTELECOM']}}</h3>
                <div>
                    <form action="#" method="post" name="form_{{$res['IDATTIVITA']}}">
                    <div class="border">
                        <table class="tbl_clienti" style="width:100%">
                            <tbody>
                            <tr class="soggetto">
                                <td>CLIENTE</td>
                                <td>
                                    <select name="cliente">
                                        <option value="">-----</option>
                                        @foreach($users as $user)
                                            <option value="{{$user['SOGGETTO']}}" {{isset($res['SOGGETTO_CODICE']) && $res['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="destinatarioabituale">
                                <td>UBICAZIONE IMPIANTO</td>
                                <td>
                                    <select name="ubicazione_impianto">
                                        <option value="">-----</option>
                                        @foreach($users as $user)
                                            <option value="{{$user['SOGGETTO']}}" {{isset($res['DESTINATARIOABITUALE_CODICE']) && $res['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <br><br>
                          <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">

                            <tr>
                                <td>NR INTERNO TICKET </td>
                                <td class="manutenzione">{{$res['IDATTIVITA']}}</td>
                                <td>NR TICKET TELECOM</td>
                                <td><input type="text" name="tickettelecom" value="{{$res['TICKETTELECOM'] or ""}}"></td>
                            </tr>
                            <tr>
                                <td>ATTIVIT&Agrave; APERTA DA</td>
                                <td>
                                    <select name="apertoda">
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDAPERTODA']) && $res['IDAPERTODA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>ATTIVIT&Agrave; IN CARICO A</td>
                                <td>
                                    <select name="incaricoa">
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDINCARICOA']) && $res['IDINCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>EMAIL CLIENTE</td>
                                <td><input type="text" name="email" value="{{$res['EMAIL'] or ""}}"></td>
                                <td>ATTIVIT&Agrave; APERTA IL</td>
                                <td><input type="text" name="apertail" readonly="readonly" disabled="disabled"  value="{{$res['APERTAIL']." - ".$res['APERTAIL_ORA']}}"></td>
                            </tr>
                            <tr>
                                <td>TGU / IMEI</td>
                                <td><input type="text" name="tgu" value="{{$res['TGU'] or ""}}"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>TITOLO ATTIVIT&Agrave;</td>
                                <td><input type="text" name="titolo" value="{{$res['TITOLO'] or ""}}"></td>
                                <td>TEMPO TOTALE</td>
                                <td>
                                    <?php
                                        $tempo_totale = 0;
                                        foreach($attivita as $row):
                                            if($row['IDATTIVITA'] == $res['IDATTIVITA'])
                                                $tempo_totale += $row['TEMPO'];
                                        endforeach;
                                    ?>
                                    {{$tempo_totale." minuti"}}
                                </td>
                            </tr>
                            <tr>
                                <td>MOTIVO DELLA CHIAMATA</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><textarea name="motivo" cols="130">{{$res['MOTIVO'] or ""}}</textarea></td>
                            </tr>
                            <tr>
                                <td>ELENCO ATTIVIT&Agrave;</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><textarea name="elenco_attivita" cols="130"><?php foreach($attivita as $row): if($row['IDATTIVITA'] == $res['IDATTIVITA']) echo $row['INSERITOIL']." - ".$row['INCARICOA_ATTIVITA']." - ".trim($row['DESCRIZIONE']." - TEMPO: ".$row['TEMPO'])."&#10;"; endforeach; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>AGGIUNGI ATTIVIT&Agrave;</td>
                                <td></td>
                                <td>TECNICO</td>
                                <td>
                                    <select name="incaricoa_attivita">
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDTECNICO']) && $res['IDTECNICO'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><textarea name="attivita" id="attivita" cols="130"></textarea></td>
                            </tr>
                            <tr>
                                <td>DURATA INTERVENTO MINUTI</td>
                                <td><input type="text" name="tempo" value="{{$res['TEMPO'] or ""}}" style="min-width:50px !important; width:50px;"></td>
                                <td></td>
                                <td><input type="button" value="AGGIUNGI ATTIVIT&Agrave;" class="btn btn-primary btn-xs salva-attivita"></td>
                            </tr>
                            <tr>
                                <td>CAMBIA STATO</td>
                                <td>
                                    <select name="stato">
                                        @foreach($stati as $stato)
                                            <option value="{{$stato['IDSTATO'] or ""}}" {{isset($res['IDSTATO']) && $res['IDSTATO'] == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="button" value="SALVA TICKET" class="btn btn-primary btn-xs salva-ticket"></td>
                                <td><input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs"></td>
                            </tr>
                        </table>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idattivita" value="{{$idattivita or ""}}">
                </form>
                </div>
            @endforeach
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

@endsection



@section('script')
    <script>

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
                $.post( "{{url('/ticket/salvaattivita')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            location.reload();
                        });
            });

            $(".salva-ticket").click(function(){
                $.post( "{{url('/ticket/salvaticket')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $('#msg').modal('show');
                            $("#btn_salva").hide();
                        });
            });

            $( "#accordion" ).accordion({
                active: false,
                collapsible: true
            });
        });
    </script>

@endsection