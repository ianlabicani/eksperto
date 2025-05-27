@extends('shell')

@section('content')
    @include('peso._ui.navbar')
    <div class="container py-4">
        <div class="content-wrapper">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3 fs-4"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                        <div>{{ session('warning') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-3 fs-4"></i>
                        <div>{{ session('info') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('peso-content')
        </div>
    </div>
@endsection