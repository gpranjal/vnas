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
		return view('admin.edit',compact('edit'));
	}

	public function post_edit_user($id)
	{
		$update_edit = User::find($id);
		$update_edit->name = $_POST['name'];
		$update_edit->role = $_POST['role'];
		$update_edit->email = $_POST['email'];
		$update_edit->save();
  		return Redirect('manage');

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

	public function search_patient(){
		$names = DB::table('vnas_records')->lists('patient_fname','patient_id');
		return $names;


	}
	public function search_caregiver(){
		$names = DB::table('vnas_records')->lists('patient_fname','caregiver_id');
		return $names;


	}

	public function role_id($id){
		if(Auth::User()->role != 'admin') return view('home');
		$role_id = User::find($id);
		return view('admin.role',compact('role_id'));
}
	public function role_update($id){

		$role_id = User::find($id);
		$role_id->patient_role = $_POST['patient_search'];
		$role_id->caregiver_role = $_POST['caregiver_search'];
		$role_id->save();
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
}
