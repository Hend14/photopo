@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Users</h1>
    <div>
        @foreach ($users as $user)
        @include('users.card', ['user' => $user])
        @endforeach
    </div>
    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection