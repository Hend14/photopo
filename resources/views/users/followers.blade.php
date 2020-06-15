@extends('layouts.app')

@section('content')
<h1>{{ $user->name }} followers</h1>
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
            @if(Auth::id() == $user->id) @include('posts.create') @endif
        </aside>
        <div class="col-sm-8">
            @include('users.navtab')
            @include('users.users', ['user' => $user])
        </div>
    </div>
@endsection
