@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('password.email') }}">
    <div class="form-group">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>

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
        <button type="submit" class="btn rounded btn-primary text-white w-100">
            {{ __('Send Password Reset Link') }}
        </button>
    </div>

    <div class="form-group text-center">
        <a class="btn-link" href="{{ route('login') }}">
            {{ ('Back to Login') }}
        </a>
    </div>

</form>

@endsection