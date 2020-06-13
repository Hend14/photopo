@extends('layouts.app')
@section('content')
<div class="container">
  <h1>{{ $user->name }}</h1>
  @if(Auth::user() == $user)
    <div>
      {!! link_to_route('users.edit', 'Edit', ['user' => $user], ['class' => 'btn btn-lg btn-primary']) !!}
    </div>
  @endif
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Age</th>
          <th>Location</th>
          <th>img</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $user->id }}</td>
          <td>
            <a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a>
          </td>
          @if ($user->age === null)
          <td>未設定</td>
          @else
          <td>{{ $user->age}}</td>
          @endif @if ($user->location_id === null)
          <td>未設定</td>
          @else
          <td>{{ $user->location->prefecture }}</td>
          @endif @if ($user->profile_img === null)
          <td>未設定</td>
          @else
          <td> <img src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}" width="auto" height="60px"> </td>
          @endif
        </tr>
      </tbody>
    </table>
  </div>
  @if (Auth::id() == $user->id)
    @include('posts.create')
  @endif
  @include('posts.index', ['posts' =>$posts, 'user' =>$user])
</div>
@endsection