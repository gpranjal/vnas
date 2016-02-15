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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::match(['get', 'post'], 'faq', function () {

    return \Maven::manage_view();

});

Route::get('vnas_users', 'VnasUsersController@index');
Route::get('vnas_users/create', 'VnasUsersController@create');
Route::post('vnas_users', 'VnasUsersController@store');
Route::get('vnas_users/{id}', 'VnasUsersController@show');

