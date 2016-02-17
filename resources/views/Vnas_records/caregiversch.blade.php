@extends('app')

@section('content')

    <h1>{{ $Vnas_record->ap_title }}</h1>



            <Vnas_record>

                <div class="'body">

                    <b>Date:</b> {{ $Vnas_record->ap_date  }} </br>

                    <b>Time:</b> {{ $Vnas_record->ap_time  }} </br>

                    <b>LOV:</b> {{ $Vnas_record->ap_love }} </br>

                    <b>Comments:</b> {{ $Vnas_record->ap_comments }} </br>

                    <b>CareGiver Name:</b> {{ $Vnas_record->caregiver_name }} </br>

                    <b>CareGiver Name:</b> {{ $Vnas_record->caregiver_mob }} </br>



                </div>

             </Vnas_record>


@stop
