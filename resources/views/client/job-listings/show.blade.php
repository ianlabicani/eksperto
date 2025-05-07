@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        <!-- Back Button -->
        <a href="{{ route('client.job-listings.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Job Listings
        </a>

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 fw-bold">{{ $jobListing->title }}</h3>
                    <span class="badge {{ $jobListing->status === 'open' ? 'bg-success' : 'bg-danger' }} fs-6">
                        <i class="fas {{ $jobListing->status === 'open' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        {{ ucfirst($jobListing->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h5 class="fw-bold"><i class="fas fa-align-left text-primary me-2"></i>Description</h5>
                            <div class="bg-light p-3 rounded">
                                {!! nl2br(e($jobListing->description)) !!}
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="fw-bold"><i class="fas fa-clipboard-list text-primary me-2"></i>Requirements</h5>
                            <div class="bg-light p-3 rounded">
                                {!! nl2br(e($jobListing->requirements)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold mb-4">Job Details</h5>

                                <p class="mb-3">
                                    <i class="fas fa-tag text-primary me-2"></i>
                                    <strong>Category:</strong><br>
                                    <span class="ms-4">{{ $jobListing->category }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                    <strong>Salary:</strong><br>
                                    <span class="ms-4">₱{{ number_format($jobListing->salary ?? 0, 2) }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Rate:</strong><br>
                                    <span class="ms-4 text-capitalize">{{ $jobListing->rate }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-briefcase text-primary me-2"></i>
                                    <strong>Job Type:</strong><br>
                                    <span class="ms-4 text-capitalize">{{ $jobListing->job_type }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <strong>Location:</strong><br>
                                    <span class="ms-4">{{ $jobListing->location }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Vacancies:</strong><br>
                                    <span class="ms-4">{{ $jobListing->vacancies }}</span>
                                </p>

                                <p class="mb-3">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <strong>Deadline:</strong><br>
                                    <span
                                        class="ms-4">{{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'N/A' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 mt-4">
                            <a href="{{ route('client.job-listings.show-with-applications', $jobListing->id) }}"
                                class="btn btn-primary">
                                <i class="fas fa-users me-2"></i>View Applications
                            </a>
                            <a href="{{ route('client.job-listings.showWithContracts', $jobListing->id) }}"
                                class="btn btn-success">
                                <i class="fas fa-file-contract me-2"></i>View Contracts
                            </a>
                            <a href="{{ route('client.job-listings.edit', $jobListing->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Job
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
