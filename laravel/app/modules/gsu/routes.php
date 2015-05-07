<?php

Route::group(array('module'=>'Gsu','namespace' => 'App\Modules\Gsu\Controllers'), function() {

    Route::get('gsu/index', 'GsuController@index');
    Route::get('gsu/main', 'GsuController@main');
    Route::get('gsu/getall', 'GsuController@getall');

    Route::get('gsu/dashboard',function(){
        return view("gsu::test");
    });
});