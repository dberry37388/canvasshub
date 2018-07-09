@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @component('components.card')

                @slot('title')
                    Please Verify Your Account
                @endslot

                <p>
                    Your email address has not been verified. We sent an email to {{$currentUser->email}},
                    containing a link to verify your account. If you did not receive this email, please
                    <a href="{{ route('activate-resend') }}">click here</a> to have it resent.
                </p>

            @endcomponent
        </div>
    </div>
</div>
@endsection
