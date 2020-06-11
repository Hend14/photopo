<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="/storage/userImg/{{ $user->id }}_profile.jpg" width="auto" height="100px">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">posted at {{ $post->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($post->content)) !!}</p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $posts->links('pagination::bootstrap-4') }}