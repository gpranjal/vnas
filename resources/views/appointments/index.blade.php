@extends('app')

@section('content')

    <h1>Appointments</h1>

        @foreach ($appointments as $appointment)

            <appointment>

                <h2>
                    <a href="{{ action('AppointmentsController@show', [$appointment->id]) }}">{{ $appointment->title }}</a>
                </h2>

                <div class="'body">

                    <b>Date:</b> {{ $appointment->date  }} </br>

                    <b>Time:</b> {{ $appointment->time  }} </br>

                    <b>LOV:</b> {{ $appointment->duration }} </br>

                    <b>Comments:</b> {{ $appointment->comments }} </br>

                    <b>CareGiver ID:</b> {{ $appointment->vnas_user_id }}


                </div>

             </appointment>

        @endforeach

@stop
