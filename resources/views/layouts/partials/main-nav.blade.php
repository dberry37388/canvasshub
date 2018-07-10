<div class="navbar navbar-expand-md navbar-dark navbar-lg fixed-top">
    <div class="navbar-brand wmin-0 mr-5">
        <a href="{{ route('home') }}" class="d-inline-block">
            <img src="{{ asset('images/logo-light.png') }}" alt="{{ config('app.name') }}">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-more"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">

        </ul>

        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item">
                    <a class="navbar-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

                <li class="nav-item">
                    <a class="navbar-nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <span>{{ $currentUser->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-lock"></i> {{ __('Logout') }}
                        </a>
                    </div>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </div>
</div>
