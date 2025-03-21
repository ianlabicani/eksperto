@extends('shell')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 border-0 rounded-4" style="max-width: 480px; width: 100%;">

            <!-- Eksperto Logo (Clickable) -->
            <div class="text-center my-3">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('logo/eksperto-logo.png') }}" alt="Eksperto Logo" class="img-fluid"
                        style="max-width: 90px;">
                </a>
            </div>

            <h3 class="text-center fw-bold mb-3">Create an Account</h3>
            <p class="text-center text-muted mb-4">Join Eksperto and start your journey</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-user text-secondary"></i></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autofocus placeholder="Enter your name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-secondary"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Role Selection -->
                <div class="mb-3">
                    <label for="role" class="form-label fw-semibold">Select Your
                        Role</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-user-cog text-secondary"></i></span>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">Choose your role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role Description -->
                <div id="role-description" class="alert alert-info d-none text-center small"></div>

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
                        });
                    </script>
                @endpush

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

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirm
                        Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-lock text-secondary"></i></span>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                            required placeholder="Re-enter your password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="text-decoration-none small text-muted" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Already have an account? Log in
                    </a>
                    <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">
                        <i class="fas fa-user-plus"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection