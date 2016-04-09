<?php namespace App\Http\Controllers;

use View;
use App\UserSettings;
use App\Vnas_record;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		View::composer('*', 'App\Composers\HomeComposer');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$myMessage 	= null;
		
		$Vnas_records = Vnas_record::getChangedScheduleRecords();
		
		if( count( $Vnas_records ) > 0 )
		{
			$myMessage = UserSettings::getSchChgMsg();
		}
		
		return view('home' , ['donateAPIKey' => UserSettings::getDonateAPIKey()] , compact( 'myMessage' ));
	}

}
