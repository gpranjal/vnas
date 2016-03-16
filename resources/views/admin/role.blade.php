@extends('admin')

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    

    <script>


        $(function() {
            $( "#patient_autocomplete" ).autocomplete({
                source: function (request, response) {
                    $.getJSON("/search_patient", function (data) {
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
                    $('#patient_fetch').text(my_value);
                    $('#patient_search').val(my_value);
                    ui.item.value = '';
//
                }})

            $( "#caregiver_autocomplete" ).autocomplete({
                source: function (request, response) {
                    $.getJSON("/search_caregiver", function (data) {
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
                    $('#caregiver_fetch').text(my_caregiver);
                    $('#caregiver_search').val(my_caregiver);
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

<label>{{$role_id->name}}</label>
<form id="assign_roles" class="form-horizontal" role="form" method="POST" action="{{url('/role_update')}}/{{$role_id->id}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table" style="width:100%">
        <tr>
            <td>Patient ID: </td>
            <td><label id="patient_fetch">{{$role_id->patient_role}}</label></td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_autocomplete" name="patient_autocomplete"></td>
            <input type="hidden" id="patient_search" name="patient_search" value="{{$role_id->patient_role}}">
        </tr>
        <tr>
            <td>Caregiver ID: </td>
            <td><label id="caregiver_fetch">{{$role_id->caregiver_role}}</label></td>
            <td><input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="caregiver_autocomplete" name="caregiver_autocomplete"></td>
            <input type="hidden" id="caregiver_search" name="caregiver_search" value="{{$role_id->caregiver_role}}">
        </tr>
    </table>
    <input type="submit" value="submit">
</form>
    {{--<div id="search_patient" class="row">--}}


        {{--<label for="patient_search">Patient: </label>--}}
        {{--<input class="search ui-autocomplete-input" type="text" size="25" maxlength="50" id="patient_search" name="patient_search">--}}

    {{--</div>--}}


@endsection
