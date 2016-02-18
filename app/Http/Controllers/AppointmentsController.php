<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\appointment;
use Request;
class AppointmentsController extends Controller {

	//

    public function index()
    {
        $appointments = appointment::all();

        return view('appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = appointment::findOrFail($id);

        return view('appointments.show', compact('appointments'));

    }

    public function create()
    {
        return view('appointments.create');

    }

    public function store()
    {
        $input = Request::all();

        appointment::create($input);

        return redirect('appointments');

    }
}
