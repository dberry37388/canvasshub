@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            @component('components.card')

                <div class="text-center mb-3">
                    <h1 class="mb-0">Sign In</h1>
                    <span class="d-block text-muted">With your CanvassHub account.</span>
                </div>

                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Sign In') }}">
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

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg"
                               name="password" value="{{ old('password') }}" autofocus required placeholder="{{ __('Password') }}">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                    </div>

                    <div class="content-divider text-muted form-group">
                        <span>Don't have an account?</span>
                    </div>

                    <a href="{{ route('register') }}" class="btn btn-light btn-block content-group">Sign up</a>
                </form>
            @endcomponent
        </div>
    </div>
</div>
@endsection
