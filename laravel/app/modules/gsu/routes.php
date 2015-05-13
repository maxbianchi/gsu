<?php

Route::group(array('module'=>'Gsu','namespace' => 'App\Modules\Gsu\Controllers'), function() {

    //MAIN e DASHBOARD
    Route::get('gsu/index', 'GsuController@index');
    Route::get('gsu/main', 'GsuController@main');
    Route::get('gsu/search', 'GsuController@search');
    Route::get('gsu/anagrafica', 'GsuController@anagrafica');

    Route::get('gsu/dashboard',function(){
        return view("gsu::test");
    });

    //DIAL-UP
    Route::get('gsu/dial-up', 'DialUpController@main');
    Route::get('gsu/dial-up/search', 'DialUpController@search');
    Route::get('gsu/dial-up/show', 'DialUpController@show');
    Route::get('gsu/dial-up/edit', 'DialUpController@edit');
    Route::post('gsu/dial-up/save', 'DialUpController@save');
    Route::get('gsu/dial-up/delete', 'DialUpController@delete');

    //ADSL
    Route::get('gsu/adsl', 'AdslController@main');
    Route::get('gsu/adsl/search', 'AdslController@search');
    Route::get('gsu/adsl/show', 'AdslController@show');
    Route::get('gsu/adsl/edit', 'AdslController@edit');
    Route::post('gsu/adsl/save', 'AdslController@save');
    Route::get('gsu/adsl/delete', 'AdslController@delete');
});