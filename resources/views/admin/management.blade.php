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
            <td><a class="btn btn-primary" role="button" href="{{url('edit/')}}/{{$meh->id}}">Edit</a> </td>
            <td><a class="btn btn-primary" role="button" href="{{url('reset/')}}/{{$meh->id}}">Reset</a> </td>
            <td><a class="btn btn-primary" role="button" >Unlock</a></td>
            <td><a class="btn btn-primary" role="button" >Remove</a></td>
        </tr>
    @endforeach

</table>

@endsection