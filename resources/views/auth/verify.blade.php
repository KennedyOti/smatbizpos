@extends('layouts.app')

@section('content')

<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">

    <div class="fomr-group">
        @csrf
    </div>

    <div class="form-group">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
    </div>

    <div class="form-group text-center">
        <a class="btn-link" href="{{ route('login') }}">
            {{ ('click here to request another') }}
        </a>
    </div>

</form>


@endsection