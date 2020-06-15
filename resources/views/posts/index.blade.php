@if (count($posts) > 0)
<ul class="list-unstyled">
    @foreach ($posts as $post)
    <li class="card border-secondary mb-3">
        <div class="card-body">
            <div class="card-title">
                    @if ($post->user->profile_img != null)
                    <img class="mr-2 rounded user-post-img" src="{{ Storage::disk(config('filesystems.default'))->url($post->user->profile_img) }}" width="auto" height="40px">
                    @endif
                    {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!}
                <span class="text-muted">posted at {{ $post->created_at }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <div class="card-text">
                    <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                </div>
                @if ($post->post_img != null)
                <img class="post-img" src="{{ Storage::disk(config('filesystems.default'))->url($post->post_img) }}" , width="auto" , height="200px">
                @endif
            </div>
            <div class="mt-4">
                @if (Auth::id() == $post->user_id)
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
    @endforeach
</ul>
{{ $posts->links('pagination::bootstrap-4') }}
@endif