@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('Users') }}</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>img</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></td>
                        @if ($user->age === null)
                            <td>未設定</td>
                            @else
                            <td>{{ $user->age}}</td>
                        @endif
                        @if ($user->location_id === null)
                            <td>未設定</td>
                            @else
                            <td>{{ $user->location->prefecture }}</td>
                        @endif
                        @if ($user->profile_img === null)
                            <td>未設定</td>
                        @else
                            <td><img src="/storage/userImg/{{ $user->id }}_profile.jpg" width="auto" height="60px"></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection