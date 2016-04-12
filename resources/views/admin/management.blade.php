@extends('admin')

@section('content')
    
    <div id="admin_msg"></div>

    <div class="row" style="height: 80px; align-content: center; align-self: center; padding: 15px; text-align: center">
        <a name="btnFilterPatient" class="btn btn-primary" style="width: 100px" role="button" href="{{url('manage/patient')}}">Patient</a>
        <a name="btnFilterCaregiver" class="btn btn-primary" style="width: 100px" role="button"
           href="{{url('manage/caregiver')}}">Caregiver</a>
        <a name="btnFilterUnassigned" class="btn btn-primary" style="width: 100px" role="button" href="{{url('manage/unassigned')}}">Unassigned</a>
    </div>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>Edit</th>
            {{--<th>Reset</th>--}}
            <th>Unlock</th>
            <th>Remove</th>
            <th>Role</th>
        </tr>

        <?php $count = 1 ?>
        @foreach($users as $meh)
            <tr>
                <td>
                    <div name="{{'nameText' . $count}}">{{$meh ->name}}</div>
                </td>
                <td><a name="{{'editButton' . $count}}" class="btn btn-primary" role="button"
                       href="{{url('management_edit/')}}/{{$meh->id}}">Edit</a></td>
                {{--<td><a name="{{'resetButton' . $count}}" class="btn btn-primary" role="button" href="{{url('reset/')}}/{{$meh->id}}">Reset</a> </td>--}}
                <td>@if($meh->lock_user == 'X')<a name="{{'unlockButton' . $count}}" class="btn btn-primary"
                                                  href="{{url('unlock_user/')}}/{{$meh->id}}"
                                                  role="button">Unlock</a>@endif</td>
                <td>@if($meh->role != 'admin')<a name="{{'removeButton' . $count}}" class="btn btn-primary"
                                                 href="{{url('remove/')}}/{{$meh->id}}" role="button">Remove</a>@endif
                </td>
                <td><a name="{{'rolebutton' . $count}}" class="btn btn-primary" href="{{url('role/')}}/{{$meh->id}}"
                       role="button">Role</a></td>
            </tr>
            <?php $count = $count + 1 ?>
        @endforeach

    </table>
    @if(isset($_SESSION['admin_msg']))
        <script type="text/javascript">
            $('#admin_msg').after('<div class="alert alert-success"><?php echo $_SESSION['admin_msg'] ?></div>')
        </script>
    @endif
    <?php unset($_SESSION['admin_msg']); ?>

	@endsection
    @stop