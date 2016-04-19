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
use Mail;
use App\Caregiver_record;
use App\UserSettings;
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

    public function index($myRole = 'All', $myRangeValue = 'Current')
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

            $nextCntl         = Vnas_record::getNextCntl( $isCareGiver , $isPatient);
            $myView           = Vnas_record::getNextView( $isCareGiver , $isPatient);
            $myRoleList     = ['All','Caregiver','Client']; // Pranjal, this probably needs a better definition
            $dateRange    = ['Current','History'];
            $Vnas_records   = null;
            $myMessage		= false;
            
            $Vnas_records = Vnas_record::where( 'user_sk' , '=' , $myCurrUserSk )
            	->distinct();
            
            if( $isCareGiver && $isPatient ) // Is both roles
            {
            	/* Filter the records based on the usere selecting the select box */
                if( $myRole == "Client" )
                {
                	$Vnas_records = $Vnas_records->where( 'user_sk' , '=' , $myCurrUserSk )
                		->whereIn( 'CLIENT_ID' , $myClientIds );
                }
                else if( $myRole == "Caregiver" )
                {
                    $Vnas_records = $Vnas_records->where( 'user_sk' , '=' , $myCurrUserSk )
                    	->whereIn( 'CARE_GIVER_ID' , $myCareGiverIds );
                }
            }
            
            /* Determine Current or historical query logic */
            $Vnas_records = Vnas_record::filterForSchType( $Vnas_records , $myRangeValue );

            $Vnas_records = $Vnas_records->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));

            //$myMessage  = UserSettings::getSchNoRcrdMsg();
                
            return view( $myView , compact('Vnas_records','isCareGiver','isPatient','nextCntl','myRoleList','myRole','myMessage','myRangeValue', 'dateRange'));
        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }

    public function multirolesch($id, $myRangeValue = 'Current')
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
        $Vnas_records = Vnas_record::where( 'SCHEDULE_SK' , '=' , $id )
        	->distinct()
        	->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));
        
        // Need to check the roles from the ORM query and return the appropriate view.
        if (in_array($Vnas_records[0]->CLIENT_ID, $myClientIds))
        {
        	$myView         = "vnas_records.patientsch";
        }
        else if (in_array($Vnas_records[0]->CARE_GIVER_ID, $myCareGiverIds)) //if( $myCaregiverRoleList == $Vnas_records[0]->caregiver_id )
        {
        	$myView         = "vnas_records.sch";
        }

        return view( $myView , compact('Vnas_records','myRangeValue', 'dateRange'));
    }

    public function sch($id)
    {
        $myCurrUserSk    = Auth::user()->id;
        $Vnas_records   = null;

        $Vnas_records = Vnas_record::where( 'schedule_sk' , '=' , $id )
        	->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));

        return view('vnas_records.sch', compact('Vnas_records'));
    }

    public function patientsch($id)
    {
        $myCurrUserSk      = Auth::user()->id;
        
        $Vnas_records = Vnas_record::where( 'schedule_sk' , '=' , $id )
        	->get( array('SCHEDULE_SK','CLIENT_ID','CARE_GIVER_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE','CALENDAR_TYPE','SCHEDULE_START_DTTM','SCHEDULE_END_DTTM','COMMENTS','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));

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