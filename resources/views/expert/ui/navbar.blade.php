<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('expert.dashboard') }}">Eksperto</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expert.job-listings.index') }}">
                        <i class="fas fa-briefcase"></i> Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expert.job-applications.index') }}">
                        <i class="fas fa-file-alt"></i> Applications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expert.job-contracts.index') }}">
                        <i class="fas fa-file-contract"></i> Contracts
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline ">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>