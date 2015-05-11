    <div class="container-fluid">
        <div class="border">
        <table class="tbl_clienti">
            <thead>
                <tr>
                    <td style="width:11%;"></td>
                    <td style="width:7%;">CODICE</td>
                    <td style="width:25%;">DESCRIZIONE</td>
                    <td style="width:25%;">INDIRIZZO</td>
                    <td style="width:4%;">CAP</td>
                    <td style="width:8%;">LOCALITA'</td>
                    <td style="width:6%;">PROVINCIA</td>
                    <td style="width:10%;">TELEFONO</td>
                    <td style="width:14%;">PIVA</td>
                </tr>
            </thead>
            <tbody>
                <tr class="soggetto">
                    <td>CLIENTE</td>
                    <td>{{$request['SOGGETTO_CODICE'] or ""}}</td>
                    <td>{{$request['SOGGETTO'] or ""}}</td>
                    <td>{{$request['SOGGETTO_INDIRIZZO'] or ""}}</td>
                    <td>{{$request['SOGGETTO_CAP'] or ""}}</td>
                    <td>{{$request['SOGGETTO_LOCALITA'] or ""}}</td>
                    <td>{{$request['SOGGETTO_PROVINCIA'] or ""}}</td>
                    <td>{{$request['SOGGETTO_TELEFONO'] or ""}}</td>
                    <td>{{$request['SOGGETTO_PIVA'] or ""}}</td>
                </tr>
                <tr class="cliente">
                    <td>CLIENTE FINALE</td>
                    <td>{{$request['CLIENTE_CODICE'] or ""}}</td>
                    <td>{{$request['CLIENTE'] or ""}}</td>
                    <td>{{$request['CLIENTE_INDIRIZZO'] or ""}}</td>
                    <td>{{$request['CLIENTE_CAP'] or ""}}</td>
                    <td>{{$request['CLIENTE_LOCALITA'] or ""}}</td>
                    <td>{{$request['CLIENTE_PROVINCIA'] or ""}}</td>
                    <td>{{$request['CLIENTE_TELEFONO'] or ""}}</td>
                    <td>{{$request['CLIENTE_PIVA'] or ""}}</td>
                </tr>
                <tr class="destinatarioabituale">
                    <td>UBICAZIONE IMPIANTO</td>
                    <td>{{$request['DESTINATARIOABITUALE_CODICE'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_INDIRIZZO'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_CAP'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_LOCALITA'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_PROVINCIA'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_TELEFONO'] or ""}}</td>
                    <td>{{$request['DESTINATARIOABITUALE_PIVA'] or ""}}</td>
                </tr>
            </tbody>
        </table>

        </div>
    </div>
