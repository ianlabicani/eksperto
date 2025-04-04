<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">Eksperto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->isClient())
                            <li class="nav-item">
                                <a href="{{ route('client.dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                            </li>
                        @elseif (Auth::user()->isExpert())
                            <li class="nav-item">
                                <a href="{{ route('expert.dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>