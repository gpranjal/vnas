@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#F58E31"><font color="White" size="3"><b>Edit</b></font></div>
                    <div class="panel-body">
                        <img src="http://www.thevnacares.org/themes/VNA%20theme%20v2.0/img/brandmark_main.png" alt="VNA" style="width:470px;height:80px;">


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/edit') }}/{{$edit->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $edit->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ $edit->email }}">
                                </div>
                            </div>

                            @if(Auth::User()->role == 'admin')

                            <div class="form-group">
                                <label class="col-md-4 control-label">Role</label>
                                <div class="col-md-6">
                                    <select name="role" class="form-control" >
                                        <option value="admin" @if($edit->role=='admin') selected ; @endif>Admin</option>
                                        <option value="regular" @if($edit->role=='regular') selected ; @endif>Regular</option>
                                    </select>
                                </div>
                            </div>

                            @endif



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                    <a class="btn btn-primary" role="button" href="{{url('home')}}">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
