@extends('app')

@section('content')

    <h1>Enter New Schedule</h1>

    <hr/>

    {!! Form::open(['url' => 'Vnas_records']) !!}


        <div class="form-group">
            {!! Form::label('patient_id', 'Patient ID:') !!}
            {!! Form::text('patient_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
                {!! Form::label('patient_fname', 'Patient First Name:') !!}
                {!! Form::text('patient_fname', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('patient_lname', 'Patient Last Name:') !!}
            {!! Form::text('patient_lname', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('patient_email', 'Patient Email:') !!}
            {!! Form::text('patient_email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('patient_phone', 'Patient Phone:') !!}
            {!! Form::text('patient_phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('patient_address', 'Patient Address:') !!}
            {!! Form::text('patient_address', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('caregiver_id', 'Caregiver ID:') !!}
            {!! Form::text('caregiver_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('caregiver_fname', 'Caregiver First Name:') !!}
            {!! Form::text('caregiver_fname', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('caregiver_lname', 'Caregiver Last Name:') !!}
            {!! Form::text('caregiver_lname', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('caregiver_role', 'Caregiver Title/Role:') !!}
            {!! Form::text('caregiver_role', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('caregiver_phone', 'Caregiver Office Phone:') !!}
            {!! Form::text('caregiver_phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('caregiver_mob', 'Caregiver Mobile:') !!}
            {!! Form::text('caregiver_mob', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ap_title', 'Appointment Title:') !!}
            {!! Form::text('ap_title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ap_date', 'Appointment Date:') !!}
            {!! Form::input('date', 'ap_date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ap_time', 'Appointment Time:') !!}
            {!! Form::text('ap_time', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ap_lov', 'Appointment LOV:') !!}
            {!! Form::text('ap_lov', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ap_comments', 'Appointment Comments (For Caregivers):') !!}
            {!! Form::textarea('ap_comments', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit Schedule', ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}

@stop
