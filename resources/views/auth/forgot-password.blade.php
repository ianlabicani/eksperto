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

                <h4 class="text-center fw-bold mb-1">Reset Password</h4>
                <p class="text-center text-muted small mb-4">Enter your email to receive a password reset link</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success small text-center mb-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label small fw-semibold">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        Send Reset Link
                    </button>
                </form>

                <div class="text-center">
                    <a class="text-primary small text-decoration-none" href="{{ route('login') }}">
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection