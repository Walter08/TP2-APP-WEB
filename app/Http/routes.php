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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/comunicados', function () {
    return view('comunicados.index');
});
Route::auth();
Route::resource('mail', 'MailController');
Route::get('/home', 'HomeController@index');
Route::get('/invitaciones', 'TemplateController@invitaciones');
Route::get('/reclamos', 'TemplateController@reclamos');
Route::get('/solicitudes', 'TemplateController@solicitudes');
Route::get('/felicitaciones', 'TemplateController@felicitaciones');
Route::resource('template', 'TemplateController');
Route::post('template/{id}', 'TemplateController@store');
Route::post('template/{id}/pdf', 'TemplateController@generaPDF');
//Route::any('template/{id}', 'TemplateController@getTemplate')->where(['id' => '[0-9]+']);