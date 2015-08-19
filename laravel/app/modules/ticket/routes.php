<?php

Route::group(array('module'=>'Ticket','namespace' => 'App\Modules\Ticket\Controllers'), function() {


    Route::get('/ticket/index', 'TicketController@index');
    Route::post('/ticket/pdf', 'TicketController@pdf');
    Route::get('/ticket/getuserfrommago', 'TicketController@getuserfrommago');
    Route::get('/ticket/getanagrafica', 'TicketController@getanagrafica');
    Route::post('/ticket/cambiastato', 'TicketController@cambiastato');
    Route::post('/ticket/chiuditicket', 'TicketController@chiuditicket');

    //Attivita
    Route::get('/ticket/creaattivita', 'AttivitaController@creaattivita');
    Route::get('/ticket/tickets', 'AttivitaController@tickets');
    Route::post('/ticket/getEmailCliente', 'AttivitaController@getemailcliente');
    Route::post('/ticket/salvaattivita', 'AttivitaController@salvaattivita');
    Route::post('/ticket/salvaticket', 'AttivitaController@salvaticket');
    Route::post('/ticket/mailaperturaticket', 'AttivitaController@mailaperturaticket');

});