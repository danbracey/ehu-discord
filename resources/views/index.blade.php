@extends('layout')
@section('title')
    Login
@endsection
@section('content')
    <h2 class="mb-4">Login</h2>

    <p> Welcome to the EHU Computer Science Discord server! Please login to continue</p>
    <i> By continuing, you certify that you are a current or prospective EHU Student</i>

    <div class="card mb-4">
        <div class="card-body">
            <a href="{{route('login.discord')}}" class="btn btn-lg btn-discord"><i class="fab fa-discord"></i> Login with Discord</a>
        </div>
    </div>
@endsection
