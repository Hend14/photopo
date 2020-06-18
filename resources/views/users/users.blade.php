@if (count($users) > 0)
<ul class="list-unstyled">
    @foreach ($users as $user)
    @include('users.card', ['user' =>$user])
    @endforeach
</ul>
{{ $users->links('pagination::bootstrap-4') }}
@endif