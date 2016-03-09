<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use App\Vnas_record;
use Request;
use DB;
use View;
use Auth;
use Carbon\Carbon;

class VnasRecordsController extends Controller {

	//
    //var $vnas_records;

    public function __construct()
    {
        //$this->vnas_records = Vnas_record::all();
        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }

    public function index()
    {



        // Check to see if the user is logged in
        if( Auth::check() )
        {
            $isCareGiver    = Auth::user()->caregiver_role;
            $isPatient      = Auth::user()->patient_role;
            $nextCntl       = "";
            $Vnas_records   = null;

            if( $isCareGiver != "" )
            {
                $Vnas_records = Vnas_record::where( 'caregiver_id' , '=' , $isCareGiver )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                // sort according to date instead of default schedule ID
                $Vnas_records = Vnas_record::orderBy('ap_date', 'asc')->get();
                $nextCntl = "VnasRecordsController@sch";
                return view('vnas_records.care', compact('Vnas_records','isCareGiver','isPatient','nextCntl'));
            }
            else if ( $isPatient != "" ) 
            {
                $Vnas_records = Vnas_record::where( 'patient_id' , '=' , $isPatient )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                $Vnas_records = Vnas_record::orderBy('ap_date', 'asc')->get();
                $nextCntl = "VnasRecordsController@patientsch";
            }


            //If admin here, go ahead and show the list of patients

            //if not show only the currently logged in patient
            //$Vnas_records = Vnas_record::where( 'patient_email' , '=' , $myCurrUserEmail )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname'));

            return view('vnas_records.index', compact('Vnas_records','isCareGiver','isPatient','nextCntl'));
        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }


    /* You are working here */
    public function sch($id)

    {
        $isCareGiver    = Auth::user()->caregiver_role;
        $Vnas_records   = null;

        $Vnas_records = vnas_record::where( 'id' , '=' , $id )
                                        ->where( 'caregiver_id' , '=' , $isCareGiver )
                                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
        return view('vnas_records.sch', compact('Vnas_records'));

    }

    public function patientsch($id)
    {
        $isPatient      = Auth::user()->patient_role;
        $Vnas_records   = null;

        $Vnas_records = vnas_record::where( 'id' , '=' , $id )
                                        ->where( 'patient_id' , '=' , $isPatient )
                                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
        return view('vnas_records.patientsch', compact('Vnas_records'));
    }


    public function create()
    {
        return view('vnas_records.create');

    }

    public function store()
    {
        $input = Request::all();
        Vnas_record::create($input);

        return redirect('vnas_records');

    }
}
