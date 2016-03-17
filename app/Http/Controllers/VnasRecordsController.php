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
use Mail;

class VnasRecordsController extends Controller {

	//
    //var $vnas_records;

    public function __construct()
    {
        //$this->vnas_records = Vnas_record::all();
        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }

    public function index($myRole = 'All' )
    {
        // Check to see if the user is logged in
        if( Auth::check() )
        {
            $isCareGiver    = Auth::user()->caregiver_role;
            $isPatient      = Auth::user()->patient_role;
            $nextCntl       = "";
            $myView         = "";
            $myCurrRole     = "all";
            $myRoleList     = ['All','Caregiver','Patient'];
            $Vnas_records   = null;

            if( $isCareGiver != "" && $isPatient == ""  ) // Is a caregiver only
            {
                $Vnas_records = Vnas_record::where( 'caregiver_id' , '=' , $isCareGiver )->orderBy('ap_date', 'asc')->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                // sort according to date instead of default schedule ID
                $nextCntl = "VnasRecordsController@sch";
                $myView = "vnas_records.care";
                
            }
            else if ( $isPatient != "" && $isCareGiver == ""  ) // Is a patient only
            {
                $Vnas_records = Vnas_record::where( 'patient_id' , '=' , $isPatient )->orderBy('ap_date', 'asc')->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));

                $nextCntl = "VnasRecordsController@patientsch";
                $myView = "vnas_records.index";
            }
            else if( $isCareGiver != "" && $isPatient != ""  ) // Is both roles
            {
                if( $myRole == "All" )
                {
                    $Vnas_records = Vnas_record::where( 'patient_id' , '=' , $isPatient )
                        ->orwhere( 'caregiver_id' , '=' , $isCareGiver )
                        ->orderBy('ap_date', 'asc')
                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                }
                else if( $myRole == "Patient" )
                {
                     $Vnas_records = Vnas_record::where( 'patient_id' , '=' , $isPatient )
                        ->orderBy('ap_date', 'asc')
                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                }
                else if( $myRole == "Caregiver" )
                {
                     $Vnas_records = Vnas_record::where( 'caregiver_id' , '=' , $isCareGiver )
                        ->orderBy('ap_date', 'asc')
                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                }
                
                $nextCntl = "VnasRecordsController@multirolesch";
                $myView = "vnas_records.multirole";//{{ action( $nextCntl , [$Vnas_record->id]) }}
            }
            else // Has no roles
            {
                $myView = "vnas_records.index";
            }

            return view( $myView , compact('Vnas_records','isCareGiver','isPatient','nextCntl','myRoleList','myRole'));


            //If admin here, go ahead and show the list of patients

            //if not show only the currently logged in patient
            //$Vnas_records = Vnas_record::where( 'patient_email' , '=' , $myCurrUserEmail )->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname'));
        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }

    public function multirolesch($id)
    {
        
        $isPatient      = Auth::user()->patient_role;
        $isCareGiver    = Auth::user()->caregiver_role;
        $Vnas_records   = null;

        $myPatietCrit = ['id' => $id, 'patient_id' => $isPatient];
        $myCaregiverCrit = ['id' => $id, 'caregiver_id' => $isCareGiver];

        $Vnas_records = vnas_record::where( $myPatietCrit )
                                        ->orwhere( $myCaregiverCrit )
                                        ->get( array('id','patient_id','patient_fname','patient_lname','patient_address','patient_email','patient_phone','ap_title','ap_date','ap_time','ap_lov','ap_comments','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
        
        // Need to check the roles from the ORM query and return the appropriate view.
        if( $isPatient == $Vnas_records[0]->patient_id )
        {
            $myView         = "vnas_records.patientsch";
        }
        else if( $isCareGiver == $Vnas_records[0]->caregiver_id )
        {
            $myView         = "vnas_records.sch";
        }

        return view( $myView , compact('Vnas_records'));
    }


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

    public function testmail(Request $request)
    {
        $user = Auth::user()->id;
        $data = "This is mydata";

        Mail::send('welcome', ['user' => $user], function($message)
        {
            $message->to('zheath@unomaha.edu', 'John Smith')->subject('Testing!');
        });
    }
}
