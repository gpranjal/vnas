@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <form class="form-horizontal" id="remove_user" action="{{url('remove/')}}/{{$remove->id}}" method="post" role="form">
                        <p>Are you sure you want to delete {{$remove->name}}??</p>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="removeButton" type="submit" value="remove">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
