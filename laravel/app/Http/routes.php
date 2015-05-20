<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::post('/login', 'LoginController@index');


Route::get('/logout', 'LoginController@logout');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/users', 'UserController@index');
Route::get('/adduser', 'UserController@adduser');
Route::post('/createuser', 'UserController@createuser');

Route::get('/riferimenti', 'UserController@riferimenti');
Route::get('/riferimenti/autoimport', 'UserController@autosetriferimenti');
Route::get('/riferimenti/addnew', 'UserController@riferimentiaddnew');
Route::post('/riferimenti/savenew', 'UserController@riferimentisavenew');
