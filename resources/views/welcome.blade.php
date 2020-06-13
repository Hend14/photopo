@extends('layouts.app')

@section('content')
    @if (Auth::check())
   <h1 class="text-center">Welcome : {!! link_to_route('users.show', Auth::User()->name, ['id' => Auth::User()->id]) !!}</h1>
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