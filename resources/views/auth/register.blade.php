@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                @component('components.card')

                    <div class="text-center mb-3">
                        <h1 class="mb-0">Create your CanvassHub Account</h1>
                    </div>

                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form-control-lg"
                                   name="name" value="{{ old('name') }}" autofocus required placeholder="{{ __('Name') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg"
                                   name="email" value="{{ old('email') }}" autofocus required placeholder="{{ __('Email Address') }}">
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
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

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} form-control-lg"
                                   name="password_confirmation" value="{{ old('password_confirmation') }}" autofocus required placeholder="{{ __('Retype Password') }}">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Create Account') }}
                                </button>
                            </div>
                        </div>

                        <div class="content-divider text-muted form-group">
                            <span>Already have an account?</span>
                        </div>

                        <a href="{{ route('login') }}" class="btn btn-light btn-block content-group">Sign In Instead</a>
                    </form>
                @endcomponent
            </div>
        </div>
    </div>
@endsection
