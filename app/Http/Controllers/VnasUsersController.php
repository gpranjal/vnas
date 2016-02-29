<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vnas_user;
use Request;
use Auth;
use App\Vnas_record;


class VnasUsersController extends Controller {

	//

    public function index()
    {
        // Check to see if the user is logged in
        if( Auth::check() )
        {
            $myCurrUserEmail = Auth::user()->email; 
            //If admin here, go ahead and show the list of patients
            /*
                Code to look up admin and build $vnas_users with list of users
                needs to go here
            */

            //if not show only the currently logged in patient
            $vnas_users = Vnas_record::where( 'patient_email' , '=' , $myCurrUserEmail )->distinct()->get( array('patient_id','patient_fname','patient_lname','patient_address','patient_phone','patient_email'));
            

            return view('vnas_users.index', compact('vnas_users'));
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
