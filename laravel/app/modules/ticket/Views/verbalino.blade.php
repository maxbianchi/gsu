@extends('ticket::app')

@section('content')
    <br><br>
    <br><br>
    <div style="margin-left: 30px;">

        <form action="#" method="POST" name="form" id="form">
            <table>
                <tbody>
                <tr class="soggetto">
                    <td>CLIENTE *</td>
                    <td>
                        <input type="text" value="" name="search_cliente" id="search_cliente" >
                        <select name="cliente" id="cliente">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{Input::has('SOGGETTO_CODICE') && Input::get('SOGGETTO_CODICE') == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="cliente">
                    <td>CLIENTE FINALE</td>
                    <td>
                        <input type="text" value="" name="search_cliente_finale" id="search_cliente_finale" >
                        <select name="cliente_finale" id="cliente_finale">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{Input::has('CLIENTE_FINALE_CODICE') && Input::get('CLIENTE_FINALE_CODICE') == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="destinatarioabituale">
                    <td>UBICAZIONE IMPIANTO</td>
                    <td>
                        <input type="text" value="" name="search_ubicazione" id="search_ubicazione" >
                        <select name="ubicazione_impianto" id="ubicazione_impianto">
                            <option value="">-----</option>
                            @foreach($users as $user)
                                <option value="{{$user['SOGGETTO']}}" {{Input::has('DESTINATARIOABITUALE_CODICE') && Input::get('DESTINATARIOABITUALE_CODICE') == $user['SOGGETTO'] ? 'selected="selected"' : ""  }}>{{$user['DESCRIZIONE']." - ".$user['INDIRIZZO']." - ".$user['LOCALITA']." - ".$user['PROVINCIA']." - ". $user['SOGGETTO']." - PIVA: ".$user['PARTITAIVA']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="sedeoperativa">
                    <td>SEDE OPERATIVA</td>
                    <td>
                        <input type="text" value="" name="search_sedeoperativa" id="search_sedeoperativa" >
                        <select name="sedeoperativa" id="sedeoperativa">
                            <option value="">-----</option>
                            @foreach($sedioperative as $sede)
                                <option value="{{$sede['CustSupp']}}" {{Input::has('SEDE_OPERATIVA') && Input::get('SEDE_OPERATIVA') == $sede['CustSupp'] ? 'selected="selected"' : ""  }}>{{$sede['CompanyName']." - ".$sede['Address']." - ".$sede['City']." - ".$sede['County']." - ".$sede['CustSupp']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>

            <br><br>
            <br><br>

            <div id="toPrint" style="width:595pt; height:842pt;">

                <table style="width:100%;font-family: Arial; font-size:10px;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" style="width:30%;">
                            <img src="{{ URL::asset('images/loghi_verbalino.jpg') }}" alt="Uniweb 4.0 Dashboard" style="width:95%;" title="Uniweb 4.0 Dashboard">
                        </td>
                        <td style="width:70%;" colspan="2">
                            <table style="width:100%">
                                <tr>
                                    <td style="width:20%">
                                        CLIENTE
                                    </td>
                                    <td style="width:80%">
                                        <input type="text" value="" id="ragionesociale" name="ragionesociale" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Citta'
                                    </td>
                                    <td>
                                        <input type="text" value="" id="citta" name="citta" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Indirizzo
                                    </td>
                                    <td>
                                        <input type="text" value="" id="indirizzo" name="indirizzo" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        <input type="text" value="{{Input::get('email')}}" id="email" name="email" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        CLIENTE FINALE
                                    </td>
                                    <td>
                                        <input type="text" value="" id="cliente_finale_ragionesociale" name="cliente_finale_ragionesociale" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Citta'
                                    </td>
                                    <td>
                                        <input type="text" value="" id="cliente_finale_citta" name="cliente_finale_citta" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Indirizzo
                                    </td>
                                    <td>
                                        <input type="text" value="" id="cliente_finale_indirizzo" name="cliente_finale_indirizzo" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        UBICAZIONE
                                    </td>
                                    <td>
                                        <input type="text" value="" id="ubicazione_ragionesociale" name="ubicazione_ragionesociale" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Citta'
                                    </td>
                                    <td>
                                        <input type="text" value="" id="ubicazione_citta" name="ubicazione_citta" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Indirizzo
                                    </td>
                                    <td>
                                        <input type="text" value="" id="ubicazione_indirizzo" name="ubicazione_indirizzo" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Referente
                                    </td>
                                    <td>
                                        <input type="text" value="{{Input::get('nome_referente')}}" id="riferimento" name="riferimento" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tel.
                                    </td>
                                    <td>
                                        <input type="text" value="{{Input::get('telefono_referente')}}" id="telefono" name="telefono" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        <input type="text" value="{{Input::get('email_referente')}}" id="email_referente" name="email_referente" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <div style="border:solid 1px; text-align: center;">RDI - Rapporto di intervento tecnico nr. {{Input::get('idattivita')}} del {{$apertail}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <div style="border:solid 1px; text-align: center;">
                                <table>
                                    <tr>
                                        <td style="text-align: center;">
                                            Matricola <input type="text" value="{{$verbalino['MATRICOLA'] or ""}}" id="matricola" name="matricola" class="edit" style="width:100%">
                                        </td>
                                        <td style="text-align: center;">
                                            Modello  <input type="text" value="{{$verbalino['MODELLO'] or ""}}" id="modello" name="modello" class="edit" style="width:100%">
                                        </td>
                                        <td style="text-align: center;">
                                            Lettura Tot bn <input type="text" value="{{$verbalino['LETTURA_BN'] or ""}}" id="tot_bn" name="tot_bn" class="edit" style="width:100%">
                                        </td>
                                        <td style="text-align: center;">
                                            Lettura Tot colore <input type="text" value="{{$verbalino['LETTURA_COLORE'] or ""}}" id="tot_colore" name="tot_colore" class="edit" style="width:100%">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <div style="border:solid 1px; text-align: center;">
                                Motivo della chiamata <textarea value="<?php echo isset($verbalino['MOTIVO']) ? $verbalino['MOTIVO'] : Input::get('motivo'); ?>" id="motivo" name="motivo" class="edit-textarea" style="width:100%" rows="4"><?php echo isset($verbalino['MOTIVO']) ? $verbalino['MOTIVO'] : Input::get('motivo'); ?></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <div style="border:solid 1px; text-align: center;">
                                Descrizione Intervento <textarea value="{{$verbalino['DESCRIZIONE_INTERVENTO'] or ""}}" id="descrizione" name="descrizione" class="edit-textarea" style="width:100%" rows="6">{{$verbalino['DESCRIZIONE_INTERVENTO'] or ""}}</textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <table border="1" style="width:100%">
                                <tr>
                                    <td style="width:20%">
                                        Codice
                                    </td>
                                    <td style="width:40%">
                                        Descrizione
                                    </td>
                                    <td  style="width:10%">
                                        Q.ta
                                    </td>
                                    <td  style="width:30%">
                                        Note
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%">
                                        <input type="text" value="{{$verbalino['CODICE_1'] or ""}}" id="codice1" name="codice1" class="edit" style="width:100%">
                                    </td>
                                    <td style="width:40%">
                                        <input type="text" value="{{$verbalino['DESCRIZIONE_1'] or ""}}" id="descrizione1" name="descrizione1" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['QTA_1'] or ""}}" id="qta1" name="qta1" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:30%">
                                        <input type="text" value="{{$verbalino['NOTE_1'] or ""}}" id="note1" name="note1" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%">
                                        <input type="text" value="{{$verbalino['CODICE_2'] or ""}}" id="codice2" name="codice2" class="edit" style="width:100%">
                                    </td>
                                    <td style="width:40%">
                                        <input type="text" value="{{$verbalino['DESCRIZIONE_2'] or ""}}" id="descrizione2" name="descrizione2" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['QTA_2'] or ""}}" id="qta2" name="qta2" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:30%">
                                        <input type="text" value="{{$verbalino['NOTE_2'] or ""}}" id="note2" name="note2" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:20%">
                                        <input type="text" value="{{$verbalino['CODICE_3'] or ""}}" id="codice3" name="codice3" class="edit" style="width:100%">
                                    </td>
                                    <td style="width:40%">
                                        <input type="text" value="{{$verbalino['DESCRIZIONE_3'] or ""}}" id="descrizione3" name="descrizione3" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['QTA_3'] or ""}}" id="qta3" name="qta3" class="edit" style="width:100%">
                                    </td>
                                    <td  style="width:30%">
                                        <input type="text" value="{{$verbalino['NOTE_3'] or ""}}" id="note3" name="note3" class="edit" style="width:100%">
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:10px;">
                            <table>
                                <tr>
                                    <td style="width:10%">
                                        Data Intervento
                                    </td>
                                    <td style="width:10%">
                                        <input type="text" value="{{$verbalino['DATA_INTERVENTO_CONV'] or ""}}" id="data_intervento" name="data_intervento" class="edit-date datepicker" style="width:100%">
                                    </td>
                                    <td  style="width:10%">
                                        <!--Intervento Remoto-->
                                        Tipologia intervento
                                    </td>
                                    <td  style="width:10%">
                                        <select name="tipologia_intervento" id="tipologia_intervento">
                                            <option value=""><?php echo isset($verbalino['TIPOLOGIA_INTERVENTO']) ? $verbalino['TIPOLOGIA_INTERVENTO'] : '------' ?> </option>
                                            <option value="TELEFONICO">TELEFONICO</option>
                                            <option value="IN REMOTO">IN REMOTO</option>
                                            <option value="PRESSO CLIENTE">PRESSO CLIENTE</option>
                                        </select>
                                        <!--<input type="checkbox" value="" <?php echo isset($verbalino['INTERVENTO_REMOTO']) && $verbalino['INTERVENTO_REMOTO'] == 1 ? "checked='checked'" : ""; ?> name="intervento_remoto" class="edit-checkbox" style="width:100%">-->
                                    </td>
                                    <td  style="width:10%">
                                        Tempo gestione interno min.
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="<?php echo isset($verbalino['TEMPO_TOTALE']) ? $verbalino['TEMPO_TOTALE'] : Input::get('tempo_totale'); ?>" id="tempo" name="tempo" class="edit" style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%">
                                        Tempo Viaggio(h:mm)
                                    </td>
                                    <td style="width:10%">
                                        <input type="text" value="{{$verbalino['TEMPO_VIAGGIO_1'] or ""}}" id="tempo_viaggio" name="tempo_viaggio" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['TEMPO_VIAGGIO_1_MINUTI'] or ""}}" id="tempo_viaggio_minuti" name="tempo_viaggio_minuti" class="edit" style="width:40%">
                                    </td>
                                    <td  style="width:10%">
                                        Ora inizio intervento(h:mm)
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['ORA_INIZIO_1'] or ""}}" id="ora_inizio" name="ora_inizio" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['ORA_INIZIO_1_MINUTI'] or ""}}" id="ora_inizio_minuti" name="ora_inizio_minuti" class="edit" style="width:40%">
                                    </td>
                                    <td  style="width:10%">
                                        Ora fine intervento(h:mm)
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['ORA_FINE_1'] or ""}}" id="ora_fine" name="ora_fine" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['ORA_FINE_1_MINUTI'] or ""}}" id="ora_fine_minuti" name="ora_fine_minuti" class="edit" style="width:40%">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%">
                                        Tempo Viaggio(h:mm)
                                    </td>
                                    <td style="width:10%">
                                        <input type="text" value="{{$verbalino['TEMPO_VIAGGIO_2'] or ""}}" id="tempo_viaggio2" name="tempo_viaggio2" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['TEMPO_VIAGGIO_2_MINUTI'] or ""}}" id="tempo_viaggio2_minuti" name="tempo_viaggio2_minuti" class="edit" style="width:40%">
                                    </td>
                                    <td  style="width:10%">
                                        Ora inizio intervento(h:mm)
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['ORA_INIZIO_2'] or ""}}" id="ora_inizio2" name="ora_inizio2" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['ORA_INIZIO_2_MINUTI'] or ""}}" id="ora_inizio2_minuti" name="ora_inizio2_minuti" class="edit" style="width:40%">
                                    </td>
                                    <td  style="width:10%">
                                        Ora fine intervento(h:mm)
                                    </td>
                                    <td  style="width:10%">
                                        <input type="text" value="{{$verbalino['ORA_FINE_2'] or ""}}" id="ora_fine2" name="ora_fine2" class="edit" style="width:40%">&nbsp;:&nbsp;
                                        <input type="text" value="{{$verbalino['ORA_FINE_2_MINUTI'] or ""}}" id="ora_fine2_minuti" name="ora_fine2_minuti" class="edit" style="width:40%">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:20px;">
                            <div style="border:solid 1px; text-align: center;">
                                Note sull'intervento <textarea value="{{$verbalino['NOTE'] or ""}}" id="note" name="note" class="edit-textarea" style="width:100%" rows="4">{{$verbalino['NOTE'] or ""}}</textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width:100%">
                                <tr>
                                    <td style="width:30%">
                                        Intervento risolutivo <input type="checkbox" value="" <?php echo isset($verbalino['INTERVENTO_RISOLUTIVO']) && $verbalino['INTERVENTO_RISOLUTIVO'] == 1 ? "checked='checked'" : ""; ?> name="intervento_risolutivo_si" class="edit-checkbox">SI <input type="checkbox" value="" name="intervento_risolutivo_no" class="edit-checkbox">NO
                                    </td>
                                    <td style="width:20%">
                                        <!--In garanzia <input type="checkbox" value="" <?php echo isset($verbalino['IN_GARANZIA']) && $verbalino['IN_GARANZIA'] == 1 ? "checked='checked'" : ""; ?> name="garanzia_si" class="edit-checkbox">SI <input type="checkbox" value="" name="garanzia_no" class="edit-checkbox">NO-->
                                        <?php if(isset($verbalino['IN_GARANZIA']))
                                                echo $verbalino['IN_GARANZIA'] == 1 ? "A CONSUNTIVO" : "A CONTRATTO";
                                              else
                                                echo Input::has("ingaranzia") && Input::get("ingaranzia") == 1 ? "A CONSUNTIVO" : "A CONTRATTO";
                                        ?>
                                    </td>

                                        <td style="width:10%">
                                            Carnet Mattina
                                        </td>
                                        <td style="width:15%">
                                        <select name="carnet_mattina" id="carnet_mattina">
                                            <option value=""><?php echo isset($verbalino['CARNET_MATTINA']) ? $verbalino['CARNET_MATTINA'] : '------' ?> </option>
                                            @foreach($carnetdisponibili as $row)
                                                <option value="{{$row['Seriale']}}">{{$row['Seriale']}}</option>
                                            @endforeach
                                        </select>
                                        </td>
                                    <td style="width:10%">
                                        Pomeriggio
                                    </td>
                                    <td style="width:15%">
                                        <select name="carnet_pomeriggio" id="carnet_pomeriggio">
                                            <option value="<?php echo isset($verbalino['CARNET_POMERIGGIO']) ? $verbalino['CARNET_POMERIGGIO'] : '' ?>"><?php echo isset($verbalino['CARNET_POMERIGGIO']) ? $verbalino['CARNET_POMERIGGIO'] : '------' ?> </option>
                                            @foreach($carnetdisponibili as $row)
                                                <option value="{{$row['Seriale']}}">{{$row['Seriale']}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td style="width:7%">
                                        Macchina in funzione <input type="checkbox" value="" <?php echo isset($verbalino['MACCHINA_FUNZIONE']) && $verbalino['MACCHINA_FUNZIONE'] == 1 ? "checked='checked'" : ""; ?> name="macchina_funzione_si" class="edit-checkbox">SI <input type="checkbox" value="" name="macchina_funzione_no" class="edit-checkbox">NO
                                    </td>

                                </tr>-->

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%" colspan="2">
                            <table style="width:100%" border="1">
                                <tr>
                                    <td style="width:50%; height: 50pt;" valign="top">
                                        Timbro e firma del cliente
                                    </td>
                                    <td style="width:50%; height: 50pt;text-align: center" valign="top">
                                        Tecnico<br><h2><?php echo isset($verbalino['TECNICO_FIRMA']) ? $verbalino['TECNICO_FIRMA'] : $tecnico; ?></h2>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <div class="container_12" style="text-align: center;">
                                <table>
                                    <tr>
                                        <td style="width:20%;text-align:left;" valign="top">
                                            <img src="{{ URL::asset('images/logo1.png') }}" style="width:80%;">
                                        </td>
                                        <td style="width:60%;font-size:8px;font-family:'Century Gothic'" valign="top">
                                            <strong>Uniweb Srl</strong>
                                            - Via Milano, 51 - 22063 Cantu' (CO) - CF / P.IVA 02478160134
                                            <br>
                                            Tel. +39 031 701728 r.a. - Fax +39 031 7073755  <br>
                                            E-mail:<a href="mailto:info@uniweb.it">info@uniweb.it</a> Pec: info@pec.uniweb.it
                                            <br>
                                            Reg. Imp. di Como n. 02478160134 - Capitale Sociale: € 15.000,00 i.v. - CCIAA Como REA n. 262922
                                        </td>
                                        <td style="width:20%;text-align:right;">
                                            <img src="{{ URL::asset('images/iso.png') }}" style="width:80%;float:right;" valign="top">
                                        </td>
                                    </tr>
                                </table>

                            </div>

                        </td>
                    </tr>
                </table>

            </div>
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="incaricoa" value="{{Input::get('incaricoa')}}">
            <input type="hidden" name="idattivita" value="{{Input::get('idattivita')}}">
            <input type="hidden" name="macchina_funzione_no" value="0">
            <input type="hidden" name="macchina_funzione_si" value="1">
            <br>
            <br>
            <br>
            <br>
            <input type="button" value="SALVA" onclick="toPDF();">
        </form>

    </div>

    <br>
    <br>

@endsection

@section('script')
    <script type="text/javascript">


        function toPDF() {

            //SALVO SU DB
            msg = "";
            if($("#data_intervento").val() == "")
                msg = msg + " 'Data attivita'";
            if(msg != ""){
                alert("Compilare i campi" + msg);
                return false;
            }
            $.post( "{{url('/ticket/salvaverbalino')}}", $("#form").serialize())
                    .done(function( data ) {
                        //CREO PDF E LO SALVO
                        var cliente = $("#cliente").val();
                        var cliente_finale = $("#cliente_finale").val();
                        var ubicazione_impianto = $("#ubicazione_impianto").val();
                        var email_referente = $("#email_referente").val();
                        var html="<!DOCTYPE html><head><meta charset='utf-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'></head><body>";
                        html+= document.getElementById('toPrint').innerHTML;
                        html+="</body></html>";

                        $.post( "/ticket/pdf", { html: html, '_token': '{{ csrf_token() }}', idattivita: '{{Input::get('idattivita')}}', email: '{{Input::get('email')}}', motivo: '<?php str_replace(array("\n","\r"),"",Input::get('motivo'))?>', cliente: cliente, cliente_finale: cliente_finale, ubicazione_impianto: ubicazione_impianto, email_referente: email_referente })
                                .done(function( data ) {
                                    location.href = '{{url('/ticket/alltickets')}}';
                                });
                    });
        }

        $(function() {

            $("#carnet_mattina").change(function(){
                var select = $(this).val();
                $("#carnet_mattina").find('option:eq(0)').val(select);
                $("#carnet_mattina").find('option:eq(0)').text(select);
            })

            $("#carnet_pomeriggio").change(function(){
                var select = $(this).val();
                $("#carnet_pomeriggio").find('option:eq(0)').val(select);
                $("#carnet_pomeriggio").find('option:eq(0)').text(select);
            })

            $("#tipologia_intervento").change(function(){
                var select = $(this).val();
                $("#tipologia_intervento").find('option:eq(0)').val(select);
                $("#tipologia_intervento").find('option:eq(0)').text(select);
            })



            $("#cliente").change(function () {
                var id = $("#cliente").val();
                $("#sedeoperativa").val($("#cliente").val()).change();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });
            $("#cliente_finale").change(function () {
                var id = $("#cliente_finale").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#cliente_finale_ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#cliente_finale_ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#cliente_finale_indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#cliente_finale_indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#cliente_finale_citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#cliente_finale_citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });

            $("#sedeoperativa").change(function () {
                var id = $("#sedeoperativa").val();
                $.get("/ticket/getuserfromjbs_sede_operativa", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#ubicazione_ragionesociale").val(data[0]['CompanyName']);
                            $("#ubicazione_ragionesociale").attr("value", (data[0]['CompanyName']));
                            $("#ubicazione_indirizzo").val(data[0]['Address']);
                            $("#ubicazione_indirizzo").attr("value", (data[0]['Address']));
                            $("#ubicazione_citta").val(data[0]['City'] + " - " + data[0]['County'] + " - " + data[0]['ZIPCode']);
                            $("#ubicazione_citta").attr("value", (data[0]['City'] + " - " + data[0]['County'] + " - " + data[0]['ZIPCode']));
                        });
            });

            $("#ubicazione_impianto").change(function () {
                var id = $("#ubicazione_impianto").val();
                $.get("/ticket/getuserfrommago", {id: id})
                        .done(function (data) {
                            data = JSON.parse(data);
                            $("#ubicazione_ragionesociale").val(data[0]['DESCRIZIONE']);
                            $("#ubicazione_ragionesociale").attr("value", (data[0]['DESCRIZIONE']));
                            $("#ubicazione_indirizzo").val(data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']);
                            $("#ubicazione_indirizzo").attr("value", (data[0]['INDIRIZZO'] + " - Tel.: " + data[0]['TELEFONO']));
                            $("#ubicazione_citta").val(data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']);
                            $("#ubicazione_citta").attr("value", (data[0]['LOCALITA'] + " - " + data[0]['PROVINCIA'] + " - " + data[0]['CAP']));
                        });
            });


            $(".edit").on("keyup", function(){
                $(this).attr("value", $(this).val());
            });

            $(".edit-date").on("change", function(){
                $(this).attr("value", $(this).val());
            });

            $(".edit-textarea").on("keyup", function(){
                $(this).html($(this).val());
            });

            $(".edit-checkbox").on("change", function(){
                if( $(this).prop('checked'))
                    $(this).attr("checked","checked");
                else
                    $(this).removeAttr('checked');
            });

            $("#cliente").val('{{Input::get('SOGGETTO_CODICE')}}').trigger("change");
            $("#cliente_finale").val('{{Input::get('CLIENTE_FINALE_CODICE')}}').trigger("change");
            $("#sedeoperativa").val('{{Input::get('SEDE_OPERATIVA')}}').trigger("change");
            $("#ubicazione_impianto").val('{{Input::get('DESTINATARIOABITUALE_CODICE')}}').trigger("change");

            $('textarea').each(function () {
                h(this);
            }).on('input', function () {
                h(this);
            });

        })

    </script>
@endsection