@extends('layout')
@section('title')
    Login
@endsection
@section('content')
    <div class="container h-100">
        @foreach($errors->all() as $message)
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
        @endforeach
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/login/discord/" class="btn btn-block btn-discord"><i class="fab fa-discord"></i> Login / Register with Discord</a>
                        <br/>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="id" type="number" class="form-control mb-2 @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus placeholder="Enter Discord ID">
                            @error('id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            <input id="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            <div class="form-group form-check custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check">{{ __('Remember Me') }}</label>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <div class="separator mt-4"><span>Don't have an account?</span></div>
                        <a class="btn btn-default btn-block" href="/register" role="button">Register</a>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pcontent')
<div class="site-content" role="main">
    <section class="bg-image px-2 px-md-0 py-md-7" ya-style="background-color: #464242">
        <img class="background" src="/img/discord-cover.png" alt="Plasma Gaming Logo">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
                    <div class="card mb-0 border-0">
                        <div class="card-header">
                            <h5 class="card-title">Login to your account</h5>
                        </div>
                        <div class="card-body p-3">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="password" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group form-check custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="check">{{ __('Remember Me') }}</label>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </form>
                            <div class="separator mt-4"><span>Don't have an account?</span></div>
                            <a class="btn btn-default btn-block" href="/register" role="button">Register</a>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
