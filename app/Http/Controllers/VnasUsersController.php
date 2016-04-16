<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vnas_user;
use App\User_role_rel;
use App\Caregiver_record;
use App\Client_record;
use Request;
use Auth;
use App\Vnas_record;
use View;
use App\UserSettings;


class VnasUsersController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        View::composer('*', 'App\Composers\HomeComposer');
    }

    public function index()
    {
        // Check to see if the user is logged in
        if( Auth::check() )
        {
        	$myAppUserInfo = Auth::user();
        	$myCurrUserSk 	= $myAppUserInfo->id;
        	$myRoles 		= User_role_rel::where( 'user_sk' , '=' , $myCurrUserSk )
        		->get( array('vna_user_role_cd','vna_user_id') );
        	
        	$myCurrRole       = User_role_rel::getCurrRole($myRoles);
	        $myClientIds 	  = User_role_rel::getClientIds($myRoles);
	        $myCareGiverIds   = User_role_rel::getCaregiverIds($myRoles);
	        
	        $isClient = ( !empty( $myClientIds ) ) ? 1 : 0;
	        $isCareGiver = ( !empty( $myCareGiverIds ) ) ? 1 : 0;
	        
        	$vnas_users   			= null;
        	$vnas_caregivers_info 	= null;
        	$vnas_clients_info		= null;
        	$myMessage				= false;

            $vnas_caregivers_info = Vnas_record::where( 'USER_SK' , '=' , $myCurrUserSk )
	            ->whereIn( 'CARE_GIVER_ID' , $myCareGiverIds )
	            ->distinct()
	            ->get( array('CARE_GIVER_ID','CARE_GIVER_FIRST_NME','CARE_GIVER_LAST_NME','CARE_GIVER_OFFICE_PH','CARE_GIVER_MOBILE_PH'));
         
            $vnas_clients_info = Vnas_record::where( 'USER_SK' , '=' , $myCurrUserSk )
	            ->whereIn( 'CLIENT_ID' , $myClientIds )
	            ->distinct()
                ->get( array('CLIENT_ID','CLIENT_FIRST_NME','CLIENT_LAST_NME','CLIENT_ADDRESS','CLIENT_PHONE'));

           	if( count($vnas_caregivers_info) == 0 && count($vnas_clients_info) == 0 )
           	{
           		$myMessage = UserSettings::getMyAcctNoRcrdMsg();
           	}
           
			return view('vnas_users.index', compact('vnas_users','myAppUserInfo','myMessage','vnas_caregivers_info','vnas_clients_info'));

        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }

    public function create()
    {
        return view('vnas_users.create');

    }

    public function store()
    {
        $input = Request::all();

        vnas_user::create($input);

        return redirect('vnas_users');

    }
}
