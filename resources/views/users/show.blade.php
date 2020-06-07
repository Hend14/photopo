@extends('layouts.app')
@section('content')
<h1>{{ $user->name }}</h1>
@if(Auth::user() == $user)
  {!! link_to_route('users.edit', 'Edit', ['user' => $user], ['class' => 'btn btn-lg btn-primary']) !!}
@endif
@endsection