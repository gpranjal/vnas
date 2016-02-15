@extends('app')

@section('content')

    <h1>{{ $appointment->title }}</h1>



            <appointment>

                <div class="'body">

                    <b>Date:</b> {{ $appointment->date  }} </br>

                    <b>Time:</b> {{ $appointment->time  }} </br>

                    <b>LOV:</b> {{ $appointment->duration }} </br>

                    <b>Comments:</b> {{ $appointment->comments }} </br>

                    <b>CareGiver ID:</b> {{ $vnas_user->vnas_user_id }}


                </div>

             </appointment>


@stop
