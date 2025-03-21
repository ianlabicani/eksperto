<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eksperto - Find & Hire Experts</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-light">

    <!-- Navigation -->
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

    <!-- Hero Section -->
    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="fw-bold">Find & Hire Experts Easily</h1>
            <p class="lead">Connect with skilled professionals and get your projects done efficiently.</p>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg text-primary fw-bold">Join Now</a>
                <a href="#features" class="btn btn-outline-light btn-lg">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Why Choose Eksperto?</h2>
            <p class="text-muted">A trusted platform for clients and professionals.</p>
        </div>

        <div class="row text-center">
            <div class="col-md-4 d-flex">
                <div class="card shadow-sm h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Verified Experts</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Work with top-rated professionals in your industry.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card shadow-sm h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Secure Transactions</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Safe and transparent payment processing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card shadow-sm h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Our team is here to assist you at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-dark text-white py-3 text-center">
        <p class="mb-0">&copy; 2025 Eksperto. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
