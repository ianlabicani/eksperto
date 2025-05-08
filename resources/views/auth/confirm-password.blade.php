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

                <h4 class="text-center fw-bold mb-1">Confirm Password</h4>
                <p class="text-center text-muted small mb-4">
                    Please confirm your password to continue
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold">Password</label>
                        <div class="input-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Enter your password">
                            <button class="btn btn-outline-secondary password-toggle border-start-1" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Confirm
                    </button>
                </form>
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
