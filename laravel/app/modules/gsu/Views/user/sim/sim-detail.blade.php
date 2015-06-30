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
                    <td>N°TELEFONO</td>
                    <td><input type="text" name="ntelefono" value="{{$request['NTELEFONO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>CCID</td>
                    <td><input type="text" name="ccid" value="{{$request['CCID'] or ""}}"></td>
                </tr>
                <tr>
                    <td>TIPO SIM</td>
                    <td><select name="tiposim">
                            <option value=""  {{isset($request['TIPOSIM']) && $request['TIPOSIM'] == "" ? 'selected="selected"' : ""  }}>- Selezionare tipo -</option>
                            <option value="LN"  {{isset($request['TIPOSIM']) && $request['TIPOSIM'] == "LN" ? 'selected="selected"' : ""  }}>LN</option>
                            <option value="MNP" {{isset($request['TIPOSIM']) && $request['TIPOSIM'] == "MNP" ? 'selected="selected"' : ""  }}>MNP</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>TECNOLOGIA</td>
                    <td>
                        <table>
                            <tr>
                                <td><input type="checkbox" name="tec_gsm" {{isset($request['TEC_GSM']) && $request['TEC_GSM'] == "1" ? 'checked="checked"' : ""  }}>GSM
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="tec_umts" {{isset($request['TEC_UMTS']) && $request['TEC_UMTS'] == "1" ? 'checked="checked"' : ""  }}>UMTS
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="tec_edge" {{isset($request['TEC_EDGE']) && $request['TEC_EDGE'] == "1" ? 'checked="checked"' : ""  }}>EDGE
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>DESTINAZIONE USO</td>
                    <td><select name="tgc">
                            <option value=""  {{isset($request['TGC']) && $request['TGC'] == "" ? 'selected="selected"' : ""  }}>- Selezionare tipo -</option>
                            <option value="AFFARI"  {{isset($request['TGC']) && $request['TGC'] == "AFFARI" ? 'selected="selected"' : ""  }}>AFFARI</option>
                            <option value="RESIDENZIALE" {{isset($request['TGC']) && $request['TGC'] == "RESIDENZIALE" ? 'selected="selected"' : ""  }}>RESIDENZIALE</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>CATEGORIA CHIAMATE</td>
                    <td><select name="catchiamate">
                            <option value=""  {{isset($request['CATCHIAMATE']) && $request['CATCHIAMATE'] == "" ? 'selected="selected"' : ""  }}>- Selezionare tipo -</option>
                            <option value="BASE"  {{isset($request['CATCHIAMATE']) && $request['CATCHIAMATE'] == "BASE" ? 'selected="selected"' : ""  }}>BASE</option>
                            <option value="ESTESO" {{isset($request['CATCHIAMATE']) && $request['CATCHIAMATE'] == "ESTESO" ? 'selected="selected"' : ""  }}>ESTESO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>PIANO TARIFFARIO</td>
                    <td><input type="text" name="pianotariffario" value="{{$pianotariffario or ""}}" readonly></td>
                </tr>
                <tr>
                    <td>NOTE PIANO TARIFFARIO</td>
                    <td><textarea name="note_piano_tariffario" rows="8" cols="50" readonly="readonly">{{$note or ""}}</textarea></td>
                </tr>
                <tr>
                    <td>PROMOZIONE ATTIVA</td>
                    <td><select name="promovoce">
                            <option value="0"{{isset($request['PROMOVOCE']) && $request['PROMOVOCE'] == "" ? 'selected="selected"' : ""  }}>Niente</option>
                            <option value="1"{{isset($request['PROMOVOCE']) && $request['PROMOVOCE'] == "1" ? 'selected="selected"' : ""  }}>NoTax</option>
                            <option value="2"{{isset($request['PROMOVOCE']) && $request['PROMOVOCE'] == "2" ? 'selected="selected"' : ""  }}>Direttirici 50%</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>NUMERO BREVE</td>
                    <td><input type="text" name="nbreve" value="{{$request['NBREVE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>RESTRIZIONI</td>
                    <td><input type="text" name="restrizioni" value="{{$request['RESTRIZIONI'] or ""}}"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDSIM'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">
                        @if($btn == 'save')
                            <input type="button" value="SALVA" id="btn_salva" class="btn btn-primary btn-xs">
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-default btn-xs">
                            <div class="pull-right"><input type="checkbox" name="eliminato" <?php echo Input::get('eliminati') != 'on' ? '' :  "checked" ?> >ELIMINATO</div>
                        @else
                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">
                        @endif
                    </td>
                </tr>
            </form>
        </table>
        
    <hr>


        @if(View::exists('gsu::varie.sim-links'))
            @include('gsu::varie.sim-links')
        @endif

@endsection


