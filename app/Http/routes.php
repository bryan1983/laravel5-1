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

Route::get('admin/news/{id}', 'AdminNewsController@details');

/*
Route::get('admin/news/{id}', function($id)
{
	return $id;
}); //-->where('id', '\d+');
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'users'		=> 'UsersController',
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);

Route::get('contactos', function(){
	return "Contactos!!!";
});

/// Ruta a una vista
/*Route::get('example', function(){

	$user = "Abraham";

	return view('examples.template', compact('user'));
});*/

// Creamos una ruta para el módulo de usuarios
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function(){

	Route::resource('users', 'UsersController');

});

Route::get('login', 'WelcomeController@index');

Route::get('{slugUrl}', function($slugUrl){
	return 'Post: ' . $slugUrl;
});

