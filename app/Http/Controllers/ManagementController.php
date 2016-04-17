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
use Illuminate\Mail\Message;

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
  		return Redirect('mnge');

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
		return Redirect('mnge');

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

		$names = DB::table('VNAS_USER_INFO')->where('FULL_NME', 'LIKE', '%' . $searchTerm . '%')->where('VNA_USER_TYPE','=','client')->lists('FULL_NME','VNA_USER_ID');
		return $names;
	}
	
	public function search_caregiver(Request $request){
		if(Auth::User()->role != 'admin') return view('home');

		$searchTerm = $request->input('searchTerm');

		$names = DB::table('VNAS_USER_INFO')->where('FULL_NME', 'LIKE', '%' . $searchTerm . '%')->where('VNA_USER_TYPE','=','caregiver')->lists('FULL_NME','VNA_USER_ID');
		return $names;
	}

	public function role_id($id){
		if(Auth::User()->role != 'admin') return view('home');
		$role_id = User::find($id);
		$idds= DB::table('VNAS_VNA_USER_REL')->where('USER_SK',$role_id->id)->lists('VNA_USER_ID') ;
//		return $idds;
		$client ='';
		$caregiver ='';
		foreach($idds as $idd){
			$variable = DB::table('VNAS_USER_INFO')->where('VNA_USER_ID', $idd)->pluck('VNA_USER_TYPE');
			if($variable == 'CLIENT'){
				if($client != ''){
					$client .=  ', '. $idd ;
				}else{
					$client = $idd;
				}

			}else{
				if($caregiver != ''){
					$caregiver .= ', '. $idd;
				}else{
					$caregiver = $idd;
				}
			}
		}
		$role_array = array(
			'name'=> $role_id->name,
			'id'=>$role_id->id,
			'client'=>$client,
			'caregiver'=>$caregiver
		);
//		return $role_array;
		return View::make('admin.role')->with('role_array', $role_array);

}
	public function role_update($id)
	{
		if (Auth::User()->role != 'admin') return view('home');
		if ($_POST['patient_search'] != '') {
			$outputs_patients = explode(',', $_POST['patient_search']);

			foreach ($outputs_patients as $output_patient) {
//                DB::table('VNAS_VNA_USER_REL')->whereIn('VNA_USER_ID', $outputs_patients)->update(['USER_SK' => $id]);
				DB::select('update VNAS_VNA_USER_REL set USER_SK=' . $id . ' where VNA_USER_ID=' . $output_patient);
			}
		}
		if ($_POST['caregiver_search'] != '') {
			$outputs_caregivers = explode(',', $_POST['caregiver_search']);
			foreach ($outputs_caregivers as $output_caregiver) {
				DB::select('update VNAS_VNA_USER_REL set USER_SK=' . $id . ' where VNA_USER_ID=' . $output_caregiver);
			}
		}
		$_SESSION['admin_msg'] = "Updated Role";
		return Redirect('mnge');
	}

	public function manage_patient_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$calculators = DB::table('VNAS_VNA_USER_REL')->where('VNA_USER_ROLE_CD','2')->where('USER_SK','!=','NULL')->lists('USER_SK');
//		$calculators = DB::select('select USER_SK from VNAS_VNA_USER_REL where VNA_USER_ROLE_CD =\'2\' AND USER_SK IS NOT NULL');

		$variable = '';
		foreach($calculators as $calculator){
//			return $calculator;
			if($variable != ''){
				$variable = $variable. ', '.$calculator;
			}else{
				$variable = $calculator;
			}
		}
		if($variable == ''){
			$variable = '0';
		}
//		return $variable;
		$users =  DB::select('select * from users where id IN ('.$variable.')');
//return $users;
		return view('admin.management' , compact('users'));
	}

	public function manage_caregiver_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$calculators = DB::table('VNAS_VNA_USER_REL')->where('VNA_USER_ROLE_CD','1')->where('USER_SK','!=','NULL')->lists('USER_SK');
//		$calculators = DB::select('select USER_SK from VNAS_VNA_USER_REL where VNA_USER_ROLE_CD =\'2\' AND USER_SK IS NOT NULL');

		$variable = '';
		foreach($calculators as $calculator){
//			return $calculator;
			if($variable != ''){
				$variable = $variable. ', '.$calculator;
			}else{
				$variable = $calculator;
			}
		}
		if($variable == ''){
			$variable = '0';
		}
//		return $variable;
		$users =  DB::select('select * from users where id IN ('.$variable.')');
//return $users;
		return view('admin.management' , compact('users'));
	}

	public function manage_unassigned_view(){
		if(Auth::User()->role != 'admin') return view('home');
		$user_table = DB::table('users')->lists('id');
		$verifys = DB::table('VNAS_VNA_USER_REL')->where('USER_SK','!=','NULL')->distinct()->lists('USER_SK');

		$calculators = array_diff($user_table, $verifys);
		$variable = '';
		foreach($calculators as $calculator){
			if($variable != ''){
				$variable = $variable.', '.$calculator;
			}else{
				$variable = $calculator;
			}
		}
		if($variable == ''){
			$variable = '0';
		}

		$users =  DB::select('select * from users where id IN ('.$variable.')');


		return view('admin.management' , compact('users'));
	}

	public function dashboard(){
		if(Auth::User()->role != 'admin') return view('home');

		$pageViews = Tracker::pageViews( 60 * 168 );
		
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
		$form->add('my_acct_no_rcrd_msg','No Records - My Account Message:', 'text');
		$form->add('sch_no_rcrd_msg','No Records - My Schedule Message:', 'text');
		$form->add('sch_chg_msg','Schedule Change - Home Screen Message:', 'text');
				
		$form->submit('Save');
		$form->saved(function() use ($form)
		{
			$form->message("Settings updated!");
			$form->link("/system_config","Return to user settings");
		});
		
		return view('admin.user_settings', compact('form'));
	}
	
	public function etlStats($myBit = null)
	{
		if(Auth::User()->role != 'admin') return view('home');
		
		$myMessage = null;
		$myError = null;
		
		//$grid = \DataGrid::source(DB::table("ETL_PROCESS_LOG")->get(array('PROCESS_LOG_SKEY','LANDING_TBL_REC_CNT','LANDING_TBL_DATE_RANGE','cHANGED_CALENDAR_CNT','ETL_PROCESS_STATUS','ERROR_CNT','ERROR_DESC')))->take(500);  //same source types of DataSet
		$grid = \DataGrid::source
		(
			DB::table("ETL_PROCESS_LOG")
				->select('PROCESS_LOG_SKEY','LANDING_TBL_REC_CNT','LANDING_TBL_DATE_RANGE','cHANGED_CALENDAR_CNT','ETL_PROCESS_STATUS','ERROR_CNT','ERROR_DESC')
				->orderBy('CREATED_DATE','desc')
				->take(200)
		);
		
		$grid->add('PROCESS_LOG_SKEY','ETL Process Key', true); //field name, label, sortable
		$grid->add('LANDING_TBL_REC_CNT','Record Count', true); //field name, label, sortable		
		$grid->add('LANDING_TBL_DATE_RANGE','Date Range', false); //field name, label, sortable
		$grid->add('cHANGED_CALENDAR_CNT','Calendar Notications', false); //field name, label, sortable
		$grid->add('ETL_PROCESS_STATUS','ETL Process Status', false); //field name, label, sortable
		$grid->add('ERROR_CNT','Number of Errors', false); //field name, label, sortable
		$grid->add('ERROR_DESC','Error(s) Description', false); //field name, label, sortable
		
		
		
		//$grid->edit('/rapyd-demo/edit', 'Edit','show|modify');
		$grid->link('/etl/fire',"Execute ETL job", "TR");
		$grid->orderBy('PROCESS_LOG_SKEY','desc');
		$grid->paginate(10);
		
		$grid->row(function ($row) {
			//dd($row);
// 			if ($row->cell('PROCESS_LOG_SKEY')->value == 20) {
// 				$row->style("background-color:#CCFF66");
// 			} elseif ($row->cell('PROCESS_LOG_SKEY')->value > 15) {
// 				$row->cell('title')->style("font-weight:bold");
// 				$row->style("color:#f00");
// 			}
		});
		
		if( $myBit == 1 )
		{
			$myMessage = "ETL successfully started.";
		}
		else if( $myBit == -1 )
		{
			$myError = "There was issue starting the ETL.";
		}
	   
	   return view('admin.etl_process_log', compact('grid','myMessage','myError'));
	}

	public function remove_patient_role($id){

		$querys = DB::table('VNAS_VNA_USER_REL')->where('USER_SK',$id)->lists('VNA_USER_ID');

		foreach($querys as $query){
			$variable = DB::table('VNAS_USER_INFO')->where('VNA_USER_ID', $query)->pluck('VNA_USER_TYPE');
			if($variable == 'CLIENT'){
				DB::table('VNAS_VNA_USER_REL')->where('VNA_USER_ID', $query)->update(['USER_SK'=> Null]);
			}
		}

		$_SESSION['role_msg']= "Patient role have been removed";
		return Redirect('/role/'.$id);
	}

	public function remove_caregiver_role($id){

		$querys = DB::table('VNAS_VNA_USER_REL')->where('USER_SK',$id)->lists('VNA_USER_ID');

		foreach($querys as $query){
			$variable = DB::table('VNAS_USER_INFO')->where('VNA_USER_ID', $query)->pluck('VNA_USER_TYPE');
			if($variable == 'CAREGIVER'){
				DB::table('VNAS_VNA_USER_REL')->where('VNA_USER_ID', $query)->update(['USER_SK'=> Null]);
			}
		}

		$_SESSION['role_msg']= "Caregiver role has been removed";
		return Redirect('/role/'.$id);
	}

	public function unlock_user($id){
		if(Auth::User()->role != 'admin') return view('home');
		$user = User::find($id);
		$user->lock_user = 'Y';
		$user->failed_attemps = 0 ;
		$user->save();
		return Redirect('mnge');
	}
}
