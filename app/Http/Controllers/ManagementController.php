<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vnas_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use View;
use Tracker;
use Carbon;
use App\Etl_process_log;
use App\UserSettings;
use Dataform;
USE Zofe\Rapyd\Demo\Article;

class ManagementController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		View::composer('*', 'App\Composers\HomeComposer');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::User()->role != 'admin') return view('home');
		$users = User::all();
		return view('admin.management' , compact('users'));
	}

	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function management_edit_user($id)
	{
		if(Auth::User()->role != 'admin') return view('home');
		$edit = User::find($id);
		return view('admin.edit',compact('edit'));
	}


	public function personal_edit_user($id)
	{

		if(Auth::User()->id != $id) return view('home');
		$edit = User::find($id);
		return view('admin.personal_edit',compact('edit'));
	}

	public function post_edit_user($id)
	{
		$update_edit = User::find($id);
		$update_edit->name = $_POST['name'];
		if(isset($_POST['role'])){$update_edit->role = $_POST['role'];};
		$update_edit->email = $_POST['email'];
		$update_edit->save();
		$_SESSION['admin_msg'] = "Updated User";
  		return Redirect('manage');

	}

	public function post_personal_edit_user($id)
	{
		$update_edit = User::find($id);
		$update_edit->name = $_POST['name'];
		if(isset($_POST['role'])){$update_edit->role = $_POST['role'];};
		$update_edit->email = $_POST['email'];
		$update_edit->save();
		return Redirect('home');
	}

	public function remove_user($id)
	{
		$remove = User::find($id);
		return view('admin.remove',compact('remove'));
	}

	public function post_remove_user($id)
	{
		$update_remove = User::find($id);
		$update_remove->delete();
		$_SESSION['admin_msg'] = "Removed User";
		return Redirect('manage');

	}
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function role(){
		return view('admin.role');
	}

	public function search_patient(Request $request){
		if(Auth::User()->role != 'admin') return view('home');

		$searchTerm = $request->input('searchTerm');

		$names = DB::table('vnas_records')->where('patient_fname', 'LIKE', '%' . $searchTerm . '%')->lists('patient_fname','patient_id');
		return $names;
	}
	
	public function search_caregiver(Request $request){
		if(Auth::User()->role != 'admin') return view('home');

		$searchTerm = $request->input('searchTerm');

		$names = DB::table('vnas_records')->where('caregiver_fname', 'LIKE', '%' . $searchTerm . '%')->lists('caregiver_fname','caregiver_id');
		return $names;
	}

	public function role_id($id){
		if(Auth::User()->role != 'admin') return view('home');
		$role_id = User::find($id);
		return view('admin.role',compact('role_id'));
}
	public function role_update($id){
		if(Auth::User()->role != 'admin') return view('home');
		$role_id = User::find($id);
		if(isset($_POST['patient_search']) != '') {$role_id->patient_role = $_POST['patient_search'];}
		if(isset($_POST['caregiver_search']) != '') {$role_id->caregiver_role = $_POST['caregiver_search'];}
		$role_id->save();
		$_SESSION['admin_msg'] = "Updated Role";
		return Redirect('manage');
	}

	public function manage_patient_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$users =  DB::select('select * from users where patient_role !=""');

		return view('admin.management' , compact('users'));
	}

	public function manage_caregiver_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$users =  DB::select('select * from users where caregiver_role !=""');

		return view('admin.management' , compact('users'));
	}

	public function manage_unassigned_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$users =  DB::select('select * from users where caregiver_role ="" AND patient_role = ""');

		return view('admin.management' , compact('users'));
	}

	public function dashboard(){
		if(Auth::User()->role != 'admin') return view('home');

		$myTmpPageViews = Tracker::pageViews( 60 * 168 );
		
		
		foreach ($myTmpPageViews as $p) {
			// code
		}
		
		/* Zach do GMTT offset here */
		$users = Tracker::users(60 * 168);
		$errors = Tracker::errors(60 * 168);

		return view('admin.dashboard' , compact('pageViews','users','errors'));
	}
	
	public function getUserSettings(){
		if(Auth::User()->role != 'admin') return view('home');
		$userSettings = UserSettings::all();
	
		return $userSettings;
	}
	
	public function editUserSettings(Request $request)
	{
		if(Auth::User()->role != 'admin') return view('home');
		
		//or find a record to update some value
		$form = \DataForm::source(UserSettings::find(1));
		
		$form->add('session_timeout_minutes','Session Timeout (in minutes):', 'text'); //field name, label, type
		$form->add('google_maps_api_key','Google Maps API Key:', 'text'); //validation
		$form->add('paypal_api_key','Paypal API Key:', 'text');
		$form->add('email_lockout_count','Number of login attempts allowed:', 'text');
		$form->add('email_lockout_duration_mins','Failed login lockout duration (mins):', 'text');
				
		$form->submit('Save');
		$form->saved(function() use ($form)
		{
			$form->message("Settings updated!");
			$form->link("/system_config","Return to user settings");
		});
		
		return view('admin.user_settings', compact('form'));
	}
	
	public function etlStats()
	{
		if(Auth::User()->role != 'admin') return view('home');
		
		$grid = \DataGrid::source(DB::table("ETL_PROCESS_LOG")->get(array('PROCESS_LOG_SKEY','START_DT','END_DT','SOURCE_RECORD_READ_CNT','SOURCE_RECORD_REJECT_CNT','TARGET_RECORD_INSERT_CNT','TARGET_RECORD_UPDATE_CNT','TARGET_RECORD_DELETE_CNT','ERROR_CNT','REC_STATUS','JOB_NM','REJECT_RSN_TXT','CREATED_BY','CREATED_DATE')));  //same source types of DataSet
		
		$grid->add('PROCESS_LOG_SKEY','ETL Process Key', true); //field name, label, sortable
		$grid->add('START_DT','Start Date', true); //field name, label, sortable
		$grid->add('END_DT','End Date', true); //field name, label, sortable
		$grid->add('SOURCE_RECORD_READ_CNT','Source Records', false); //field name, label, sortable
		$grid->add('SOURCE_RECORD_REJECT_CNT','Rejects', false); //field name, label, sortable
		$grid->add('TARGET_RECORD_INSERT_CNT','Inserts', false); //field name, label, sortable
		$grid->add('TARGET_RECORD_UPDATE_CNT','Updates', false); //field name, label, sortable
		$grid->add('TARGET_RECORD_DELETE_CNT','Deletes', false); //field name, label, sortable
		$grid->add('ERROR_CNT','Errors', true); //field name, label, sortable
		//$grid->add('REC_STATUS','Record Status', true); //field name, label, sortable
		//$grid->add('JOB_NM','Job Name', true); //field name, label, sortable
		//$grid->add('REJECT_RSN_TXT','Reject Reason', true); //field name, label, sortable
		
		
		//$grid->edit('/rapyd-demo/edit', 'Edit','show|modify');
		$grid->link('/system_etl_stats',"Execute ETL job", "TR");
		$grid->orderBy('PROCESS_LOG_SKEY','desc');
		$grid->paginate(10);
		
		$grid->row(function ($row) {
			//dd($row);
			if ($row->cell('PROCESS_LOG_SKEY')->value == 20) {
				$row->style("background-color:#CCFF66");
			} elseif ($row->cell('PROCESS_LOG_SKEY')->value > 15) {
				$row->cell('title')->style("font-weight:bold");
				$row->style("color:#f00");
			}
		});
		
	   return view('admin.etl_process_log', compact('grid'));
	}

	public function remove_patient_role($id){
return "landed on remove_patient_role function";
	}

	public function remove_caregiver_role($id){
return "landed on remove_caregiver_role funciton";
	}

	public function unlock_user($id){
		if(Auth::User()->role != 'admin') return view('home');
		$user = User::find($id);
		$user->lock_user = 'Y';
		$user->failed_attemps = 0 ;
		$user->save();
		return Redirect('manage');
	}
}
