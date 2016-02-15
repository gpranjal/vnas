@extends('app')

@section('content')

    <h1>Enter new VNA User</h1>

    <hr/>

    {!! Form::open(['url' => 'vnas_users']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('patient_id', 'Patient ID:') !!}
            {!! Form::text('patient_id', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('patient_phone', 'Phone:') !!}
            {!! Form::text('patient_phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('patient_address', 'Address:') !!}
            {!! Form::text('patient_address', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Add User', ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

@stop
