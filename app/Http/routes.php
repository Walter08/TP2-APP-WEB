<?php
use Illuminate\Foundation\Inspiring;
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
	$quote = Inspiring::quote();
    return view('welcome', ['quote' => $quote]);
});
Route::auth();
Route::resource('mail', 'MailController');
Route::get('/home', 'HomeController@index');
Route::get('/invitaciones', 'TemplateController@invitaciones');
Route::get('/reclamos', 'TemplateController@reclamos');
Route::get('/solicitudes', 'TemplateController@solicitudes');
Route::get('/felicitaciones', 'TemplateController@felicitaciones');
//Route::resource('template', 'TemplateController');
//Route::post('template/{id}', 'TemplateController@store');
//Route::post('template/{id}/pdf', 'TemplateController@generaPDF');
//Route::post('/enviarpdf', 'MailController@store');
Route::get('/sugerencias', 'TemplateController@index');
//Route::any('template/{id}', 'TemplateController@getTemplate')->where(['id' => '[0-9]+']);

Route::match(['get', 'post'], '/template/{id}', 'TemplateController@getTemplate')->where(['id' => '[0-9]+']);
Route::post('/enviarpdf/', 'MailController@store');
Route::post('/guardarpdf/', 'TemplateController@store');
Route::get('/misNotas', 'TemplateController@getNotas');
Route::get('/misNotas/{id}', 'TemplateController@imprimirPDF')->where(['id' => '[0-9]+']);

Route::post('/reenviarpdf/', 'MailController@reenviar');