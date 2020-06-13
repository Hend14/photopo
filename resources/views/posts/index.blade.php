<ul class="list-unstyled">
    @foreach ($posts as $post)
    <li class="media mb-3">
    <img class="mr-2 rounded" src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}" width="auto" height="50px">
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