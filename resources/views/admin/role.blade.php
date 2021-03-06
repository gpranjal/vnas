@extends('admin')

@section('content')
    <div id="role_msg"></div>

    <script>


        $(function() {
            $( "#patient_autocomplete" ).autocomplete({
                source: function (request, response) {
                    var searchTerm = $("#patient_autocomplete").val();
                    $.getJSON("/search_patient", { searchTerm: searchTerm }, function (data) {
                        response($.map(data, function (value, key) {
                            return {
                                label: value +", id: "+ key,
                                value: key
                            };
                        }));
                    });
                },
                minLength: 2,
                delay: 500,
                select: function(event, ui) {
                    var my_value = ui.item.value;
                    console.log(my_value);
                    if($('#patient_fetch').text() == '' ){
                        $('#patient_fetch').text(my_value);
                    }else{

                        $('#patient_fetch').text($('#patient_fetch').text()+ ', '+my_value);
                    }

                    if($('#patient_search').val() == ''){
                        $('#patient_search').val(my_value);
                    }else{

                        $('#patient_search').val($('#patient_search').val()+ ', '+my_value);
                    }

                    ui.item.value = '';
//
                }})

            $( "#caregiver_autocomplete" ).autocomplete({
                source: function (request, response) {
                    var searchTerm = $("#caregiver_autocomplete").val();
                    $.getJSON("/search_caregiver", { searchTerm: searchTerm }, function (data) {
                        response($.map(data, function (value, key) {
                            return {
                                label: value +", id: "+ key,
                                value: key
                            };
                        }));
                    });
                },
                minLength: 2,
                delay: 500,
                select: function(event, ui) {
                    var my_caregiver = ui.item.value;
                    console.log(my_caregiver);
                    if($('#caregiver_fetch').text() == '' ){
                        $('#caregiver_fetch').text(my_caregiver);
                    }else{

                        $('#caregiver_fetch').text($('#caregiver_fetch').text()+ ', '+my_caregiver);
                    }

                    if($('#caregiver_search').val() == ''){
                        $('#caregiver_search').val(my_caregiver);
                    }else{

                        $('#caregiver_search').val($('#caregiver_search').val()+ ', '+my_caregiver);
                    }

                    ui.item.value = '';
//
                }})
        });
    </script>

<style>
    .search{
        background-position: -160px -112px;
    }
    .ui-helper-hidden-accessible{
        visibility: hidden;
        display: none;
    }
</style>

<label style="font-size: 20px">Username: {{$role_array['name']}}</label><br><br>
<form id="assign_roles" class="form-horizontal" role="form" method="POST" action="{{url('/role_update')}}/{{$role_array['id']}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table" style="width:100%">
        <tr>
            <th>Type</th>
            <th>ID Attached</th>
            <th>Search (Patient/Caregiver)</th>
            <th>Remove</th>
        </tr>
        <tr>

            <td>Patient ID: </td>
            <td><label id="patient_fetch">{{$role_array['client']}}</label></td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_autocomplete" name="patient_autocomplete"></td>
            <td><a href="/remove/patient_role/{{$role_array['id']}}" name="link_remove_pateint_role"> Remove Patient Role</a></td>
            <input type="hidden" id="patient_search" name="patient_search" value="">
        </tr>
        <tr>
            <td>Caregiver ID: </td>
            <td><label id="caregiver_fetch">{{$role_array['caregiver']}}</label></td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="caregiver_autocomplete" name="caregiver_autocomplete"></td>
            <td><a href="/remove/caregiver_role/{{$role_array['id']}}" name="link_remove_caregiver_role"> Remove Caregiver Role</a></td>
            <input type="hidden" id="caregiver_search" name="caregiver_search" value="">
        </tr>
    </table>
    <input class="btn btn-primary" role="button" name="btnSubmit" type="Submit" value="Submit" />
    <a name="btnCancel" class="btn btn-primary" role="button" href="{{url('/mnge')}}">Cancel</a>
</form>
    @if(isset($_SESSION['role_msg']))
        <script>
            $('#role_msg').after('<div class="alert alert-success"><?php echo $_SESSION['role_msg'] ?></div>')
        </script>
    @endif
    <?php unset($_SESSION['role_msg']); ?>
    {{--<div id="search_patient" class="row">--}}


        {{--<label for="patient_search">Patient: </label>--}}
        {{--<input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_search" name="patient_search">--}}

    {{--</div>--}}


@endsection
