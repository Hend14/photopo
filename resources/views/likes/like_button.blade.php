@if (Auth::user()->is_liking($post->id))
{!! Form::open(['route' => ['likes.unlike', $post->id], 'method' => 'delete']) !!}
{!! Form::button('<i class="fas fa-heart"></i>', ['class' => "btn btn-like", 'type' => 'submit']) !!}
{!! Form::close() !!}
@else
{!! Form::open(['route' => ['likes.like', $post->id]]) !!}
{!! Form::button('<i class="far fa-heart"></i>', ['class' => "btn btn-like", 'type' => 'submit']) !!}
{!! Form::close() !!}
@endif