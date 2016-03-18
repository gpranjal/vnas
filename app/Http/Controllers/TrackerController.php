<?php namespace App\Http\Controllers;

// require_once base_path('vendor/PragmaRX\Tracker\src\Tracker.php');
// use PragmaRX\Tracker\src\Tracker as Tracker;

use Tracker;
use GeoIp2;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use GeoIp2\Database\Reader;

class TrackerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


		$visitor = Tracker::currentSession();

		return view( 'tracker.test' , compact('visitor'));
		
		

	
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

}
