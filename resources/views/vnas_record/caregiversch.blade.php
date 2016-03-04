@extends('app')

@section('content')

    <h1>{{ $Vnas_record->ap_title }}</h1>

    @foreach ($Vnas_records as $Vnas_record)


            <Vnas_record>

                <div class="'body">

                    <b>Date:</b> {{ $Vnas_record->ap_date  }} </br>

                    <b>Time:</b> {{ $Vnas_record->ap_time  }} </br>

                    <b>LOV:</b> {{ $Vnas_record->ap_love }} </br>

                    <b>Comments:</b> {{ $Vnas_record->ap_comments }} </br>

                    <b>Patient ID:</b> {{ $Vnas_record->patient_id }} </br>

                    <b>Patient Phone:</b> {{ $Vnas_record->patient_phone }} </br>

                    <b>Patient Address:</b> {{ $Vnas_record->patient_address }} </br>



                </div>

             </Vnas_record>

    @endforeach

@stop
