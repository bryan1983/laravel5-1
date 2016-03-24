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

Route::pattern('id', '\d+');
/*
Route::get('admin/news/{id}', function($id)
{
	return $id;
}); //-->where('id', '\d+');
*/

/* Controladores para los Tickets */
Route::get('/', [
	'as' 	=> 'tickets.latest',
	'uses' 	=> 'TicketsController@latest'
]);

Route::get('/populares', [
	'as' 	=> 'tickets.popular',
	'uses'	=> 'TicketsController@popular'
]);

Route::get('/pendientes', [
	'as' 	=> 'tickets.open',
	'uses'	=> 'TicketsController@open'
]);

Route::get('/tutoriales', [
	'as'	=> 'tickets.closed',
	'uses'	=> 'TicketsController@closed'
]);

Route::get('/solicitud/{id}', [
	'as'	=> 'tickets.details',
	'uses'	=> 'TicketsController@details'
]);
/* Tickets */

Route::get('home', 'HomeController@index');

Route::get('admin/news/{id}', 'AdminNewsController@details');

Route::controllers([
	'users'		=> 'UsersController',
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);

Route::get('contactos', function(){
	return "Contactos!!!";
});

// Creamos una ruta para el módulo de usuarios
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function(){
	Route::resource('users', 'UsersController');
});