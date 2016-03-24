<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use App\Vnas_record;
use App\User_role_rel;
use App\Client_record;
use Request;
use DB;
use View;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Caregiver_record;

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
        	$myCurrUserSk 	= Auth::user()->id;
        	$myRoles 		= User_role_rel::where( 'user_sk' , '=' , $myCurrUserSk )
        							->get( array('vna_user_role_cd') );
        	$myCurrRole       = [];
        	
        	// Create an array of the roles of the authenticated user
        	foreach ( $myRoles as $myRole )
        	{
        		$myCurrRole[count($myCurrRole)] = $myRole->vna_user_role_cd;
        	}
        	
        	$isPatient = 0;
        	$isCareGiver = 0;
        	
        	if( is_array( $myCurrRole ) )
        	{
	        	if( in_array( 2 , $myCurrRole ) || in_array( 3 , $myCurrRole ) )
	        	{
	        		$isPatient      = 1;
	        	}
	        	
	        	foreach ($myCurrRole as $altRole )
	        	{
	        		if( $altRole != 2 && $altRole != 3 ){
	        			$isCareGiver      = 1;
	        		}
	        	}
        	}
             	
            $nextCntl         = "";
            $myView           = "";
            $myRoleList     = ['All','Caregiver','Patient']; // Pranjal, this probably needs a better definition
            
            // Get all client roles ** This should probably be a method
            $myClientRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
            // Get all caregiver roles ** This should probably be a method
            $myCaregiverRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc not in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
            $Vnas_records   = null;

            if( $isCareGiver && !$isPatient ) // Is a caregiver only
            {
                $Vnas_records = Caregiver_record::where( 'user_sk' , '=' , $myCurrUserSk )
                	->orderBy('schedule_start_dttm', 'asc')
                	->get( array('schedule_sk','client_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
				
                $nextCntl = "VnasRecordsController@sch";
                $myView = "vnas_records.care";
                
            }
            else if ( $isPatient && !$isCareGiver  ) // Is a patient only
            {
            	
                $Vnas_records = Client_record::where( 'user_sk' , '=' , $myCurrUserSk )
                	->orderBy('schedule_start_dttm', 'asc')
                	->get( array('schedule_sk','client_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
                $nextCntl = "VnasRecordsController@patientsch";
                $myView = "vnas_records.index";
            }
            else if( $isCareGiver && $isPatient ) // Is both roles
            {
				
				$Vnas_records = Vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
					->orderBy('schedule_start_dttm', 'asc')
					->distinct()
					->get( array('schedule_sk','client_id','care_giver_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));

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
    	$myCurrUserSk      = Auth::user()->id;
        $Vnas_records   = null;
        
        $myRoles 		= User_role_rel::where( 'user_sk' , '=' , $myCurrUserSk )
        	->get( array('vna_user_role_cd','vna_user_id') );
        $myCurrRole       = [];
        $isClient = 0;
        $isCaregiver = 0;    
        $myView = "";
		
        // Get all patient roles ** This should probably be a method
        $myClientRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
        // Get all caregiver roles ** This should probably be a method
        $myCaregiverRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc not in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
        
//         $myPatietCrit = ['id' => $id, 'patient_id' => $isPatient];
//         $myCaregiverCrit = ['id' => $id, 'caregiver_id' => $isCareGiver];

        $Vnas_records = vnas_record::where( 'schedule_sk' , '=' , $id )
			->where( 'user_sk' , '=' , $myCurrUserSk )
			->distinct()
			->get( array('schedule_sk','client_id','care_giver_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
       	
		foreach ($myRoles as $myRole )
		{
			if( $myRole->vna_user_id == $Vnas_records[0]->CLIENT_ID )
			{
				$isClient = 1;
			}
			else if( $myRole->vna_user_id == $Vnas_records[0]->CARE_GIVER_ID )
			{
				$isCaregiver = 1;
			}
		}
        
        // Need to check the roles from the ORM query and return the appropriate view.
        if( $isClient )
        {
            $myView         = "vnas_records.patientsch";
        }
        else if( $isCaregiver ) //if( $myCaregiverRoleList == $Vnas_records[0]->caregiver_id )
        {
            $myView         = "vnas_records.sch";
        }

        return view( $myView , compact('Vnas_records'));
    }


    public function sch($id)

    {
        $myCurrUserSk    = Auth::user()->id;
        $Vnas_records   = null;

        $Vnas_records = vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
                                        ->where( 'schedule_sk' , '=' , $id )
                                        ->get( array('schedule_sk','client_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
        return view('vnas_records.sch', compact('Vnas_records'));

    }

    public function patientsch($id)
    {
        $myCurrUserSk      = Auth::user()->id;
        
        $Vnas_records = Client_record::where( 'user_sk' , '=' , $myCurrUserSk )
                                        ->where( 'schedule_sk' , '=' , $id )
                                        ->get( array('schedule_sk','client_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
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
