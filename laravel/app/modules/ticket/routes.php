<?php

Route::group(array('module'=>'Ticket','namespace' => 'App\Modules\Ticket\Controllers'), function() {

    //AJAX
    Route::get('/ticket/getclienti', 'AttivitaController@getclienti');

    Route::get('/ticket/index', 'TicketController@index');
    Route::post('/ticket/pdf', 'TicketController@pdf');
    Route::get('/ticket/getuserfrommago', 'TicketController@getuserfrommago');
    Route::get('/ticket/getanagrafica', 'TicketController@getanagrafica');
    Route::post('/ticket/chiuditicket', 'TicketController@chiuditicket');
    Route::post('/ticket/salvaverbalino', 'TicketController@salvaverbalino');
    Route::get('/ticket/alltickets', 'TicketController@alltickets');

    //Attivita
    Route::get('/ticket/creaattivita', 'AttivitaController@creaattivita');
    Route::get('/ticket/tickets', 'AttivitaController@tickets');
    Route::post('/ticket/getEmailCliente', 'AttivitaController@getemailcliente');
    Route::post('/ticket/salvaattivita', 'AttivitaController@salvaattivita');
    Route::get('/ticket/eliminaattivita', 'AttivitaController@eliminaattivita');
    Route::post('/ticket/salvaticket', 'AttivitaController@salvaticket');
    Route::post('/ticket/cambiastato', 'AttivitaController@cambiastato');
    Route::post('/ticket/mailaperturaticket', 'AttivitaController@mailaperturaticket');
    Route::get('/ticket/sollecitoticket', 'AttivitaController@sollecitoticket');
    Route::get('/ticket/modificaattivita', 'AttivitaController@modificaattivita');
    Route::get('/ticket/getsingleuser', 'AttivitaController@getsingleuser');
    Route::post('/ticket/getCategorie', 'AttivitaController@getcategorie');
    Route::get('/ticket/checkBlocked', 'AttivitaController@checkBlocked');
    Route::get('/ticket/getTipologiaContratto', 'AttivitaController@gettipologiacontratto');

    //Cliente
    Route::get('/ticket/clientticket', 'ClientController@getalltickets');
    Route::get('/ticket/storico', 'ClientController@getstorico');
    Route::get('/ticket/nuovo', 'ClientController@apriticket');
    Route::post('/ticket/salvanuovo', 'ClientController@salvaticket');
    Route::post('/ticket/getdatacliente', 'ClientController@getdatacliente');
    Route::get('/ticket/sollecitoticketcliente', 'ClientController@sollecitoticket');
    Route::get('/ticket/elaborato', 'ClientController@elaborato');
    Route::get('/ticket/getCarnetDisponibili', 'ClientController@getCarnetDisponibili');
    Route::get('/ticket/getTicketDisponibili', 'ClientController@getTicketDisponibili');
});