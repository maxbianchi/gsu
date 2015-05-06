<?php

Route::group(array('module'=>'Gsu','namespace' => 'App\Modules\Gsu\Controllers'), function() {

    Route::get('gsu/index', 'GsuController@index');

    Route::get('gsu/dashboard',function(){
        return view("gsu::test");
    });
});