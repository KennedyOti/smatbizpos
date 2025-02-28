@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}">

    <div class="form-group">
        @csrf
    </div>

    <div class="form-group">
        <label for="email">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control rounded @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn rounded btn-primary text-white w-100">
            {{ __('Sign In') }}
        </button>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 text-md-start">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            @if (Route::has('password.request'))
            <div class="col-md-6 text-md-end">
                <a class="btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            </div>
            @endif
        </div>
    </div>

    <div class="form-group text-center">
        Not a member?
        <a class="btn-link" href="{{ route('register') }}">
            {{ ('Sign Up') }}
        </a>
    </div>

</form>

@endsection