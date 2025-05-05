@extends('shell')

@section('content')
    @include('expert._ui.navbar')
    <div class="container">
        @yield('expert-content')
    </div>
@endsection