@extends('layouts.app')
@section('content')
<h1 class="text-center">Edit My Account</h1>

<div class="pl-4 pr-4">
  {!! Form::model($user, ['route' => ['users.update', $user->id], 'files' => true, 'method' => 'put']) !!}
  {{ csrf_field() }}
  <div class="form-group col-sm-10">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', old('password'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::number('age', old('age'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('location_id', 'Location:') !!}
    {!! Form::select('location_id', $location_list, 'null', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('profile_img', 'Profile image:') !!}
    {!! Form::file('profile_img', ['class' => 'form-control']) !!}
  </div>
  <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Edit', ['class' => 'btn btn-primary btn-wide']) !!}
    {!! Form::close() !!}
  </div>
</div>
<div class="mt-4">
  <p>※Press the button to unsubscribe → {!! link_to_route('account', 'Delete account', ['id' => $user->id], ['class' => 'btn btn-sm btn-danger']) !!}</p>
</div>

@endsection