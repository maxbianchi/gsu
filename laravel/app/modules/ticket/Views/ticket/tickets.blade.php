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
    <a style="padding-left:20px;" class="edit" href="{{url('/ticket/creaattivita')}}" title="AGGIUNGI NUOVA ATTIVITA&grave;"><i class="glyphicon glyphicon-plus"></i></a><a class="edit" href="{{url('/ticket/creaattivita')}}" title="AGGIUNGI NUOVA ATTIVITA&grave;">&nbsp;AGGIUNGI NUOVA ATTIVITA&grave; </a>
    <br><br>

    <div class="container-fluid">

        <div class="border">
            <form method="GET" action="{{url('/ticket/alltickets')}}" id="form" name="form_search">
                <div class="row">
                    <div class="col-md-1 soggetto">CLIENTE</div>
                    <div class="col-md-2"><input type="text"value="{{Input::get('cliente')}}" class="search_anagrafica locked" name="cliente" ></div>
                    <div class="col-md-1 ">TITOLO</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('titolo')}}" id="titolo" name="titolo"></div>
                    <div class="col-md-2 ">CONFERMA ORDINE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('conferma_ordine')}}" id="conferma_ordine" name="conferma_ordine" ></div>
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
                    <div class="col-md-1">TICKET FORNITORE</div>
                    <div class="col-md-2"><input type="text" value="{{Input::get('tickettelecom')}}" id="tickettelecom" name="tickettelecom" ></div>
                    <div class="col-md-2">STATO</div>
                    <div class="col-md-2"><select name="stato">
                            <option value="">TUTTI</option>
                            <option value="-1" {{Input::get('stato') == '-1' ? 'selected="selected"' : ""  }}>NON ASSEGNATO</option>
                            <option value="-2" {{Input::get('stato') == '-2' ? 'selected="selected"' : ""  }}>ARCHIVIATO</option>
                            @foreach($stati as $stato)
                                <option value="{{$stato['IDSTATO'] or ""}}" {{Input::get('stato') == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-3"></div>
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
                    <div class="col-md-3"></div>
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

    <div class="cols-xs-4 col-md-2 hidden-xs" style="border: 1px solid #E7E7E7; background-color: #F5F5F5">
        <div class="well" style="width:100%; padding: 8px 0;">
            <div style="overflow: scroll; overflow-x: hidden; height: 100%;">
                <ul class="nav nav-list">
                    <li><label class="tree-toggler nav-header">Stato</label>
                        <ul class="nav nav-list tree">
                            <li><a href="{{url('/ticket/alltickets').'?stato=0'}}">IN GESTIONE</a></li>
                            <li><a href="{{url('/ticket/alltickets').'?stato=-2'}}">ARCHIVIATI</a></li>
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
            <?php $idattivita = 0;?>
            @foreach($result as $res)
                <?php if($idattivita == $res['IDATTIVITA']){
                    continue; }
                $attivita = $result;
                $idattivita = $res['IDATTIVITA'];
                ?>
                <div style="<?php if($res['STATO'] == "CHIUSO") echo "color:red;text-decoration: line-through;"; elseif($res['STATO'] == "IN LAVORAZIONE UNIWEB") echo "color:green";elseif($res['STATO'] == "IN ATTESA CLIENTE") echo "color:orange"; ?>">{{$res['CONFERMA_ORDINE']." - ".$res['SOGGETTO_NOME']." - ".$res['TITOLO']." - NR TICKET INTERNO ".$res['IDATTIVITA']." - TGU/IMEI ".$res['TGU']." - TICKET FORNITORE ".$res['TICKETTELECOM']}}</div>

                    <form action="{{url('/ticket/chiuditicket')}}" method="post" id="form_ticket"  name="form_{{$res['IDATTIVITA']}}">
                        <div class="border">
                            <table class="tbl_clienti" style="width:100%">
                                <tbody>
                                <tr class="soggetto">
                                    <td>CLIENTE *</td>
                                    <td>
                                        <input type="text" value="" name="search_cliente" id="search_cliente" class="locked">
                                        <select name="cliente" id="cliente" class="locked">
                                            <option value="">-----</option>
                                            @foreach($users as $user)
                                                <option value="{{$user['SOGGETTO']}}" {{isset($res['SOGGETTO_CODICE']) && $res['SOGGETTO_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr class="cliente">
                                    <td>CLIENTE FINALE</td>
                                    <td>
                                        <input type="text" value="" name="search_cliente_finale" id="search_cliente_finale" class="locked">
                                        <select name="cliente_finale" id="cliente_finale" class="locked">
                                            <option value="">-----</option>
                                            @foreach($users as $user)
                                                <option value="{{$user['SOGGETTO']}}" {{isset($res['CLIENTE_FINALE_CODICE']) && $res['CLIENTE_FINALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr class="destinatarioabituale">
                                    <td>UBICAZIONE IMPIANTO</td>
                                    <td>
                                        <input type="text" value="" name="search_ubicazione" id="search_ubicazione" class="locked">
                                        <select name="ubicazione_impianto" id="ubicazione_impianto" class="locked">
                                            <option value="">-----</option>
                                            @foreach($users as $user)
                                                <option value="{{$user['SOGGETTO']}}" {{isset($res['DESTINATARIOABITUALE_CODICE']) && $res['DESTINATARIOABITUALE_CODICE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr class="sedeoperativa">
                                    <td>SEDE OPERATIVA</td>
                                    <td>
                                        <input type="text" value="" name="search_sedeoperativa" id="search_sedeoperativa" class="locked">
                                        <select name="sedeoperativa" id="sedeoperativa" class="locked">
                                            <option value="">-----</option>
                                            @foreach($sedioperative as $sede)
                                                <option value="{{$sede['CustSupp']}}" {{isset($res['SEDE_OPERATIVA']) && $res['SEDE_OPERATIVA'] == $sede['CustSupp'] ? 'selected="selected"' : ""  }}>{{$sede['CompanyName']." - ".$sede['Address']." - ".$sede['City']." - ".$sede['County']." - ".$sede['CustSupp']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>


                        <!-- TABS -->

                        <ul class="nav nav-tabs" id="mioTab">
                            <li class="active"><a href="#home" data-toggle="tab">Ticket</a></li>
                            <li><a href="#uno" data-toggle="tab">Cliente</a></li>
                            <li><a href="#due" data-toggle="tab">Fornitore</a></li>
                            <li><a href="#tre" data-toggle="tab">Servizio</a></li>
                        </ul>


                        <div class="tab-content">
                            <div class="tab-pane active" id="home"><h1>Ticket</h1>
                                <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Verbalino Intervento</td>
                                        <td><?php if(file_exists("/var/www/gsu/laravel/public/output/".$res['IDATTIVITA'].".pdf")): ?>
                                            <a href="/output/{{$res['IDATTIVITA']}}.pdf" download title="Verbalino" alt="Verbalino"><img src="{{ URL::asset('images/pdf_icon.png') }}"></a>
                                            <?php
                                            endif;
                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NR INTERNO TICKET </td>
                                        <td class="manutenzione"><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled"  value="{{$res['IDATTIVITA']}}"></td>
                                        <td>ATTIVIT&Agrave; APERTA IL</td>
                                        <td><input type="text" style="background-color: #eee;" name="apertail" readonly="readonly" disabled="disabled" value="{{$res['APERTAIL']." - ".$res['APERTAIL_ORA']}}"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>ATTIVIT&Agrave; CHIUSA IL</td>
                                        <td><input type="text" style="background-color: #FFC;" name="chiusail" readonly="readonly" disabled="disabled"  value="{{$res['CHIUSAIL']." - ".$res['CHIUSAIL_ORA']}}"></td>
                                    </tr>
                                    <tr>
                                        <td>ATTIVIT&Agrave; APERTA DA</td>
                                        <td>
                                            <select name="apertoda" class="apertoda" style="background-color: #FFC;">
                                                <option value="">-----</option>
                                                @foreach($tecnici as $tecnico)
                                                    <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDAPERTODA']) && $res['IDAPERTODA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>ATTIVIT&Agrave; IN CARICO A</td>
                                        <td>
                                            <select name="incaricoa" class="incaricoa" style="background-color: #FFC;">
                                                <option value="">-----</option>
                                                @foreach($tecnici as $tecnico)
                                                    <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDINCARICOA']) && $res['IDINCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CATEGORIA *</td>
                                        <td>
                                            <select name="categoria" id="categoria" class="categoria" style="background-color: #FFC;">
                                                @foreach($categorie as $categoria)
                                                    <option value="{{$categoria['IDCATEGORIA'] or ""}}" {{isset($res['IDCATEGORIA']) && $res['IDCATEGORIA'] == $categoria['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$categoria['DESCRIZIONE'] or ""}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>TIPOLOGIA ASSISTENZA</td>
                                        <td><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled" name="tipologia_assistenza" id="tipologia_assistenza" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Tipologia</td>
                                        <td><select style="background-color: #FFC;" name="ingaranzia">
                                                <option value="0" <?php echo isset($res['IN_GARANZIA']) && $res['IN_GARANZIA'] == 0 ? 'selected="selected"' : ""  ?>>A CONTRATTO</option>
                                                <option value="1" <?php echo isset($res['IN_GARANZIA']) && $res['IN_GARANZIA'] == 1 ? 'selected="selected"' : ""  ?>>A CONSUNTIVO</option>
                                            </select></td>
                                        <td>CARNET DISPONIBILI NR.</td>
                                        <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="carnet_disponibili" id="carnet_disponibili" value="">&nbsp;&nbsp;<input type="button" value="Ordina Carnet" class="btn btn-primary btn-xs btn_carnet"></td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>TICKET DISPONIBILI VAL. €</td>
                                        <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="ticket_disponibili" id="ticket_disponibili" value="">&nbsp;&nbsp;<input type="button" value="Ricarica Ticket" class="btn btn-primary btn-xs btn_ticket"></td>
                                    </tr>
                                    <tr>
                                        <td>TITOLO ATTIVIT&Agrave;</td>
                                        <td><input type="text" style="background-color: #FFC;" name="titolo" value="{{$res['TITOLO'] or ""}}"></td>
                                        <td>TEMPO TOTALE min.</td>
                                        <td>
                                            <?php
                                            $tempo_totale = 0;
                                            foreach($attivita as $row):
                                                if($row['IDATTIVITA'] == $res['IDATTIVITA'])
                                                    $tempo_totale += $row['TEMPO'];
                                            endforeach;
                                            ?>
                                            <input type="text" style="background-color: #FFC;" name="tempo_totale" value="{{$tempo_totale}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MOTIVO DELLA CHIAMATA</td>
                                        <td colspan="3"><textarea style="background-color: #FFC;" name="motivo" class="noEnter" cols="130">{{$res['MOTIVO'] or ""}}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>DETTAGLIO ATTIVIT&Agrave;<?php if ($res['ELABORATO'] != 1): ?><a href="{{url('/ticket/modificaattivita?idattivita='.$res['IDATTIVITA'])}}" title="Modifica attività" style="float:right;"><i class="glyphicon glyphicon-pencil"></i></a><?php endif; ?></td>
                                        <td colspan="3"><textarea style="background-color: #eee;" name="elenco_attivita" cols="130" readonly="readonly"><?php foreach($attivita as $row): if($row['IDATTIVITA'] == $res['IDATTIVITA']) echo $row['INSERITOIL']." - ".$row['INSERITOIL_ORA']." - ".$row['INCARICOA_ATTIVITA']." - ".trim($row['DESCRIZIONE']." - TEMPO: ".$row['TEMPO'])."&#10;------------------------&#10;"; endforeach; ?></textarea></td>
                                    </tr>
                                    <tr><?php if ($res['ELABORATO'] != 1): ?>
                                        <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                                    </tr>
                                    <tr>
                                        <td>AGGIUNGI ATTIVIT&Agrave;</td>
                                        <td></td>
                                        <td>TECNICO</td>
                                        <td>
                                            <select name="incaricoa_attivita" class="incaricoa_attivita" style="background-color: #FFC;">
                                                <option value="">-----</option>
                                                @foreach($tecnici as $tecnico)
                                                    <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Session::has('idtecnico') && Session::get('idtecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>DURATA INTERVENTO MINUTI</td>
                                        <td><input type="text" name="tempo" class="tempo" value="{{$res['TEMPO'] or "0"}}" style="min-width:50px !important; width:50px;background-color: #FFC;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><textarea name="attivita" id="attivita" cols="130"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="button" value="AGGIUNGI ATTIVIT&Agrave;" class="btn btn-primary btn-xs salva-attivita"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="uno"><h1>Cliente</h1>
                                <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                                    <tr>
                                        <td>NR INTERNO TICKET </td>
                                        <td class="manutenzione"><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled"  value="{{$res['IDATTIVITA']}}"></td>
                                        <td>ATTIVIT&Agrave; APERTA IL</td>
                                        <td><input type="text" style="background-color: #FFC;" name="apertail" readonly="readonly" disabled="disabled" value="{{$res['APERTAIL']." - ".$res['APERTAIL_ORA']}}"></td>
                                    </tr>
                                    <tr>
                                        <td>EMAIL FATTURAZIONE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="email" id="email" value="{{$res['EMAIL'] or ""}}"></td>
                                        <td>ATTIVIT&Agrave; CHIUSA IL</td>
                                        <td><input type="text" style="background-color: #FFC;" name="chiusail" readonly="readonly" disabled="disabled"  value="{{$res['CHIUSAIL']." - ".$res['CHIUSAIL_ORA']}}"></td>
                                    </tr>
                                    <tr>
                                        <td>NOME REFERENTE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="nome_referente" value="{{$res['NOME_REFERENTE'] or ""}}"></td>
                                        <td>TELEFONO REFERENTE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="telefono_referente" id="email" value="{{$res['TELEFONO_REFERENTE'] or ""}}"></td>
                                    </tr>
                                    <tr>
                                        <td>EMAIL REFERENTE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="email_referente" id="email_referente" value="{{$res['EMAIL_REFERENTE'] or ""}}"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="due"><h1>Fornitore</h1>
                                <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                                    <tr class="soggetto">
                                        <td>FORNITORE</td>
                                        <td style="background-color:#FFC">
                                            <input type="text" value="" name="search_fornitore" id="search_fornitore" class="locked">
                                            <select name="fornitore" id="fornitore" class="locked">
                                                <option value="">-----</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user['SOGGETTO']}}" {{isset($res['FORNITORE']) && $res['FORNITORE'] == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ".$user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NR TICKET FORNITORE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="tickettelecom" value="{{$res['TICKETTELECOM'] or ""}}"></td>
                                        <td>ORDINE FORNITORE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="ordinefornitore" value="{{$res['ORDINE_FORNITORE'] or ""}}"></td>
                                    </tr>
                                    <tr>
                                        <td>NOME REFERENTE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="nomefornitore" value="{{$res['NOME_FORNITORE'] or ""}}"></td>
                                        <td>TELEFONO REFERENTE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="telefonofornitore" value="{{$res['TELEFONO_FORNITORE'] or ""}}"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="tre"><h1>Servizio</h1>
                                <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
                                    <tr>
                                        <td>TGU/IMEI/TEL</td>
                                        <td><input type="text" style="background-color: #FFC;" name="tgu" value="{{$res['TGU'] or ""}}"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>CONFERMA ORDINE</td>
                                        <td><input type="text" style="background-color: #FFC;" name="conferma_ordine" id="conferma_ordine" value="{{$res['CONFERMA_ORDINE'] or ""}}"></td>
                                        <td>COD. SERVIZIO</td>
                                        <td><input type="text" style="background-color: #FFC;" name="cod_servizio" id="cod_servizio" value="{{$res['COD_SERVIZIO'] or ""}}"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>



                        <!-- END TABS -->



                        <!--

                        <br><br>
                        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php if(file_exists("/var/www/gsu/laravel/public/output/".$res['IDATTIVITA'].".pdf")): ?>
                                    <a href="/output/{{$res['IDATTIVITA']}}.pdf" download title="Verbalino" alt="Verbalino"><img src="{{ URL::asset('images/pdf_icon.png') }}"></a>
                                    <?php
                        endif;
                        ?>

                                </td>
                            </tr>
                            <tr>
                                <td>NR INTERNO TICKET </td>
                                <td class="manutenzione">{{$res['IDATTIVITA']}}</td>
                                <td>NR TICKET FORNITORE</td>
                                <td><input type="text" style="background-color: #FFC;" name="tickettelecom" value="{{$res['TICKETTELECOM'] or ""}}"></td>
                            </tr>
                            <tr>
                                <td>ATTIVIT&Agrave; APERTA DA</td>
                                <td>
                                    <select name="apertoda" class="apertoda" style="background-color: #FFC;">
                                        <option value="">-----</option>
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDAPERTODA']) && $res['IDAPERTODA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>ATTIVIT&Agrave; IN CARICO A</td>
                                <td>
                                    <select name="incaricoa" class="incaricoa" style="background-color: #FFC;">
                                        <option value="">-----</option>
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{isset($res['IDINCARICOA']) && $res['IDINCARICOA'] == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>EMAIL FATTURAZIONE</td>
                            <td><input type="text" style="background-color: #FFC;" name="email" id="email" value="{{$res['EMAIL'] or ""}}"></td>
                                <td>CATEGORIA *</td>
                                <td>
                                    <select name="categoria" id="categoria" class="categoria" style="background-color: #FFC;">
                                        @foreach($categorie as $categoria)
                                            <option value="{{$categoria['IDCATEGORIA'] or ""}}" {{isset($res['IDCATEGORIA']) && $res['IDCATEGORIA'] == $categoria['IDCATEGORIA'] ? 'selected="selected"' : ""  }}>{{$categoria['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>CARNET DISPONIBILI NR.</td>
                            <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="carnet_disponibili" id="carnet_disponibili" value="">&nbsp;&nbsp;<input type="button" value="Ordina Carnet" class="btn btn-primary btn-xs btn_carnet"></td>
                                <td>TIPOLOGIA ASSISTENZA</td>
                                <td><input type="text" style="background-color: #eee;" readonly="readonly" disabled="disabled" name="tipologia_assistenza" id="tipologia_assistenza" value=""></td>
                            </tr>
                            <tr>
                                <td>TICKET DISPONIBILI VAL. €</td>
                                <td><input type="text" style="background-color: #eee;min-width:50%;" readonly="readonly" disabled="disabled" name="ticket_disponibili" id="ticket_disponibili" value="">&nbsp;&nbsp;<input type="button" value="Ricarica Ticket" class="btn btn-primary btn-xs btn_ticket"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>NOME REFERENTE</td>
                                <td><input type="text" style="background-color: #FFC;" name="nome_referente" value="{{$res['NOME_REFERENTE'] or ""}}"></td>
                                <td>TELEFONO REFERENTE</td>
                                <td><input type="text" style="background-color: #FFC;" name="telefono_referente" id="email" value="{{$res['TELEFONO_REFERENTE'] or ""}}"></td>
                            </tr>
                            <tr>
                                <td>EMAIL REFERENTE</td>
                                <td><input type="text" style="background-color: #FFC;" name="email_referente" id="email_referente" value="{{$res['EMAIL_REFERENTE'] or ""}}"></td>
                                <td>ATTIVIT&Agrave; APERTA IL</td>
                                <td><input type="text" style="background-color: #FFC;" name="apertail" readonly="readonly" disabled="disabled" value="{{$res['APERTAIL']." - ".$res['APERTAIL_ORA']}}"></td>
                            </tr>
                            <tr>
                                <td>TGU / IMEI</td>
                                <td><input type="text" style="background-color: #FFC;" name="tgu" value="{{$res['TGU'] or ""}}"></td>
                                <td>ATTIVIT&Agrave; CHIUSA IL</td>
                                <td><input type="text" style="background-color: #FFC;" name="chiusail" readonly="readonly" disabled="disabled"  value="{{$res['CHIUSAIL']." - ".$res['CHIUSAIL_ORA']}}"></td>
                            </tr>
                            <tr>
                                <td>CONFERMA ORDINE</td>
                                <td><input type="text" style="background-color: #FFC;" name="conferma_ordine" id="conferma_ordine" value="{{$res['CONFERMA_ORDINE'] or ""}}"></td>
                                <td>COD. SERVIZIO</td>
                                <td><input type="text" style="background-color: #FFC;" name="cod_servizio" id="cod_servizio" value="{{$res['COD_SERVIZIO'] or ""}}"></td>
                            </tr>
                            <tr>
                                <td>TITOLO ATTIVIT&Agrave;</td>
                                <td><input type="text" style="background-color: #FFC;" name="titolo" value="{{$res['TITOLO'] or ""}}"></td>
                                <td>TEMPO TOTALE min.</td>
                                <td>
                                    <?php
                        $tempo_totale = 0;
                        foreach($attivita as $row):
                            if($row['IDATTIVITA'] == $res['IDATTIVITA'])
                                $tempo_totale += $row['TEMPO'];
                        endforeach;
                        ?>
                                    <input type="text" style="background-color: #FFC;" name="tempo_totale" value="{{$tempo_totale}}">
                                </td>
                            </tr>
                            <tr>
                                <td>MOTIVO DELLA CHIAMATA</td>
                                <td colspan="3"><textarea style="background-color: #FFC;" name="motivo" class="noEnter" cols="130">{{$res['MOTIVO'] or ""}}</textarea></td>
                            </tr>
                            <tr>
                                <td>DETTAGLIO ATTIVIT&Agrave;<?php if ($res['ELABORATO'] != 1): ?><a href="{{url('/ticket/modificaattivita?idattivita='.$res['IDATTIVITA'])}}" title="Modifica attività" style="float:right;"><i class="glyphicon glyphicon-pencil"></i></a><?php endif; ?></td>
                                <td colspan="3"><textarea style="background-color: #eee;" name="elenco_attivita" cols="130" readonly="readonly"><?php foreach($attivita as $row): if($row['IDATTIVITA'] == $res['IDATTIVITA']) echo $row['INSERITOIL']." - ".$row['INSERITOIL_ORA']." - ".$row['INCARICOA_ATTIVITA']." - ".trim($row['DESCRIZIONE']." - TEMPO: ".$row['TEMPO'])."&#10;------------------------&#10;"; endforeach; ?></textarea></td>
                            </tr>
                            <tr><?php if ($res['ELABORATO'] != 1): ?>
                                <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                            </tr>
                            <tr>
                                <td>AGGIUNGI ATTIVIT&Agrave;</td>
                                <td></td>
                                <td>TECNICO</td>
                                <td>
                                    <select name="incaricoa_attivita" class="incaricoa_attivita" style="background-color: #FFC;">
                                        <option value="">-----</option>
                                        @foreach($tecnici as $tecnico)
                                            <option value="{{$tecnico['IDTECNICO'] or ""}}" {{Session::has('idtecnico') && Session::get('idtecnico') == $tecnico['IDTECNICO'] ? 'selected="selected"' : ""  }}>{{$tecnico['DESCRIZIONE'] or ""}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>DURATA INTERVENTO MINUTI</td>
                            <td><input type="text" name="tempo" class="tempo" value="{{$res['TEMPO'] or "0"}}" style="min-width:50px !important; width:50px;background-color: #FFC;"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><textarea name="attivita" id="attivita" cols="130"></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="button" value="AGGIUNGI ATTIVIT&Agrave;" class="btn btn-primary btn-xs salva-attivita"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="color: #f00;background-color: #f00;height: 5px;"></td>
                                <?php endif; ?>
                            </tr>
                            <!-->
                        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail" style="width:100% !important">
                            <tr>
                                <td>CAMBIA STATO</td>
                                <td>
                                    <select name="stato" class="stato" style="background-color: #FFC;">
                                        @foreach($stati as $stato)
                                            <option value="{{$stato['IDSTATO'] or "0"}}" {{isset($res['IDSTATO']) && $res['IDSTATO'] == $stato['IDSTATO'] ? 'selected="selected"' : ""  }}>{{$stato['STATO'] or ""}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><?php if ($res['ELABORATO'] != 1): ?><input type="button" value="SALVA TICKET" class="btn btn-primary btn-xs salva-ticket"><?php endif;?></td>
                                <td><input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">
                                </td>
                                <td>
                                    <?php if ($res['ELABORATO'] != 1): ?><input type="button" value="INVIA SOLLECITO" style="float:right;" class="btn btn-primary btn-xs sollecito"><?php endif;?>
                                </td>
                            </tr>
                        </table>

                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="SOGGETTO_CODICE" value="{{isset($res['SOGGETTO_CODICE']) ? $res['SOGGETTO_CODICE'] : ""  }}">
                        <input type="hidden" name="CLIENTE_FINALE_CODICE" value="{{isset($res['CLIENTE_FINALE_CODICE']) ? $res['CLIENTE_FINALE_CODICE'] : ""  }}">
                        <input type="hidden" name="DESTINATARIOABITUALE_CODICE" value="{{isset($res['DESTINATARIOABITUALE_CODICE']) ? $res['DESTINATARIOABITUALE_CODICE'] : ""  }}">
                        <input type="hidden" name="SEDE_OPERATIVA" value="{{isset($res['SEDE_OPERATIVA']) ? $res['SEDE_OPERATIVA'] : ""  }}">
                        <input type="hidden" name="idattivita" id="idattivita" value="{{$idattivita or ""}}">
                    </form>

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

    <div id="msg_sollecito" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sollecito inviato con successo</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="msg_carnet" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Digitare il numero di carnet desiderati:</h4>
                    <input type="text" name="carnet_ordine" id="carnet_ordine">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-default btn-modal btn_carnet_ordine" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="msg_ticket" class="modal fade" style="z-index:99999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Digitare l'importo da ricaricare:</h4>
                    <input type="text" name="ticket_ordine" id="ticket_ordine">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="button" class="btn btn-default btn-modal btn_ticket_ordine" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script>

        $(document).ready(function () {

            $(".btn_carnet").click(function(){
                $('#msg_carnet').modal('show');
            })
            $(".btn_carnet_ordine").click(function(){
                if($("#carnet_ordine").val() == ''){
                    alert("Compilare il numero di ticket");
                    return false;
                }
                var qta = $("#carnet_ordine").val();
                var val = null;
                $.get("{{url('/ticket/storeOrdiniRighe')}}", {
                    qta: qta,
                    val: val,
                    idattivita: $("#idattivita").val()
                })
                        .done(function (data) {
                            alert("Ordine salvato");
                        });
            })

            $(".btn_ticket").click(function(){
                $('#msg_ticket').modal('show');
            })
            $(".btn_ticket_ordine").click(function(){
                if($("#ticket_ordine").val() == ''){
                    alert("Compilare il valore da ricaricare");
                    return false;
                }
                var qta = 1;
                var val = $("#ticket_ordine").val();
                $.get("{{url('/ticket/storeOrdiniRighe')}}", {
                    qta: qta,
                    val: val,
                    idattivita: $("#idattivita").val()
                })
                        .done(function (data) {
                            alert("Ordine salvato");
                        });
            })

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
                            $("#attivita").val("");
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

            $("#cliente").change(function(){
                $.post( "{{url('/ticket/getCategorie')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            $("#sedeoperativa").val($("#cliente").val()).change();
                            data = JSON.parse(data);
                            var $select = $('#categoria');
                            $select.find('option').remove();
                            $.each(data, function (key, data) {
                                $select.append('<option value=' + data.Codice + '>' + data.Descrizione + '</option>');
                            })
                            //$select.val('{{$res['IDCATEGORIA']}}');
                            $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                    .done(function (data) {
                                        data = JSON.parse(data);
                                        $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                        $("#ticket_disponibili").val(0);
                                        if($("#tipologia_assistenza").val() == "TICKET") {
                                            $.get("{{url('/ticket/getTicketDisponibili')}}", {
                                                categoria: $("#categoria").val(),
                                                cliente: $("#cliente").val()
                                            })
                                                    .done(function (data) {
                                                        data = JSON.parse(data);
                                                        $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                                    });
                                        }
                                    });
                        });

                $.get( "{{url('/ticket/getCarnetDisponibili')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                        .done(function( data ) {
                            data = JSON.parse(data);
                            var count = 0;
                            $.each(data, function (key, data) {
                                count++;
                            })
                            $("#carnet_disponibili").val(count);
                            console.log(count);
                        });

                $.post( "{{url('/ticket/getEmailCliente')}}", {'cliente' : $("#cliente").val(), '_token' : '{{ csrf_token() }}' })
                        .done(function( data ) {
                            data = JSON.parse(data);
                            $("#email").val(data[0]['EMAIL']);
                            //$("#nome_referente").val(data[0]['CONTATTO']);
                            $("#telefono_referente").val(data[0]['TELEFONO']);
                        });

                $.post( "{{url('/ticket/checkBlocked')}}", $(this).closest('form').serialize())
                        .done(function( data ) {
                            data = JSON.parse(data);
                            if(data[0].Blocked == 1)
                            {
                                $('#msg_bloccato').modal('show');
                            }
                        });
            });

            $("#categoria").change(function(){
                $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                        .done(function (data) {

                            data = JSON.parse(data);
                            $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                            $.get( "{{url('/ticket/getCarnetDisponibili')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                    .done(function( data ) {
                                        data = JSON.parse(data);
                                        var count = 0;
                                        $.each(data, function (key, data) {
                                            count++;
                                        })
                                        $("#carnet_disponibili").val(count);
                                        console.log(count);
                                    });
                            $("#ticket_disponibili").val(0);
                            if($("#tipologia_assistenza").val() == "TICKET") {
                                $.get("{{url('/ticket/getTicketDisponibili')}}", {
                                    categoria: $("#categoria").val(),
                                    cliente: $("#cliente").val()
                                })
                                        .done(function (data) {
                                            data = JSON.parse(data);
                                            $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                            console.log(data[0].JBS_ValoreTotaleEuro);
                                        });
                            }

                        });

            });

        });

        $(".sollecito").click(function(){
            $.get( "{{url('/ticket/sollecitoticket')}}", $(this).closest('form').serialize())
                    .done(function( data ) {
                        $('#msg_sollecito').modal('show');
                    });
        });

        function changeCliente(){
            $.post( "{{url('/ticket/getCategorie')}}", $('#form_ticket').serialize())
                    .done(function( data ) {
                        data = JSON.parse(data);
                        var $select = $('#categoria');
                        $select.find('option').remove();
                        $.each(data, function (key, data) {
                            $select.append('<option value=' + data.Codice + '>' + data.Descrizione + '</option>');
                        })
                        $select.val('{{$res['IDCATEGORIA']}}');
                        $.get("{{url('/ticket/getTipologiaContratto')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                                .done(function (data) {
                                    data = JSON.parse(data);
                                    $("#tipologia_assistenza").val(data[0].TipologiaAssistenza);
                                    $("#ticket_disponibili").val(0);
                                    if($("#tipologia_assistenza").val() == "TICKET") {
                                        $.get("{{url('/ticket/getTicketDisponibili')}}", {
                                            categoria: $("#categoria").val(),
                                            cliente: $("#cliente").val()
                                        })
                                                .done(function (data) {
                                                    data = JSON.parse(data);
                                                    $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                                                    console.log(data[0].JBS_ValoreTotaleEuro);
                                                });
                                    }
                                });
                    });

            $.get( "{{url('/ticket/getCarnetDisponibili')}}", {categoria: $("#categoria").val(), cliente: $("#cliente").val()})
                    .done(function( data ) {
                        data = JSON.parse(data);
                        var count = 0;
                        $.each(data, function (key, data) {
                            count++;
                        })
                        $("#carnet_disponibili").val(count);
                        console.log(count);
                    });

            $.post( "{{url('/ticket/getEmailCliente')}}", {'cliente' : $("#cliente").val(), '_token' : '{{ csrf_token() }}' })
                    .done(function( data ) {
                        data = JSON.parse(data);
                        $("#email").val(data[0]['EMAIL']);
                        //$("#nome_referente").val(data[0]['CONTATTO']);
                        $("#telefono_referente").val(data[0]['TELEFONO']);
                    });

            $.get( "{{url('/ticket/checkBlocked')}}", $(this).closest('form').serialize())
                    .done(function( data ) {
                        data = JSON.parse(data);
                        if(data[0].Blocked == 1)
                        {
                            $('#msg_bloccato').modal('show');
                        }
                    });
        }

        changeCliente();
        $("#cliente").trigger("change");
        $("#cliente_finale").trigger("change");
        $("#ubicazione_impianto").trigger("change");
        $("#tgu").trigger("change");
        $("#categoria").trigger("change");
        $("#ticket_disponibili").val(0);
        if($("#tipologia_assistenza").val() == "TICKET") {
            $.get("{{url('/ticket/getTicketDisponibili')}}", {
                categoria: $("#categoria").val(),
                cliente: $("#cliente").val()
            })
                    .done(function (data) {
                        data = JSON.parse(data);
                        $("#ticket_disponibili").val(data[0].JBS_ValoreTotaleEuro);
                        console.log(data[0].JBS_ValoreTotaleEuro);
                    });
        }

        /*$(".noEnter").keypress(function(evt) {
         var charCode=(evt.which)?evt.which:event.keyCode;
         if (charCode == 10 || charCode == 13)
         return false;
         return true;
         });*/



    </script>

@endsection