    @if (count($posts) > 0)
    <ul class="list-unstyled">
        <div id="app">

            @foreach ($posts as $post)
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
                        <img class="post-img" src="{{ Storage::disk(config('filesystems.default'))->url($post->post_img) }}"  width="auto"  height="200px">
                        @endif
                    </div>
                        <p>{!! link_to_route('posts.show', '詳細', ['post' => $post]) !!}</p>
                    <span class="text-muted">posted at {{ $post->created_at }}</span>
                </div>
            </li>
            @endforeach
        </div>
    </ul>
    {{ $posts->links('pagination::bootstrap-4') }}
    @endif