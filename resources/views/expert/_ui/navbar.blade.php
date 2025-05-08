<nav class="navbar navbar-expand-lg sticky-top bg-white border-0" style="box-shadow: 0 2px 10px rgba(0,0,0,.08);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <span class="fw-bold"
                style="background: linear-gradient(45deg, #2563eb, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Eksperto</span>
        </a>

        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-pill transition-all {{ request()->routeIs('expert.dashboard') ? 'active bg-primary bg-opacity-10 fw-medium' : '' }}"
                        href="{{ route('expert.dashboard') }}">
                        <i class="fas fa-table-cells me-2 opacity-75"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-pill transition-all {{ request()->routeIs('expert.job-listings.index') ? 'active bg-primary bg-opacity-10 fw-medium' : '' }}"
                        href="{{ route('expert.job-listings.index') }}">
                        <i class="fas fa-briefcase me-2 opacity-75"></i>Jobs
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-pill transition-all {{ request()->routeIs('expert.job-applications.index') ? 'active bg-primary bg-opacity-10 fw-medium' : '' }}"
                        href="{{ route('expert.job-applications.index') }}">
                        <i class="fas fa-file-alt me-2 opacity-75"></i>Applications
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 rounded-pill transition-all {{ request()->routeIs('expert.job-contracts.index') ? 'active bg-primary bg-opacity-10 fw-medium' : '' }}"
                        href="{{ route('expert.job-contracts.index') }}">
                        <i class="fas fa-file-contract me-2 opacity-75"></i>Contracts
                    </a>
                </li>

                @php
                    $profileRoutes = ['expert.profile.index'];
                @endphp
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-3 py-2 rounded-pill transition-all {{ request()->routeIs($profileRoutes) ? 'active bg-primary bg-opacity-10 fw-medium' : '' }}"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2 opacity-75"></i>Profile
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 rounded-4 mt-2 p-2"
                        style="box-shadow: 0 4px 24px rgba(0,0,0,.08);" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2 px-3 rounded-3 mb-1 {{ request()->routeIs('expert.profile.index') ? 'active' : '' }}"
                                href="{{ route('expert.profile.index') }}">
                                <i class="fas fa-user-edit me-2 opacity-75"></i>Profile Settings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-2 opacity-25">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-3 rounded-3 text-danger">
                                    <i class="fas fa-sign-out-alt me-2 opacity-75"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .transition-all {
        transition: all 0.2s ease-in-out;
    }

    .nav-link:not(.active):hover {
        background-color: #f8fafc;
    }

    .dropdown-item:hover {
        background-color: #f8fafc;
    }

    .dropdown-item.active {
        background-color: #eff6ff;
        color: #2563eb;
    }

    @media (max-width: 991.98px) {
        .navbar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 0;
        }

        .dropdown-menu {
            border: none;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0.5rem 0 0 1rem !important;
        }
    }
</style>