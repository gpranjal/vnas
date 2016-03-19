@extends('app')

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#F58E31"><font color="White" size="3"><b>Edit</b></font></div>
                    <div class="panel-body">
                        <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">

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

                           
                            @if(Auth::User()->role == 'regular')
                                <input type="hidden" name="role" value="{{$edit->role}}">
                            @endif



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button name="btnSave" type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                    <a name="btnCancel" class="btn btn-primary" role="button" href="{{url('home')}}">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
