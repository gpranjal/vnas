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
        	$myCurrUserSk 	= Auth::user()->id;
        	$myRoles 		= User_role_rel::where( 'user_sk' , '=' , $myCurrUserSk )
        		->get( array('vna_user_role_cd','vna_user_id') );
        	
        	$myCurrRole       = User_role_rel::getCurrRole($myRoles);
	        $myClientIds 	  = User_role_rel::getClientIds($myRoles);
	        $myCareGiverIds   = User_role_rel::getCaregiverIds($myRoles);
	        	
	        $isClient = ( !empty( $myClientIds ) ) ? 1 : 0;
	        $isCareGiver = ( !empty( $myCareGiverIds ) ) ? 1 : 0;
	        
        	$vnas_users   = null;

            if( $isCareGiver  )
            {
                $vnas_users = Caregiver_record::where( 'user_sk' , '=' , $myCurrUserSk )
                	->distinct()
                    ->get( array('care_giver_id','care_giver_first_nme','care_giver_last_nme','care_giver_office_ph','care_giver_mobile_ph'));
                return view('vnas_users.care', compact('vnas_users'));
            }
            else if ( $isClient ) 
            {
                $vnas_users = Client_record::where( 'user_sk' , '=' , $myCurrUserSk )->distinct()
                    ->get( array('client_id','client_first_nme','client_last_nme','client_address','client_phone'));
                return view('vnas_users.index', compact('vnas_users'));
            }
            else
            {
                return view('vnas_users.index', compact('vnas_users'));
            } 

        }
        else
        {
            return 'You aren\'t logged in.';
        }
    }

//    public function show($id)
//    {
//        $vnas_user = vnas_user::find($id);
//
//        return view('vnas_users.show', compact('vnas_user'));
//
//    }

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
