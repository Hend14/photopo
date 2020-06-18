<div class="profile">
  <div class="prf-body">
    <div class="prf-img">
      @if ($user->profile_img === null)
      <div class="no-img">
        <p>no image</p>
      </div>
      @else
      <img class="user-img" src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}">
      @endif
    </div>
    <div class="prf-text">
      <h3><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></h3>
      @if ($user->age === null)
      <p>Age : 未設定</p>
      @else
      <p>Age : {{ $user->age}}</p>
      @endif @if ($user->location_id === null)
      <p>Location : 未設定</p>
      @else
      <p>Location : {{ $user->location->prefecture }}</p>
      @endif
    </div>
  </div>
  <div class="prf-btn">
    @if(Auth::id() == $user->id)
    <a href="{!! route('users.edit',['user' => $user]) !!}" class="btn btn-edit"><i class="fas fa-user-edit"></i></a>
    @else
    @include('user_follow.follow_button')
    @endif
  </div>
</div>