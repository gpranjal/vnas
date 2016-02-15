<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\vnas_user;
use Request;
class VnasUsersController extends Controller {

	//

    public function index()
    {
        $vnas_users = vnas_user::all();

        return view('vnas_users.index', compact('vnas_users'));
    }

    public function show($id)
    {
        $vnas_user = vnas_user::findOrFail($id);

        return view('vnas_users.show', compact('vnas_user'));

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
