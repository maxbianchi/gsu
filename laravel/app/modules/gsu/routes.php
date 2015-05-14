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

    //DIRECT ACCESS
    Route::get('gsu/direct-access', 'DirectAccessController@main');
    Route::get('gsu/direct-access/search', 'DirectAccessController@search');
    Route::get('gsu/direct-access/show', 'DirectAccessController@show');
    Route::get('gsu/direct-access/edit', 'DirectAccessController@edit');
    Route::post('gsu/direct-access/save', 'DirectAccessController@save');
    Route::get('gsu/direct-access/delete', 'DirectAccessController@delete');

    //LINEA AGGIUNTIVA
    Route::get('gsu/linea-aggiuntiva', 'LineaAggiuntivaController@main');
    Route::get('gsu/linea-aggiuntiva/search', 'LineaAggiuntivaController@search');
    Route::get('gsu/linea-aggiuntiva/show', 'LineaAggiuntivaController@show');
    Route::get('gsu/linea-aggiuntiva/edit', 'LineaAggiuntivaController@edit');
    Route::post('gsu/linea-aggiuntiva/save', 'LineaAggiuntivaController@save');
    Route::get('gsu/linea-aggiuntiva/delete', 'LineaAggiuntivaController@delete');

    //MPLS
    Route::get('gsu/mpls', 'MplsController@main');
    Route::get('gsu/mpls/search', 'MplsController@search');
    Route::get('gsu/mpls/show', 'MplsController@show');
    Route::get('gsu/mpls/edit', 'MplsController@edit');
    Route::post('gsu/mpls/save', 'MplsController@save');
    Route::get('gsu/mpls/delete', 'MplsController@delete');

    //MPLS DIRECT ACCESS
    Route::get('gsu/mpls-direct-access', 'MplsDirectAccessController@main');
    Route::get('gsu/mpls-direct-access/search', 'MplsDirectAccessController@search');
    Route::get('gsu/mpls-direct-access/show', 'MplsDirectAccessController@show');
    Route::get('gsu/mpls-direct-access/edit', 'MplsDirectAccessController@edit');
    Route::post('gsu/mpls-direct-access/save', 'MplsDirectAccessController@save');
    Route::get('gsu/mpls-direct-access/delete', 'MplsDirectAccessController@delete');

    //DOMINI
    Route::get('gsu/domini', 'DominiController@main');
    Route::get('gsu/domini/search', 'DominiController@search');
    Route::get('gsu/domini/show', 'DominiController@show');
    Route::get('gsu/domini/edit', 'DominiController@edit');
    Route::post('gsu/domini/save', 'DominiController@save');
    Route::get('gsu/domini/delete', 'DominiController@delete');

    //HOSTING
    Route::get('gsu/hosting', 'HostingController@main');
    Route::get('gsu/hosting/search', 'HostingController@search');
    Route::get('gsu/hosting/show', 'HostingController@show');
    Route::get('gsu/hosting/edit', 'HostingController@edit');
    Route::post('gsu/hosting/save', 'HostingController@save');
    Route::get('gsu/hosting/delete', 'HostingController@delete');
});