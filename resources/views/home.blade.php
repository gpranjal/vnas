@extends('app')

@section('content')

<div style="border-radius: 25px; border: 2px solid #00447C; padding: 20px; width: 200px;"> <!-- #00447c is the VNA Logo Color-->
    <div class="row">
        <img src="http://www.thevnacares.org/themes/VNA%20theme%20v2.0/img/brandmark_main.png" alt="VNA">
    </div>

    <br />

    <div class="row">
        <a class="btn btn-default" href="http://www.thevnacares.org/" role="button">My Account</a>
    </div>

    <br />

    <div class="row">
        <a class="btn btn-default" href="http://www.thevnacares.org/" role="button">My Schedule</a>
    </div>

    <br />

    <div class="row">
        <a class="btn btn-default" href="{{ url('faq') }}" role="button">FAQ</a>
    </div>

    <br />

    <div class="row">
        <a class="btn btn-default" href="http://www.thevnacares.org/donate-to-vna/" role="button">Donate to VNA</a>
    </div>
</div>

@endsection
