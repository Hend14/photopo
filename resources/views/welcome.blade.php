@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h1>Welcome : {!! link_to_route('users.show', Auth::User()->name, ['id' => Auth::User()->id]) !!}</h1>
          @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                @include('users.card', ['user' => Auth::user()])
                @include('posts.create', ['user' => Auth::user()])
            </aside>
            <div class="col-sm-8">
                @if (count($posts) > 0)
                    @include('posts.index')
                @endif
            </div>
        @endif
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