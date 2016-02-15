@extends('app')

@section('content')

    <h1>Appointments</h1>

        @foreach ($appointments as $appointment)

            <appointment>

                <h2>
                    <a href="{{ action('AppointmentsController@show', [$appointment->id]) }}">{{ $appointment->title }}</a>
                </h2>

                <div class="'body">{{ $appointment->date  }}</div>

             </appointment>

        @endforeach

@stop
