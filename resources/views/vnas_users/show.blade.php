@extends('app')

@section('content')

    <h1>{{ $vnas_user->name }}</h1>



            <vnas_user>

                <div class="'body">

                    <b>Email:</b> {{ $vnas_user->email  }} </br>

                    <b>Patient-ID:</b> {{ $vnas_user->patient_id  }} </br>

                    <b>Mobile:</b> {{ $vnas_user->patient_phone }} </br>

                    <b>Address:</b> {{ $vnas_user->patient_address  }}


                </div>

             </vnas_user>


@stop
