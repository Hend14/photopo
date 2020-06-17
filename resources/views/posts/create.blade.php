<aside class="post-form">
  {!! Form::model($user, ['route' => ['posts.store'], 'files' => true, 'method' => 'post']) !!}
  {{ csrf_field() }}
  <div class="form-group">
    {!! Form::label('content', 'To post something!') !!}
    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'size' => '51x5']) !!}
  </div>
  <div class="form-group">
    {!! Form::file('post_img', ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('Post', ['class' => 'btn btn-success btn-block']) !!}
  {!! Form::close() !!}
</aside>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif