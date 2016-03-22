<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserSettings;
use Illuminate\Http\Request;
use View;

class MapController extends Controller {

	public function __construct()
    {
        //$this->vnas_records = Vnas_record::all();
//        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('map.map' , ['mapsAPIKey' => UserSettings::getMapsAPIKey()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
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
	 * @param  string  $addr
	 * @return Response
	 */
	public function show($addr)
	{
		//$myaddr = $addr;
		//return view('map.map' , ['addr' => $addr]);//AIzaSyDmiNBfyHfzHnDS5u_I7Luhr0M_BkwxVDc
		 return view('map.map', ['addr' => $addr , 'mapsAPIKey' => UserSettings::getMapsAPIKey()]);
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

}
