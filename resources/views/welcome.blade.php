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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

    @auth
        @if ($user->isClient())
            @include('client._ui.navbar')
        @else ($user->isExpert())
            @include('expert._ui.navbar')
        @endif
    @else
        @include('guest._ui.navbar')
    @endauth


    <!-- Navigation -->


    @include('hero')

    <div class="container">
        @include('banner')
        @include('job-listings-section')
        @include('quick-guide')
    </div>

    @include('features')


    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>