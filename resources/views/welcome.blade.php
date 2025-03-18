<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-light text-dark d-flex flex-column min-vh-100">

    <!-- Navigation -->
    {{-- @include('ui.navigation') --}}

    <header class="container mt-3">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-dark">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="container mt-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h1 class="fw-semibold">Let's get started</h1>
                <p class="text-secondary">
                    Laravel has an incredibly rich ecosystem. <br>We suggest starting with the following.
                </p>

                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-2">
                        <span class="me-2">
                            <span class="d-inline-block bg-secondary rounded-circle"
                                style="width: 10px; height: 10px;"></span>
                        </span>
                        <span>
                            Read the
                            <a href="https://laravel.com/docs" target="_blank"
                                class="fw-medium text-danger">Documentation</a>
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <span class="me-2">
                            <span class="d-inline-block bg-secondary rounded-circle"
                                style="width: 10px; height: 10px;"></span>
                        </span>
                        <span>
                            Watch video tutorials at
                            <a href="https://laracasts.com" target="_blank" class="fw-medium text-danger">Laracasts</a>
                        </span>
                    </li>
                </ul>

                <a href="https://cloud.laravel.com" target="_blank" class="btn btn-dark">Deploy now</a>
            </div>

            <div class="col-lg-5 text-center">
                <div class="bg-danger bg-opacity-25 rounded p-4">
                    <p class="text-danger fw-bold">Your image or other relevant content here</p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>