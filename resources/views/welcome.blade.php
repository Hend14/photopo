@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="center">
            <div class="text-center">
                <h1>Photopo(仮)</h1>
                {!! link_to_route('signup.get', 'Sign up', [], ['class' => 'btn btn-lg btn-info']) !!}
                {!! link_to_route('login', 'Login', [], ['class' => 'btn btn-lg btn-secondary']) !!}
            </div>
        </div>
    @endif
@endsection