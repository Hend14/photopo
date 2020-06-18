<ul class="nav nav-tabs">
      <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">Posts</a></li>
      <li class="nav-item"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">Followings</a></li>
      <li class="nav-item"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">Followers</a></li>
      <li class="nav-item"><a href="{{ route('users.likes', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/likes') ? 'active' : '' }}">Likes</a></li>
    </ul>