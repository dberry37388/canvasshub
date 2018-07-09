<div class="card">
    <div class="card-header header-elements-inline">
        @if (isset($title))
            <h1 class="card-title">
                {{ $title }}
            </h1>
        @endif

        @if (isset($headerElements))
            <div class="header-elements">
                {{ $headerElements }}
            </div>
        @endif
    </div>

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
