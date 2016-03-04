@extends('app')

@section('content')

<table class="table">
    <tr>
        <th>Name</th>
        <th>Edit</th>
        <th>Reset</th>
        <th>Unlock</th>
        <th>Remove</th>
    </tr>

    @foreach($users as $meh)
        <tr>
            <td>{{$meh ->name}} </td>
            <td><a class="btn btn-primary" role="button" href="{{url('management_edit/')}}/{{$meh->id}}">Edit</a> </td>
            <td><a class="btn btn-primary" role="button" href="{{url('reset/')}}/{{$meh->id}}">Reset</a> </td>
            <td><a class="btn btn-primary" role="button" >Unlock</a></td>
            <td>@if($meh->role != 'admin')<a class="btn btn-primary" href="{{url('remove/')}}/{{$meh->id}}" role="button" >Remove</a>@endif</td>
        </tr>
    @endforeach

</table>

@endsection