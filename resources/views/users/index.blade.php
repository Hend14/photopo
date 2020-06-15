@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Users</h1>
    @foreach ($users as $user)
        @include('users.card', ['user' => $user])
    @endforeach
{{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection