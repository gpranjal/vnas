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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth' , 'timeout']], function()
{

	Route::get('home', 'HomeController@index');

	Route::get( 'map' , 'MapController@index' );
	Route::get('/map' , 'MapController@index');
	Route::get('/map/{addr}' , 'MapController@show');

	Route::match(['get', 'post'], 'manage_faq', function () {

	    return \Maven::manage_view();

	});

	Route::match(['get', 'post'], 'faq', function () {

	   return \Maven::view();

	});

	Route::match(['get', 'post'], 'faq/search', function () {
		$keyword = Input::get('keyword', '');
	   return \Maven::search($keyword);

	});


	Route::get('vnas_records', 'VnasRecordsController@index');
	Route::get('vnas_records/create', 'VnasRecordsController@create');
	// Route::match(['get', 'post'], 'vnas_records/role', function () {
	// 	$myRole = Input::get('myRole', '');
	// 	return 'VnasRecordsController@index';
	//Route::post('vnas_records/role/{multiroleFilter}', 'VnasRecordsController@index');
	// });
	// Route::match(['get', 'post'], '/vnas_records/role', function()
	// {
	//      	$myRole = Input::get('multiroleFilter', '');
	// 	 	return VnasRecordsController::index($myRole);
	// });
	Route::post('vnas_records/role/{myRole}', 'VnasRecordsController@index');

	Route::get('vnas_records/caregiver/{id}', 'VnasRecordsController@sch');
	Route::get('vnas_records/patient/{id}', 'VnasRecordsController@patientsch');
	Route::get('vnas_records/multi/{id}', 'VnasRecordsController@multirolesch');
	Route::get('/testmail' , 'VnasRecordsController@testmail');


	Route::get('vnas_users', 'VnasUsersController@index');
	Route::get('vnas_users/create', 'VnasUsersController@create');
	Route::post('vnas_users', 'VnasUsersController@store');
	Route::get('vnas_users/{id}', 'VnasUsersController@show');

	Route::get('/manage' , 'ManagementController@index');
	Route::get('/manage/patient' , 'ManagementController@manage_patient_view');
	Route::get('/manage/caregiver' , 'ManagementController@manage_caregiver_view');
	Route::get('/manage/unassigned' , 'ManagementController@manage_unassigned_view');
	Route::get('/edit/{edit_id}' , 'ManagementController@edit_user');

	Route::get('/personal_edit/{edit_id}' , 'ManagementController@personal_edit_user');
	Route::post('/edit/{edit_user}' , 'ManagementController@post_edit_user');
	Route::get('/remove/{remove_id}' , 'ManagementController@remove_user');
	Route::post('/remove/{remove_id}' , 'ManagementController@post_remove_user');
	Route::get('/management_edit/{edit_id}' , 'ManagementController@management_edit_user');

	Route::get('/role' , 'ManagementController@role');
	Route::get('/role/{id}' , 'ManagementController@role_id');
	Route::post('/role_update/{role_id}' , 'ManagementController@role_update');
	Route::get('/search_patient' , 'ManagementController@search_patient');
	Route::get('/search_caregiver' , 'ManagementController@search_caregiver');

	Route::get('/admin' , 'ManagementController@dashboard');

});