@extends('layouts.app')

@section('content')
<h1>{{ $user->name }} likes</h1>
<div class="row">
    <aside class="col-sm-4">
        @include('users.card', ['user' => $user])
    </aside>
    <div class="col-sm-8">
        @include('users.navtabs', ['user' => $user])
        @include('posts.index', ['posts' => $posts])
    </div>
</div>
@endsection