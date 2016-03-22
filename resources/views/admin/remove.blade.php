@extends('admin')

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
