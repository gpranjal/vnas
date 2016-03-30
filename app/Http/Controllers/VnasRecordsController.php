<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use App\Vnas_record;
use App\User_role_rel;
use App\Client_record;
use App\User_role_dcod;
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
        							->get( array('vna_user_role_cd','vna_user_id') );
        	$myCurrRole       = User_role_rel::getCurrRole($myRoles);
        	$myClientIds 	  = User_role_rel::getClientIds($myRoles);
        	$myCareGiverIds   = User_role_rel::getCaregiverIds($myRoles);
        	
        	$isPatient = ( !empty( $myClientIds ) ) ? 1 : 0;
        	$isCareGiver = ( !empty( $myCareGiverIds ) ) ? 1 : 0;
        	
            $nextCntl         = "";
            $myView           = "";
            $myRoleList     = ['All','Caregiver','Client']; // Pranjal, this probably needs a better definition
            
            $Vnas_records   = null;

            if( ( $isCareGiver && !$isPatient )  ) // Is a caregiver only
            {
                $Vnas_records = Vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
                	->orderBy('schedule_start_dttm', 'asc')
                	->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));
				
                $nextCntl = "VnasRecordsController@sch";
                $myView = "vnas_records.care";
                
            }
            else if ( $isPatient && !$isCareGiver  ) // Is a patient only
            {
                $Vnas_records = Vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
                	->orderBy('schedule_start_dttm', 'asc')
                	->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));
                $nextCntl = "VnasRecordsController@patientsch";
                $myView = "vnas_records.index";
            }
            else if( $isCareGiver && $isPatient ) // Is both roles
            {
            	$Vnas_records = Vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
            		->orderBy('schedule_start_dttm', 'asc');
            		         	
            	if( $myRole == "Client" )
            	{
            		foreach( $myClientIds as $myClientId )
            		{
            			$Vnas_records = $Vnas_records->where( 'CLIENT_ID' , '=' , $myClientId );
            		}
            	}
            	else if( $myRole == "Caregiver" )
            	{
            		foreach( $myCareGiverIds as $myCareGiverId )
            		{
            			$Vnas_records = $Vnas_records->where( 'care_giver_id' , '=' , $myCareGiverId );
            		}
            	}
            	
            	$Vnas_records = $Vnas_records->distinct()
            		->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));

				$nextCntl = "VnasRecordsController@multirolesch";
                $myView = "vnas_records.multirole";//{{ action( $nextCntl , [$Vnas_record->id]) }}
            }
            else // Has no roles
            {
                $myView = "vnas_records.index";
            }

            return view( $myView , compact('Vnas_records','isCareGiver','isPatient','nextCntl','myRoleList','myRole'));
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
        
        $myCurrRole       = User_role_rel::getCurrRole($myRoles);
        $myClientIds 	  = User_role_rel::getClientIds($myRoles);
        $myCareGiverIds   = User_role_rel::getCaregiverIds($myRoles);
        	
        $isClient = ( !empty( $myClientIds ) ) ? 1 : 0;
        $isCareGiver = ( !empty( $myCareGiverIds ) ) ? 1 : 0;
        
        $myView = "";
		
        // Get all patient roles ** This should probably be a method probably it's own model...at least a method in this controller
        $myClientRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
        // Get all caregiver roles ** This should probably be a method
        $myCaregiverRoleList = DB::select( "SELECT gen_ref_id ,gen_ref_desc FROM `vnas_gen_ref` WHERE gen_ref_desc not in ( 'PATIENT' , 'CLIENT' ) group by gen_ref_id ,gen_ref_desc" );
        
        $Vnas_records = vnas_record::where( 'schedule_sk' , '=' , $id )
			->where( 'user_sk' , '=' , $myCurrUserSk )
			->distinct()
			->get( array('schedule_sk','client_id','care_giver_id','client_first_nme','client_last_nme','client_address','client_phone','calendar_type','schedule_start_dttm','schedule_end_dttm','comments','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
        
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
