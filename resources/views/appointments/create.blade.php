@extends('app')

@section('content')

    <h1>Enter New Appointment</h1>

    <hr/>

    {!! Form::open(['url' => 'appointments']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('date', 'Date:') !!}
            {!! Form::date('date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('time', 'Time:') !!}
            {!! Form::text('time', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('duration', 'LOV:') !!}
            {!! Form::text('duration', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('vna_user_id', 'Care Giver ID:') !!}
            {!! Form::text('patient_address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comments', 'Comments:') !!}
            {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Add Appointment', ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

@stop
