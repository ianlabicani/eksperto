@extends('shell')

@section('content')

    @auth
        @if ($user->isClient())
            @include('client._ui.navbar')
        @else ($user->isExpert())
            @include('expert._ui.navbar')
        @endif
    @else
        @include('guest._ui.navbar')
    @endauth

    @include('hero')

    <div class="container">
        @include('banner')
        @include('job-listings-section')
        @include('quick-guide')
    </div>

    @include('features')
    @include('footer')

@endsection