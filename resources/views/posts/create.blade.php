<aside class=" pl-4 pr-4 col-sm-6">
  {!! Form::model($user, ['route' => ['posts.store'], 'files' => true, 'method' => 'post']) !!}
  {{ csrf_field() }}
  <div class="form-group">
    {!! Form::label('content', 'Text:') !!}
    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('post_img', 'image:') !!}
    {!! Form::file('post_img', ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Post', ['class' => 'btn btn-secondary btn-block']) !!}
  {!! Form::close() !!}
</aside>