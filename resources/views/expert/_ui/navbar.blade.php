<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">Eksperto</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expert.dashboard') ? 'active' : '' }}"
                        href="{{ route('expert.dashboard') }}">
                        <i class="fas fa-table-cells"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expert.job-listings.index') ? 'active' : '' }}"
                        href="{{ route('expert.job-listings.index') }}">
                        <i class="fas fa-briefcase"></i> Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expert.job-applications.index') ? 'active' : '' }}"
                        href="{{ route('expert.job-applications.index') }}">
                        <i class="fas fa-file-alt"></i> Applicants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expert.job-contracts.index') ? 'active' : '' }}"
                        href="{{ route('expert.job-contracts.index') }}">
                        <i class="fas fa-file-contract"></i> Contracts
                    </a>
                </li>

                @php
                    $profileRoutes = ['expert.profile.index'];
                @endphp
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  {{ request()->routeIs($profileRoutes) ? 'active' : '' }}"
                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('expert.profile.index') ? 'active' : '' }}"
                                href="{{ route('expert.profile.index') }}">
                                <i class="fas fa-user-edit"></i> Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>