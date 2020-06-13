@extends('layouts.app')
@section('content')
<h1 class="text-center">Edit My Post</h1>



<div class="media-body">
  <div>
    {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">posted at {{ $post->created_at }}</span>
  </div>
  <div>
    <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
    @if ($post->post_img != null)
    <img src="{{ Storage::disk(config('s3'))->url($post->post_img) }}" , width="auto" , height="200px">
    @endif
  </div>
</div>
<div class=" pl-4 pr-4 col-sm-6">
  {!! Form::model($post, ['route' => ['posts.store', $post->id], 'files' => true, 'method' => 'post']) !!}
  {{ csrf_field() }}
  <div class="form-group">
    {!! Form::label('content', 'Text:') !!}
    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('post_img', 'image:') !!}
    {!! Form::file('post_img', old('post_img'), ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Edit', ['class' => 'btn btn-success btn-block']) !!}
  {!! Form::close() !!}
</div>

@endsection