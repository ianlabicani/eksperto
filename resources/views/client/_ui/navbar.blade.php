<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('welcome') }}">
            <span class="h4 mb-0">Eksperto</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('client.dashboard') ? 'active fw-bold' : '' }}"
                        href="{{ route('client.dashboard') }}">
                        <i class="fas fa-table-cells me-1"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('client.job-listings.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('client.job-listings.index') }}">
                        <i class="fas fa-briefcase me-1"></i> My Jobs
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('client.job-applications.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('client.job-applications.index') }}">
                        <i class="fas fa-file-alt me-1"></i> Applications
                    </a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link {{ request()->routeIs('client.job-contracts.*') ? 'active fw-bold' : '' }}"
                        href="{{ route('client.job-contracts.index') }}">
                        <i class="fas fa-file-contract me-1"></i> Contracts
                    </a>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                            style="width: 35px; height: 35px;">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <span class="ms-2">Profile</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2 {{ request()->routeIs('client.profile.index') ? 'active' : '' }}"
                                href="{{ route('client.profile.index') }}">
                                <i class="fas fa-user-edit me-2"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
