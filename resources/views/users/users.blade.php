@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <img class=" user-img mr-2 rounded" src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}" alt="">
                <div class="media-body">
                    <div>
                            {{ $user->name }}
                    </div>
                    <div>
                        <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
                    </div>
                    @include('user_follow.follow_button')
                </div>
            </li>
        @endforeach
    </ul>
    {{ $users->links('pagination::bootstrap-4') }}
@endif