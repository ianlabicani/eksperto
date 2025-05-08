<div class="card no-hover border-0 shadow-sm rounded-3 mb-4">
    <div class="card-header bg-white py-3 border-0">
        <h3 class="mb-0 fw-bold fs-5">Profile Settings</h3>
    </div>

    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            <a href="{{ route('expert.profile.index') }}"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center {{ request()->routeIs('expert.profile.index') ? 'active' : '' }}">
                <i class="fas fa-user me-3"></i>
                <span>Personal Information</span>
            </a>
            <a href="{{ route('expert.educational-background.index') }}"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center {{ request()->routeIs('expert.educational-background.index') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap me-3 "></i>
                <span>Educational Background</span>
            </a>
            <a href="{{ route('expert.work-experience.index') }}"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center {{ request()->routeIs('expert.work-experience.index') ? 'active' : '' }}">
                <i class="fas fa-briefcase me-3 "></i>
                <span>Work Experience</span>
            </a>
            <a href="{{ route('expert.expertise.index') }}"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center {{ request()->routeIs('expert.expertise.index') ? 'active' : '' }}">
                <i class="fas fa-tools me-3"></i>
                <span>Expertise</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-certificate me-3 "></i>
                <span>Upload Certificates</span>
                <span class="badge bg-primary bg-opacity-10 text-light ms-auto">Coming Soon</span>
            </a>

            <hr class="my-0">

            <a href="{{ route('expert.change-password.show') }}"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center {{ request()->routeIs('password') ? 'active' : '' }}">
                <i class="fas fa-key me-3 "></i>
                <span>Change Password</span>
            </a>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .custom-active {
            color: #0d6efd;
            font-weight: 600;
        }

        .custom-active:hover {
            color: #0d6efd;
            font-weight: 600;
        }
    </style>
@endpush