@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('password.update') }}">

    <div class="form-group">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
    </div>

    <div class="form-group">
        <label for="email">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control rounded @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control rounded @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control rounded" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn rounded btn-primary text-white w-100">
            {{ __('Reset Password') }}
        </button>
    </div>

</form>

@endsection