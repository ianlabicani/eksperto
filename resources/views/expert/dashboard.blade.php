@extends('expert.shell')

@section('expert-content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h3 mb-0 fw-bold text-primary">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-muted mt-2">Your expert dashboard provides access to all platform features.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-briefcase text-primary"></i>
                        </div>
                        <h2 class="h5 mb-0 fw-bold">Available Jobs</h2>
                    </div>
                    <p class="card-text">Browse available job opportunities matched to your expertise.</p>
                    <a href="{{ route('expert.job-listings.index') }}" class="btn btn-primary mt-2">View Jobs</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-file-alt text-primary"></i>
                        </div>
                        <h2 class="h5 mb-0 fw-bold">My Applications</h2>
                    </div>
                    <p class="card-text">Track the status of your job applications in one place.</p>
                    <a href="{{ route('expert.job-applications.index') }}" class="btn btn-primary mt-2">View
                        Applications</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-file-contract text-primary"></i>
                        </div>
                        <h2 class="h5 mb-0 fw-bold">Active Contracts</h2>
                    </div>
                    <p class="card-text">Manage your active contracts and project deliverables.</p>
                    <a href="{{ route('expert.job-contracts.index') }}" class="btn btn-primary mt-2">View Contracts</a>
                </div>
            </div>
        </div>
    </div>
@endsection
