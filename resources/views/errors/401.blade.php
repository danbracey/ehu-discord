@extends('layout')
@section('title')
    401
@endsection
@section('content')
    <h2 class="mb-4">401 - Login Required</h2>

    <div class="card mb-4">
        <div class="card-body">
            Login
        </div>
        <div class="card-footer">
            <a href="{{route('login.discord')}}" class="btn btn-lg btn-discord"><i class="fab fa-discord"></i> Login with Discord</a>
        </div>
    </div>
@endsection
