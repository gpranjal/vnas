<?php

use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Routing\Matching\CaseInsensitiveUriValidator;
use Illuminate\Routing\Matching\UriValidator;

$validators = IlluminateRoute::getValidators();
$validators[] = new CaseInsensitiveUriValidator;
IlluminateRoute::$validators = array_filter($validators, function($validator) { 
  return get_class($validator) != 'Illuminate\Routing\Matching\UriValidator';
});

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

Route::get( 'map' , 'MapController@index' );

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::match(['get', 'post'], 'manage_faq', function () {

    return \Maven::manage_view();

});

Route::match(['get', 'post'], 'faq', function () {

   return \Maven::view();

});

Route::get('vnas_records', 'VnasRecordsController@index');
Route::get('vnas_records/create', 'VnasRecordsController@create');
Route::post('vnas_records', 'VnasRecordsController@store');
Route::get('vnas_records/{id}', 'VnasRecordsController@sch');

Route::get('vnas_records/{patient_id}', 'VnasRecordsController@patientsch');



//Route::get('vnas_records/{id}', 'VnasRecordsController@caregiversch');

Route::get('vnas_users', 'VnasUsersController@index');
Route::get('vnas_users/create', 'VnasUsersController@create');
Route::post('vnas_users', 'VnasUsersController@store');
Route::get('vnas_users/{id}', 'VnasUsersController@show');

Route::get('appointments', 'AppointmentsController@index');
Route::get('appointments/create', 'AppointmentsController@create');
Route::post('appointments', 'AppointmentsController@store');
Route::get('appointments/{id}', 'AppointmentsController@show');



Route::get('/manage' , 'ManagementController@index');
Route::get('/edit/{edit_id}' , 'ManagementController@edit_user');

Route::post('/edit/{edit_user}' , 'ManagementController@post_edit_user');
