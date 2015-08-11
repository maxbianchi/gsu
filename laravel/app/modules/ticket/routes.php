<?php

Route::group(array('module'=>'Ticket','namespace' => 'App\Modules\Ticket\Controllers'), function() {


    Route::get('/ticket/index', 'TicketController@index');
    Route::post('/ticket/pdf', 'TicketController@pdf');
    Route::get('/ticket/getuserfrommago', 'TicketController@getuserfrommago');
    Route::get('/ticket/getanagrafica', 'TicketController@getanagrafica');



});