@extends('shell')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 border-0 rounded-4" style="max-width: 420px; width: 100%;">

            <!-- Eksperto Logo (Clickable) -->
            <div class="text-center my-3">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('logo/eksperto-logo.png') }}" alt="Eksperto Logo" class="img-fluid"
                        style="max-width: 90px;">
                </a>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-3 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <h3 class="text-center fw-bold mb-3">Welcome Back!</h3>
            <p class="text-center text-muted mb-4">Log in to continue</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-secondary"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-lock text-secondary"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label text-muted small" for="remember_me">
                        <i class="fas fa-check-square"></i> Remember me
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                            <i class="fas fa-key"></i> Forgot password?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">
                        <i class="fas fa-sign-in-alt"></i> Log in
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="small text-muted">Don't have an account?</p>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-user-plus"></i> Create an account
                </a>
            </div>
        </div>
    </div>
@endsection
