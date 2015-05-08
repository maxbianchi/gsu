<?php

Route::group(array('module'=>'Gsu','namespace' => 'App\Modules\Gsu\Controllers'), function() {

    Route::get('gsu/index', 'GsuController@index');
    Route::get('gsu/main', 'GsuController@main');
    Route::get('gsu/search', 'GsuController@search');

    Route::get('gsu/dashboard',function(){
        return view("gsu::test");
    });

    Route::get('gsu/dial-up', 'DialUpController@main');
    Route::get('gsu/dial-up/search', 'DialUpController@search');
    Route::get('gsu/dial-up/show', 'DialUpController@show');


});