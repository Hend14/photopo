@extends('layouts.app') @section('content')
<h1 class="text-center mb-4">{{ $user->name }} page</h1>
<div class="container d-flex justify-content-around">
  <div>
    <div class="card mt-4 bg-light">
      <div class="sidebar_content row no-gutters">
        <div class="col-sm-4 p-2">
          @if ($user->profile_img === null)
          <p>( no image )</p>
          @else
          <img src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}" width="auto" height="100px"> @endif
          <h5 class=""><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></h5>
        </div>
        <div class="col-sm-8 pt-2">
          <div class="card-body">
            @if ($user->age === null)
            <p>Age : 未設定</p>
            @else
            <p>Age : {{ $user->age}}</p>
            @endif @if ($user->location_id === null)
            <p>Location : 未設定</p>
            @else
            <p>Location : {{ $user->location->prefecture }}</p>
            @endif @if(Auth::id() == $user->id) {!! link_to_route('users.edit', 'Account Settings', ['user' => $user], ['class' => 'btn
            btn-md btn-secondary']) !!} @else @include('user_follow.follow_button') @endif
          </div>
        </div>
      </div>
    </div>
    @if(Auth::id() == $user->id) @include('posts.create') @endif
  </div>
  <div class="ml-4">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="#" class="nav-link active">Posts</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">Followings</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">Followers</a>
      </li>
    </ul>
    @include('posts.index', ['posts' => $posts, 'user' => $user])
  </div>
</div>
@endsection