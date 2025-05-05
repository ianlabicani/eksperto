@extends('shell')

@section('content')
    @include('client._ui.navbar')
    <div class="container">
        @yield('client-content')
    </div>
@endsection