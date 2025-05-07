@extends('client.shell')

@section('client-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1">
                    <i class="fas fa-briefcase me-2"></i>Job Listings
                </h2>
                <p class="text-muted mb-md-0">Manage your job postings and find the perfect experts</p>
            </div>

            <div class="d-flex flex-column flex-sm-row mt-3 mt-md-0 gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="jobSearch" class="form-control bg-light border-start-0"
                           placeholder="Search job listings...">
                </div>
                <a href="{{ route('client.job-listings.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Post New Job
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <div class="d-flex">
                    <i class="fas fa-check-circle my-auto me-2"></i>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Job Listings Summary -->
        <div class="row g-4 mb-4">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-primary bg-opacity-10" style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-briefcase text-primary fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Total Jobs</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">{{ $jobListings->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-success bg-opacity-10" style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-success bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-check-circle text-success fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Active Jobs</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">{{ $jobListings->where('status', 'open')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-warning bg-opacity-10" style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-file-alt text-warning fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Applications</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">{{ $totalApplications ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-info bg-opacity-10" style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-info bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-file-contract text-info fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Contracts</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">{{ $totalContracts ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter tabs with scrolling on mobile -->
        <div class="mb-4 w-100 overflow-auto pb-2">
            <ul class="nav nav-tabs flex-nowrap" id="jobTabs" role="tablist" style="min-width: 500px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-status="all">
                        All <span class="badge rounded-pill bg-secondary ms-1">{{ $jobListings->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="open-tab" data-bs-toggle="tab" data-status="open">
                        Open <span class="badge rounded-pill bg-success ms-1">{{ $jobListings->where('status', 'open')->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="filled-tab" data-bs-toggle="tab" data-status="filled">
                        Filled <span class="badge rounded-pill bg-info ms-1">{{ $jobListings->where('status', 'filled')->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="closed-tab" data-bs-toggle="tab" data-status="closed">
                        Closed <span class="badge rounded-pill bg-danger ms-1">{{ $jobListings->where('status', 'closed')->count() }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Job Listings Grid -->
        <div class="row g-3 g-md-4" id="jobListingsGrid">
            @forelse($jobListings as $jobListing)
                <div class="col-12 col-sm-6 col-lg-4 job-item" data-status="{{ $jobListing->status }}">
                    <div class="card h-100 border-0 shadow-sm position-relative overflow-hidden">
                        @php
                            $statusColor = match($jobListing->status) {
                                'open' => 'success',
                                'filled' => 'info',
                                'closed' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <div class="position-absolute bg-{{ $statusColor }} bg-opacity-10"
                             style="width: 8px; height: 100%; left: 0; top: 0;"></div>

                        <div class="card-header border-0 bg-white d-flex justify-content-between align-items-center py-3 ps-4">
                            <div class="text-truncate pe-2">
                                <h5 class="card-title mb-0 fw-bold text-truncate">
                                    {{ $jobListing->title }}
                                </h5>
                                <div class="text-muted small">
                                    <i class="fas fa-tag me-1"></i> {{ $jobListing->category }}
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <a href="{{ route('client.job-listings.show', $jobListing->id) }}" class="dropdown-item py-2">
                                            <i class="fas fa-eye text-primary me-2"></i> View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('client.job-listings.edit', $jobListing->id) }}" class="dropdown-item py-2">
                                            <i class="fas fa-edit text-warning me-2"></i> Edit Job
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('client.job-listings.show-with-applications', $jobListing->id) }}" class="dropdown-item py-2">
                                            <i class="fas fa-file-alt text-info me-2"></i> View Applications
                                        </a>
                                    </li>
                                    @if($jobListing->status == 'open')
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button type="button" class="dropdown-item py-2 text-danger"
                                               onclick="closeJobListing({{ $jobListing->id }})">
                                            <i class="fas fa-times-circle me-2"></i> Close Job
                                        </button>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="card-body ps-4">
                            <div class="mb-3">
                                <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} py-2 px-3 mb-2">
                                    <i class="fas fa-circle me-1 small"></i>
                                    {{ ucfirst($jobListing->status) }}
                                </span>

                                <p class="card-text text-muted mb-3 mt-2 job-description">
                                    {{ \Illuminate\Support\Str::limit($jobListing->description, 100) }}
                                </p>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    @foreach(explode(',', $jobListing->skills_required) as $index => $skill)
                                        @if($index < 3)
                                            <span class="badge bg-light text-dark py-2 px-3">{{ trim($skill) }}</span>
                                        @elseif($index == 3)
                                            <span class="badge bg-secondary py-2 px-3">+{{ count(explode(',', $jobListing->skills_required)) - 3 }}</span>
                                        @else
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="row g-3 small">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <div>
                                            <div class="text-muted">Rate</div>
                                            <div class="fw-medium">₱{{ number_format($jobListing->rate_per_hour, 2) }}/hr</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-primary me-2"></i>
                                        <div>
                                            <div class="text-muted">Vacancies</div>
                                            <div class="fw-medium">{{ $jobListing->vacancies }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt text-warning me-2"></i>
                                        <div>
                                            <div class="text-muted">Applications</div>
                                            <div class="fw-medium">{{ $jobListing->jobApplications->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-info me-2"></i>
                                        <div>
                                            <div class="text-muted">Posted</div>
                                            <div class="fw-medium">{{ $jobListing->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-top-0 ps-4 pb-3">
                            <div class="d-grid gap-2 d-sm-flex">
                                <a href="{{ route('client.job-listings.show', $jobListing->id) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="fas fa-eye me-1"></i> Details
                                </a>
                                <a href="{{ route('client.job-listings.show-with-applications', $jobListing->id) }}"
                                   class="btn btn-sm btn-primary flex-fill">
                                    <i class="fas fa-file-alt me-1"></i>
                                    Applications <span class="badge bg-white text-primary ms-1">{{ $jobListing->jobApplications->count() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="fw-bold text-muted">No job listings found</h5>
                            <p class="text-muted mb-4">Start by creating a new job listing to find experts</p>
                            <a href="{{ route('client.job-listings.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Post New Job
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Hidden form for job listing actions -->
    <form id="job-action-form" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

@push('scripts')
<script>
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('jobSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const items = document.querySelectorAll('.job-item');

                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Tab filtering
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(tab => {
            tab.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                const items = document.querySelectorAll('.job-item');

                // Set active class
                tabButtons.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                items.forEach(item => {
                    if (status === 'all' || item.getAttribute('data-status') === status) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });

    // Close job listing function
    function closeJobListing(id) {
        if (confirm('Are you sure you want to close this job listing? This will prevent new applications.')) {
            const form = document.getElementById('job-action-form');
            form.action = `/client/job-listings/${id}/update-status`;

            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = 'closed';
            form.appendChild(statusInput);

            form.submit();
        }
    }
</script>

<style>
    @media (max-width: 576px) {
        .job-description {
            height: auto;
            max-height: 48px;
            overflow: hidden;
        }
    }

    @media (min-width: 577px) {
        .job-description {
            height: 48px;
            overflow: hidden;
        }
    }
</style>
@endpush

@endsection
