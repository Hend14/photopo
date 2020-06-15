<div class="card">
    <div class="d-flex">
        <div class="">
          @if ($user->profile_img === null)
          <p>( no image )</p>
          @else
          <img class="user-img" src="{{ Storage::disk(config('s3'))->url($user->profile_img) }}"> 
          @endif
        </div>
          <div class="card-body">
        <div class="pt-2">
          <h5 class=""><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></h5>
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
         <div>
             @if(Auth::id() == $user->id) 
            {!! link_to_route('users.edit', 'Account Settings', ['user' => $user], ['class' => 'btn btn-md btn-secondary']) !!} 
            @else 
            @include('user_follow.follow_button') 
            @endif
         </div>
    </div>
</div>