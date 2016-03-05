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

    <?php $count = 1 ?>
    @foreach($users as $meh)
        <tr>
            <td><div name="{{'nameText' . $count}}" {{$meh ->name}}</div></td>
            <td><a name="{{'editButton' . $count}}" class="btn btn-primary" role="button" href="{{url('management_edit/')}}/{{$meh->id}}">Edit</a> </td>
            <td><a name="{{'resetButton' . $count}}" class="btn btn-primary" role="button" href="{{url('reset/')}}/{{$meh->id}}">Reset</a> </td>
            <td><a name="{{'unlockButton' . $count}}" class="btn btn-primary" role="button" >Unlock</a></td>
            <td>@if($meh->role != 'admin')<a name="{{'removeButton' . $count}}" class="btn btn-primary" href="{{url('remove/')}}/{{$meh->id}}" role="button">Remove</a>@endif</td>
        </tr>
        <?php $count=$count+1 ?>
    @endforeach

</table>

@endsection