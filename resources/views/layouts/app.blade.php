<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @routes
</head>
<body class="navbar-top-lg-sm navbar-top">
    <div id="app">
        @include('layouts.partials.main-nav')

        @include('layouts.partials.secondary-nav')

        <div class="page-content">
            <div class="content-wrapper">
                <div class="content">

                    @if ($currentUser && ! $currentUser->is_activated && ! session('success') && ! request()->routeIs('not-active'))
                        <div class="alert alert-warning border-0">
                            <div class="font-weight-semibold">Please Verify Your Account</div>
                            Your email address has not been verified. We sent an email to {{$currentUser->email}},
                            containing a link to verify your account. If you did not receive this email, please
                            <a href="{{ route('activate-resend') }}">click here</a> to have it resent. If you have
                            not verified your account by {{ $currentUser->created_at->addDays(30)->format("F j, Y") }}, your account will be disabled.
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success border-0">
                            An email has been sent to {{$currentUser->email}}, containing a link to verify your account.
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
