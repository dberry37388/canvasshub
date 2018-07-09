@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @component('components.card')

                <div class="text-center mb-3">
                    <h1 class="mb-0">Forgot Your Password?</h1>
                    <span class="d-block text-muted">We can help with that!</span>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @else
                    <p class="mb-3">
                        Enter the email address that you used to register below, and we will send
                        you instructions for creating a new password.
                    </p>
                @endif

                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg"
                               name="email" value="{{ old('email') }}" autofocus required placeholder="{{ __('Email Address') }}">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endcomponent
        </div>
    </div>
</div>
@endsection
