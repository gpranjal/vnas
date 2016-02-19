@extends('app')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
            <h4>Home</h4>
        </div>
            <br />
              <img src="{{ asset('img/brandmark_main.png') }}" height="1000" width="400">

            <div class="row">
            </div>
            <br />
            <div class="row">
                <a class="btn btn-default" href="{{ url('vnas_users/') }}" role="button">My Account</a> 
            </div>
            <br />
            <div class="row">
                <a class="btn btn-default" href="{{ url('vnas_records') }}" role="button">My Schedule</a>
            </div>
            <br />
            <div class="row">
            <a class="btn btn-default" role="button" href="{{ url('faq') }}">FAQ</a>
            </div>
            <br />
            <div class="row">
            <a class="btn btn-default" href="" role="button">Donate</a>
            </div>
            <br />
        </div>    
    </div>
</div>

@endsection
