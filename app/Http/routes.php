<?php

use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Routing\Matching\CaseInsensitiveUriValidator;
use Illuminate\Routing\Matching\UriValidator;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\VnasETLCommand;
use Illuminate\Console\Command;


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

Route::match(['get', 'post'], 'faq', function () {

   return \Maven::view();

});

Route::match(['get', 'post'], 'faq/search', function () {
	$keyword = Input::get('keyword', '');
   return \Maven::search($keyword);

});


Route::get('testgeoip', 'TrackerController@index');

Route::group(['middleware' => ['auth' , 'timeout']], function()
{

	Route::get('home', 'HomeController@index');

	Route::get( 'map' , 'MapController@index' );
	Route::get('/map' , 'MapController@index');
	Route::get('/map/{addr}' , 'MapController@show');

	Route::match(['get', 'post'], 'faq_mnge', function () {
	    return \Maven::manage_view();
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

	Route::post('vnas_records/role/{myRole}/{myRangeValue}', 'VnasRecordsController@index');
	Route::post('vnas_records/filter/{myRole}/{myRangeValue}', 'VnasRecordsController@index');

	Route::get('vnas_records/caregiver/{id}', 'VnasRecordsController@sch');
	Route::get('vnas_records/patient/{id}', 'VnasRecordsController@patientsch');
	Route::get('vnas_records/multi/{id}', 'VnasRecordsController@multirolesch');
	Route::get('/testmail' , 'VnasRecordsController@testmail');
	Route::get('vnas_users', 'VnasUsersController@index');
	Route::get('vnas_users/create', 'VnasUsersController@create');
	Route::post('vnas_users', 'VnasUsersController@store');
	Route::get('vnas_users/{id}', 'VnasUsersController@show');

	Route::get('/mnge' , 'ManagementController@index');
	// The following route is created to fix a selected branding issue in the admin panel
	// When selected on the admin panel, the admin panel was changing branding based on the route
	// This would ultimately change the branding of the dropdown menu.
	Route::get('/menu/mnge' , 'ManagementController@index');
	Route::get('/mnge/patient' , 'ManagementController@manage_patient_view');
	Route::get('/mnge/caregiver' , 'ManagementController@manage_caregiver_view');
	Route::get('/mnge/unassigned' , 'ManagementController@manage_unassigned_view');
	Route::get('/edit/{edit_id}' , 'ManagementController@edit_user');

	Route::get('/personal_edit/{edit_id}' , 'ManagementController@personal_edit_user');
	Route::post('/edit/{edit_user}' , 'ManagementController@post_edit_user');
	Route::post('/post_personal_edit/{edit_user}' , 'ManagementController@post_personal_edit_user');
	Route::get('/remove/{remove_id}' , 'ManagementController@remove_user');
	Route::post('/remove/{remove_id}' , 'ManagementController@post_remove_user');
	Route::get('/mnge_edit/{edit_id}' , 'ManagementController@management_edit_user');
	Route::get('/role' , 'ManagementController@role');
	Route::get('/role/{id}' , 'ManagementController@role_id');
	Route::post('/role_update/{role_id}' , 'ManagementController@role_update');
	Route::get('/search_patient' , 'ManagementController@search_patient');
	Route::get('/search_caregiver' , 'ManagementController@search_caregiver');
	Route::get('/system_config' , 'ManagementController@editUserSettings');
	Route::post('/system_config' , 'ManagementController@editUserSettings');
	Route::get('/system_etl_stats' , 'ManagementController@etlStats' );
	Route::get('/system_etl_stats/{bit}' , 'ManagementController@etlStats' );

	Route::get('/admin' , 'ManagementController@dashboard');
	Route::get('/admin/settings' , 'ManagementController@getUserSettings');

	Route::get('/remove/patient_role/{id}', 'ManagementController@remove_patient_role');
	Route::get('/remove/caregiver_role/{id}', 'ManagementController@remove_caregiver_role');
	Route::get('/unlock_user/{id}','ManagementController@unlock_user');
	
	Route::get('etl/fire', 'ManagementController@etlfire');
});