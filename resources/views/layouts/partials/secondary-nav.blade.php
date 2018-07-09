@auth
    <div class="navbar navbar-expand-md navbar-light">
        <div class="text-center d-md-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
                Navigation
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-navigation">
            <ul class="navbar-nav navbar-nav-highlight">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="navbar-nav-link">
                        <i class="icon-home4 mr-2"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-nav-highlight ml-md-auto">

            </ul>
        </div>
    </div>
@endauth
