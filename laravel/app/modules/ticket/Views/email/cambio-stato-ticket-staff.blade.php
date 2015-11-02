<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>

<h3>Buongiorno,<br>
    con la presente vi informiamo che il ticket id: {{$idattivita}} <br>
    Titolo: {{$titolo or ""}}<br>
    Conferma ordine: {{$conferma_ordine}}
</h3><br>
Cliente: {{$cliente}}<br>
Cliente finale: {{$cliente_finale}}<br>
Ubicazione Impianto: {{$ubicazione_impianto}}<br>
<br>
In carico a: {{$incaricoa}}
<br>
<h3>
    E' passato in stato {{$stato}}
</h3>
<br>
<br>

Motivo della chiamata:<br>
{{$motivo}}

<br>
<br>
Elenco Attivit&agrave;:<br>
<?php foreach($result as $row): echo $row['INSERITOIL']." - ".$row['INSERITOIL_ORA']." - ".$row['INCARICOA_ATTIVITA']." - ".trim($row['DESCRIZIONE']." - TEMPO: ".$row['TEMPO'])."<br><br>"; endforeach; ?>

<br><br>


<b>Cordiali Saluti</b><br>

<div id="footer" class="container_12">
    <img src="http://areaclienti.uniweb.it/images/Banner.png"><br>
    <strong>Uniweb Srl</strong>
    - Via Milano, 51 - 22063 Cantú (CO) - CF / P.IVA 02478160134
    <br>
    Tel. +39 031 701728 r.a. - Fax +39 031 7073755 - E-mail:
    <a href="mailto:info@uniweb.it">info@uniweb.it</a>
    <br>
    Reg. Imp. di Como n° 02478160134 - Capitale Sociale: € 15.000,00 i.v. - CCIAA Como REA n° 262922
</div>


</body>
</html>