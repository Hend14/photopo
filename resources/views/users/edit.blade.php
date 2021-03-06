@extends('layouts.app')
@section('content')
<h1>Edit My Account</h1>

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
    {!! Form::label('age', 'Age:') !!}
    {!! Form::number('age', old('age'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('location_id', 'Location:') !!}
    {!! Form::select('location_id', $location_list, old('location_id'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group col-sm-10">
    {!! Form::label('profile_img', 'Profile image:') !!}
    {!! Form::file('profile_img', ['class' => 'form-control']) !!}
    @if($user->profile_img != null)
      Current your image: <img class="user-img" src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}">
    @else
      Current your image: (no image)
    @endif
  </div>
  <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Edit', ['class' => 'btn btn-primary btn-wide']) !!}
    {!! Form::close() !!}
  </div>
</div>
<div class="mt-4">
  {!! link_to_route('account', 'want to unsubuscribe?', ['id' => $user->id]) !!}
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection