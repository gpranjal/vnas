<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use App\Vnas_record;
use Request;
use DB;
use View;
use Auth;

class VnasRecordsController extends Controller {

	//
    var $vnas_records;

    public function __construct()
    {
        $this->vnas_records = Vnas_record::all();
        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }

    public function index()
    {
        // Check to see if the user is logged in
        if( Auth::check() )
        {
            $myCurrUserEmail = Auth::user()->email; 

            //If admin here, go ahead and show the list of patients

            //if not show only the currently logged in patient
            $Vnas_records = Vnas_record::where( 'patient_email' , '=' , $myCurrUserEmail )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname'));

            return view('Vnas_records.index', compact('Vnas_records'));
        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }


    /* You are working here */
    public function sch($id)

    {
//        $Vnas_record = Vnas_record::findOrFail($id);
//        return view('Vnas_records.sch', compact('Vnas_records'));


        //return Vnas_record::where( 'patient_id' , '=' , $patient_id )->get( array('id','ap_title','ap_date','ap_time','ap_lov','caregiver_fname'));
        $Vnas_records = vnas_record::where( 'id' , '=' , $id )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname'));
        return view('vnas_records.sch', compact('Vnas_records'));

    }

    /*
    public function caregiversch($caregiver_id)
    {
        $Vnas_records = Vnas_record::findOrFail($caregiver_id);

        return view('Vnas_records.patientsch', compact('Vnas_records'));

    }
    */


    public function patientsch($patient_id)

    {
//        $Vnas_record = Vnas_record::findOrFail($id);
//        return view('Vnas_records.sch', compact('Vnas_records'));


        //return Vnas_record::where( 'patient_id' , '=' , $patient_id )->get( array('id','ap_title','ap_date','ap_time','ap_lov','caregiver_fname'));
        $Vnas_records = vnas_record::where( 'patient_id' , '=' , $patient_id )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname'));
        return view('vnas_records.patientsch', compact('Vnas_records'));

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
