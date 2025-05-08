@extends('client.shell')

@section('client-content')
    <div class="container-fluid py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">
                    Your Job Listings
                </h4>
                <p class="text-muted small mb-md-0">Manage your job postings and find the perfect experts</p>
            </div>

            <div class="d-flex flex-column flex-sm-row mt-3 mt-md-0 gap-2">
                <div class="input-group">
                    <input type="text" id="jobSearch" class="form-control" placeholder="Search jobs...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <a href="{{ route('client.job-listings.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> New Job
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <div class="d-flex">
                    <i class="fas fa-check-circle my-auto me-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Job Listings Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card hover border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <i class="fas fa-briefcase text-light"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1">Total Jobs</h6>
                                <h4 class="fw-bold mb-0">{{ $jobListings->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card hover border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1">Active Jobs</h6>
                                <h4 class="fw-bold mb-0">{{ $jobListings->where('status', 'open')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card hover border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <i class="fas fa-file-alt text-warning"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1">Applications</h6>
                                <h4 class="fw-bold mb-0">{{ $totalApplications ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card hover border-0 shadow-sm h-100">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <i class="fas fa-file-contract text-info"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1">Contracts</h6>
                                <h4 class="fw-bold mb-0">{{ $totalContracts ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Filter Tabs -->
        <ul class="nav nav-pills mb-4">
            <li class="nav-item">
                <button class="nav-link active px-3" data-bs-toggle="tab" data-status="all">
                    All <span class="badge bg-secondary ms-1">{{ $jobListings->count() }}</span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-3" data-bs-toggle="tab" data-status="open">
                    Open <span class="badge bg-success ms-1">{{ $jobListings->where('status', 'open')->count() }}</span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-3" data-bs-toggle="tab" data-status="filled">
                    Filled <span class="badge bg-info ms-1">{{ $jobListings->where('status', 'filled')->count() }}</span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-3" data-bs-toggle="tab" data-status="closed">
                    Closed <span class="badge bg-danger ms-1">{{ $jobListings->where('status', 'closed')->count() }}</span>
                </button>
            </li>
        </ul>

        <!-- Job Listings Grid -->
        <div class="row g-3" id="jobListingsGrid">
            @forelse($jobListings as $jobListing)
                <div class="col-12 col-md-6 col-lg-4 job-item" data-status="{{ $jobListing->status }}">
                    <div class="card hover border-0 shadow-sm h-100">
                        @php
                            $statusColor = match ($jobListing->status) {
                                'open' => 'success',
                                'filled' => 'info',
                                'closed' => 'danger',
                                default => 'secondary'
                            };
                            $statusIcon = match ($jobListing->status) {
                                'open' => 'fas fa-check-circle',
                                'filled' => 'fas fa-user-check',
                                'closed' => 'fas fa-times-circle',
                                default => 'fas fa-circle'
                            };
                        @endphp

                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} py-2 px-3">
                                    <i class="{{ $statusIcon }} me-1"></i>
                                    {{ ucfirst($jobListing->status) }}
                                </span>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li>
                                            <a href="{{ route('client.job-listings.show', $jobListing->id) }}"
                                                class="dropdown-item py-2">
                                                <i class="fas fa-eye text-primary me-2"></i> View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('client.job-listings.edit', $jobListing->id) }}"
                                                class="dropdown-item py-2">
                                                <i class="fas fa-edit text-warning me-2"></i> Edit Job
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('client.job-listings.show-with-applications', $jobListing->id) }}"
                                                class="dropdown-item py-2">
                                                <i class="fas fa-file-alt text-info me-2"></i> View Applications
                                            </a>
                                        </li>
                                        @if($jobListing->status == 'open')
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item py-2 text-danger close-job-btn"
                                                    data-job-id="{{ $jobListing->id }}">
                                                    <i class="fas fa-times-circle me-2"></i> Close Job
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <h5 class="card-title fw-bold mb-2">{{ $jobListing->title }}</h5>
                            <div class="text-muted small mb-3">
                                <i class="fas fa-tag me-1"></i> {{ $jobListing->category }} <span class="mx-2">•</span>
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $jobListing->location ?: 'Remote' }}
                            </div>

                            <p class="card-text small text-muted mb-3">
                                {{ \Illuminate\Support\Str::limit($jobListing->description, 100) }}
                            </p>

                            <div class="row g-2 text-muted small mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <span>₱{{ number_format($jobListing->salary, 2) }}/{{ $jobListing->rate }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-primary me-2"></i>
                                        <span>{{ $jobListing->vacancies }} position(s)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="small">
                                    <span class="text-muted">Posted:</span> {{ $jobListing->created_at->format('M d, Y') }}
                                </div>
                                <div class="small">
                                    <span class="badge bg-light text-primary">
                                        <i class="fas fa-file-alt me-1"></i> {{ $jobListing->jobApplications->count() }}
                                        applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-3 border-0">
                            <div class="d-flex gap-2">
                                <a href="{{ route('client.job-listings.show', $jobListing->id) }}"
                                    class="btn btn-sm btn-outline-primary flex-grow-1">
                                    View Details
                                </a>
                                <a href="{{ route('client.job-listings.edit', $jobListing->id) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <img src="{{ asset('images/empty.svg') }}" alt="No Jobs Found" class="img-fluid mb-3"
                                style="max-width: 200px">
                            <h4 class="fw-bold text-muted mb-2">No Job Listings Yet</h4>
                            <p class="text-muted mb-3">Start posting jobs to find the perfect experts for your needs.</p>
                            <a href="{{ route('client.job-listings.create') }}" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-2"></i>Post Your First Job
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal for closing job -->
    <div class="modal fade" id="closeJobModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Close Job Listing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to close this job listing? This will mark it as no longer accepting
                        applications.</p>
                    <form id="closeJobForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="closed">
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmCloseBtn">
                        <i class="fas fa-times-circle me-1"></i> Close Job
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Filter job listings
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(button => {
                button.addEventListener('click', function () {
                    const status = this.getAttribute('data-status');

                    // Update active tab
                    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                        tab.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Filter job listings
                    document.querySelectorAll('.job-item').forEach(item => {
                        if (status === 'all' || item.getAttribute('data-status') === status) {
                            item.classList.remove('d-none');
                        } else {
                            item.classList.add('d-none');
                        }
                    });
                });
            });

            // Search functionality
            document.getElementById('jobSearch').addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();

                document.querySelectorAll('.job-item').forEach(item => {
                    const title = item.querySelector('.card-title').textContent.toLowerCase();
                    const description = item.querySelector('.card-text').textContent.toLowerCase();

                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            });

            // Close job functionality
            document.addEventListener('DOMContentLoaded', function () {
                // Get all close job buttons
                const closeButtons = document.querySelectorAll('.close-job-btn');
                const closeJobForm = document.getElementById('closeJobForm');
                const confirmCloseBtn = document.getElementById('confirmCloseBtn');
                const closeJobModal = new bootstrap.Modal(document.getElementById('closeJobModal'));

                // Add click event to all close job buttons
                closeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const jobId = this.getAttribute('data-job-id');
                        closeJobForm.action = `/client/job-listings/${jobId}/update-status`;

                        // Show modal
                        closeJobModal.show();
                    });
                });

                // Handle confirm close button
                confirmCloseBtn.addEventListener('click', function () {
                    // Disable button and show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Closing...';

                    // Submit the form
                    closeJobForm.submit();
                });
            });
        </script>
    @endpush
@endsection