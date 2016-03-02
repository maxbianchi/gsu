<?php
if(!isset($request['SOGGETTO']))
    $request['SOGGETTO'] = "";
if(!isset($request['CLIENTE']))
    $request['CLIENTE'] = "";
if(!isset($request['DESTINATARIOABITUALE']))
    $request['DESTINATARIOABITUALE'] = "";
if(!isset($request['NTELEFONO']))
    $request['NTELEFONO'] = "";
$request['SOGGETTO'] = trim($request['SOGGETTO']);
$request['CLIENTE'] = trim($request['CLIENTE']);
$request['DESTINATARIOABITUALE'] = trim($request['DESTINATARIOABITUALE']);
?>

<table class="servizi_collegati" style="width:100%; border: 1px solid #C0C0C0; " cellspacing="3px">
    <tr>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I00&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SIM VOCE</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I01&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SIM M2M</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I02&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">SIM TWIN</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I03&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">EXTENSION</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I05&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">OPZIONI ROAMING</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I06&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">OPZIONI INTERCOM</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I10&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">TASSA MINISTERIALE</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I11&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">OPZIONE DATI</a>
        </td>

    </tr>
    <tr>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I12&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">OPZIONE DATI ESTERO</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I20&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">ASSISTENZA TECNICA</a>
        </td>
        <td>
            <a href="{{url('/gsu/search')."?canone=CAN-I21&cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']}}">FILTRO ACCESSI</a>
        </td>
        <td>
            <a href="{{url('/gsu/apparati-mobile/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&ntelefono=".$request['NTELEFONO']}}">APPARATI MOBILE</a>
        </td>
        <td>
            <a href="{{url('/gsu/sim-servizio-reperibilita/search')."?cliente=".$request['SOGGETTO']."&cliente_finale=".$request['CLIENTE']."&ubicazione=".$request['DESTINATARIOABITUALE']."&ntelefono=".isset($request['TELEFONO']) && !empty($request['TELEFONO']) ? $request['TELEFONO'] : ""}}">SERVIZIO REPERIBILITA</a>
        </td>
    </tr>
</table>