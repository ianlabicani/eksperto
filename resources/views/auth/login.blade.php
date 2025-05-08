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

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-3 text-center small">
                        {{ session('status') }}
                    </div>
                @endif

                <h4 class="text-center fw-bold mb-1">Welcome Back!</h4>
                <p class="text-center text-muted small mb-4">Log in to continue</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label small fw-semibold">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small text-primary" href="{{ route('password.request') }}">
                                    Forgot?
                                </a>
                            @endif
                        </div>
                        <div class="input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                placeholder="Enter your password">
                            <button class="btn btn-outline-secondary password-toggle border-start-1" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label text-muted small" for="remember_me">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        Log in
                    </button>
                </form>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="small text-muted mb-2">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                        Create an account
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Password toggle visibility
                const toggleButton = document.querySelector('.password-toggle');
                if (toggleButton) {
                    toggleButton.addEventListener('click', function () {
                        const passwordField = this.parentElement.querySelector('input');
                        const icon = this.querySelector('i');

                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            icon.classList.replace('fa-eye-slash', 'fa-eye');
                        } else {
                            passwordField.type = 'password';
                            icon.classList.replace('fa-eye', 'fa-eye-slash');
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
