@extends('client.shell')

@section('client-content')
    <div class="container py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="display-6 mb-2">Welcome back, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0 lead">Manage your job listings and find the perfect expert for your projects.
                                </p>
                            </div>
                            <div class="d-none d-md-block">
                                <i class="fas fa-rocket fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="fas fa-briefcase text-light"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="card-subtitle text-muted mb-1">Active Jobs</h6>
                                <h2 class="card-title mb-0">{{ $activeJobsCount ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                <i class="fas fa-file-alt text-warning"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="card-subtitle text-muted mb-1">Applications</h6>
                                <h2 class="card-title mb-0">{{ $applicationsCount ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                <i class="fas fa-file-contract text-success"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="card-subtitle text-muted mb-1">Active Contracts</h6>
                                <h2 class="card-title mb-0">{{ $activeContractsCount ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                <i class="fas fa-clock text-info"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="card-subtitle text-muted mb-1">Pending Reviews</h6>
                                <h2 class="card-title mb-0">{{ $pendingReviewsCount ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card no-hover">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('client.job-listings.create') }}"
                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-plus"></i>
                                    <span>Post New Job</span>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('client.job-applications.index') }}"
                                    class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-file-alt"></i>
                                    <span>View Applications</span>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('client.job-contracts.index') }}"
                                    class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-file-contract"></i>
                                    <span>Manage Contracts</span>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <a href="{{ route('client.profile.index') }}"
                                    class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection