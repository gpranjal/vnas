<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vnas_user;
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
            $isCareGiver    = Auth::user()->caregiver_role;
            $isPatient      = Auth::user()->patient_role;
            $vnas_users   = null;

            if( $isCareGiver != "" )
            {
                $vnas_users = Vnas_record::where( 'caregiver_id' , '=' , $isCareGiver )
                    ->take(1)
                    ->get( array('id','caregiver_id','caregiver_fname','caregiver_lname','caregiver_phone','caregiver_mob'));
                return view('vnas_users.care', compact('vnas_users'));
            }
            else if ( $isPatient != "" ) 
            {
                $vnas_users = Vnas_record::where( 'patient_id' , '=' , $isPatient )->distinct()
                    ->take(1)
                    ->get( array('patient_id','patient_fname','patient_lname','patient_address','patient_phone','patient_email'));
                return view('vnas_users.index', compact('vnas_users'));
            }
            //If admin here, go ahead and show the list of patients
            /*
                Code to look up admin and build $vnas_users with list of users
                needs to go here
            */

            //if not show only the currently logged in patient
            
            

            
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
