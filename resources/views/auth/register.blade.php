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

                <h4 class="text-center fw-bold mb-1">Create an Account</h4>
                <p class="text-center text-muted small mb-4">Join Eksperto and start your journey</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold">Full Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autofocus placeholder="Enter your name">
                        @error('name')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold">Select Your Role</label>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">Choose your role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role Description -->
                    <div id="role-description"
                        class="alert bg-info bg-opacity-10 text-primary d-none text-center small mb-3 border-0"></div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold">Password</label>
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

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required placeholder="Re-enter your password">
                            <button class="btn btn-outline-secondary password-toggle border-start-1" type="button">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        Create Account
                    </button>
                </form>

                <div class="text-center">
                    <p class="small text-muted mb-0">Already have an account?</p>
                    <a class="text-primary small text-decoration-none" href="{{ route('login') }}">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const roleSelect = document.getElementById("role");
                const roleDescription = document.getElementById("role-description");

                const roleInfo = {
                    client: "Clients can post job listings and hire experts.",
                    expert: "Experts can apply for jobs and provide services.",
                    peso: "PESO (Public Employment Service Office) manages job postings and applications.",
                    admin: "Admins have full control over the platform.",
                };

                function updateRoleDescription() {
                    const selectedRole = roleSelect.value;
                    if (selectedRole && roleInfo[selectedRole]) {
                        roleDescription.textContent = roleInfo[selectedRole];
                        roleDescription.classList.remove("d-none");
                    } else {
                        roleDescription.classList.add("d-none");
                    }
                }

                roleSelect.addEventListener("change", updateRoleDescription);
                updateRoleDescription(); // Initialize in case of old value

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
