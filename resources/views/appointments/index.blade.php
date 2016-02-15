@extends('app')

@section('content')

    <h1>VNAS USERS</h1>

        @foreach ($vnas_users as $vnas_user)

            <vnas_user>

                <h2>
                    <a href="{{ action('VnasUsersController@show', [$vnas_user->id]) }}">{{ $vnas_user->name }}</a>
                </h2>

                <div class="'body">{{ $vnas_user->email  }}</div>

             </vnas_user>
        @endforeach

@stop
