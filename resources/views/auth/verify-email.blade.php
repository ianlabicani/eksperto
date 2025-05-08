@extends('shell')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm border-0 rounded-3 no-hover" style="max-width: 380px; width: 100%;">
            <div class="p-4">
                <!-- Eksperto Logo (Clickable) -->
                <div class="text-center mb-4">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('logo/eksperto-logo.png') }}" alt="Eksperto Logo" class="img-fluid"
                            style="max-width: 70px;">
                    </a>
                </div>

                <h4 class="text-center fw-bold mb-1">Verify Your Email</h4>
                <p class="text-center text-muted small mb-3">
                    We've sent a verification link to your email. Please check your inbox and click the link to continue.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success small text-center mb-3">
                        A new verification link has been sent to your email address.
                    </div>
                @endif

                <div class="mb-3">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
                            Resend Verification Email
                        </button>
                    </form>
                </div>

                <div class="text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-muted small p-0">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
