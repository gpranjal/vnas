@extends('app')

@section('content')

<table>
    <tr>
        <th>Name</th>
        <th>Edit</th>
        <th>Reset</th>
    </tr>

    @foreach($users as $meh)
        <tr>
            <td>{{$meh ->name}} </td>
            <td><a href="{{url('admin/edit')}}">Edit</a> </td>
            <td><a href="{{url('admin/reset')}}">Reset</a> </td>
        </tr>
    @endforeach

</table>

@endsection