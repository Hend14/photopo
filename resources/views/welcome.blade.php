@extends('layouts.app')

@section('content')
    @if (Auth::check())
    @include('users.show', $user = Auth::user())
    @else
        <div class="center">
            <div class="text-center">
                <h1>Photopo</h1>
                {!! link_to_route('register', 'SignUp', [], ['class' => 'btn btn-lg btn-primary']) !!}
                {!! link_to_route('login', 'Login', [], ['class' => 'btn btn-lg btn-success']) !!}
            </div>
        </div>
    @endif
@endsection