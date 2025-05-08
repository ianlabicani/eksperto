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
                <p class="text-center text-muted small mb-4">Create a new password for your account</p>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $request->email) }}" required autofocus
                            autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold">New Password</label>
                        <div class="input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Enter new password">
                            <button class="btn btn-outline-secondary password-toggle border-start-1" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Re-enter new password">
                            <button class="btn btn-outline-secondary password-toggle border-start-1" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            @error('password_confirmation')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        Reset Password
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

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Password toggle visibility
                const toggleButtons = document.querySelectorAll('.password-toggle');
                toggleButtons.forEach(button => {
                    button.addEventListener('click', function () {
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
                });
            });
        </script>
    @endpush
@endsection
