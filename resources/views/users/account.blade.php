@extends('layouts.app')
@section('content')
<h1>Delete My Account</h1>

<h5 class="text-center mt-4">Delete your Photopo account... Are you sure?</h5>

<div class="text-center">
  {!! link_to_route('softdelete', 'Delete', ['id' => $user->id], ['class' => 'btn btn-lg btn-danger']) !!}
</div>
@endsection