<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>

<h3>Buongiorno {{$cliente}},<br>
    con la presente vi informiamo che il ticket id: {{$idattivita}}<br>
    Titolo: {{$titolo or ""}}<br>
    Conferma ordine: {{$conferma_ordine}}<br>
    Cliente finale: {{$cliente_finale}}<br>
    Ubicazione: {{$ubicazione_impianto}}
</h3><br>
<br>
Motivo della chiamata:<br>
{{$motivo}}
<br>
<h3>
    E' passato in stato {{$stato}}
</h3><br>
<br><br>


<b>Cordiali Saluti</b><br>

<div id="footer" class="container_12">
    <img src="http://areaclienti.uniweb.it/images/logo_email.png"><br>
    <strong>Uniweb Srl</strong>
    Cantú (CO) - 22063 - Via Milano, 51 - CF / P.IVA 02478160134
    <br>
    Tel. +39 031 701728 r.a. - Fax +39 031 7073755 - E-mail:
    <a href="mailto:info@uniweb.it">info@uniweb.it</a> Pec: info@pec.uniweb.it
    <br>
    Reg. Imp. di Como n° 02478160134 - Capitale Sociale: € 15.000,00 i.v. - CCIAA Como REA n° 262922
</div>


</body>
</html>