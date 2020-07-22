 @extends('layouts.app')
 @section('content')
 <h1>post詳細</h1>
 <li class="card post-card">
     <div class="card-body">
         <div class="post-title">
             @if ($post->user->profile_img != null)
             <img class="user-post-img" src="{{ Storage::disk(config('filesystems.default'))->url($post->user->profile_img) }}">
             @endif
             <h4>{!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!}</h4>
         </div>
         <div class="post-detail">
             <div>
                 <p class="post-content">{!! nl2br(e($post->content)) !!}</p>
             </div>
             @if ($post->post_img != null)
             <img class="post-img" src="{{ Storage::disk(config('filesystems.default'))->url($post->post_img) }}" width="auto" height="200px">
             @endif
         </div>
         <div id="app">
             <like-component :post-id="{{ json_encode($post->id) }}" :user-id="{{ json_encode($userAuth->id) }}" :default-Liked="{{ json_encode($defaultLiked) }}" :default-Count="{{ json_encode($defaultCount) }}"></like-component>
         </div>
         <div class="mt-2">
             @if (Auth::id() == $post->user_id)
             {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
             {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => "btn", 'type' => 'submit']) !!}
             {!! Form::close() !!}
             @endif
         </div>
         <span class="text-muted">posted at {{ $post->created_at }}</span>
     </div>
 </li>
 @endsection