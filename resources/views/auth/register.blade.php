@extends('shell')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    Register
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Name </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Description -->
                        <div id="role-description" class="alert alert-info d-none"></div>

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
                            <label for="password" class="form-label">
                                Password </label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Confirm Password </label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a class="text-decoration-none" href="{{ route('login') }}">
                                Already registered?
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
