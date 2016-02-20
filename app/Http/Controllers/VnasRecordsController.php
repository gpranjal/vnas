<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use App\Vnas_record;
use Request;
class VnasRecordsController extends Controller {

	//

    public function index()
    {
        $Vnas_records = Vnas_record::all();

        return view('Vnas_records.index', compact('Vnas_records'));
    }

    public function patientsch($patient_id)
    {
        $Vnas_record = Vnas_record::findOrFail($patient_id);

        return view('Vnas_records.patientsch', compact('Vnas_records'));

    }

    public function caregiversch($id)
    {
        $Vnas_record = Vnas_record::findOrFail($patient_id);

        return view('Vnas_records.caregiversch', compact('Vnas_records'));

    }


    public function create()
    {
        return view('Vnas_records.create');

    }

    public function store()
    {
        $input = Request::all();
        Vnas_record::create($input);

        return redirect('Vnas_records');

    }
}
