<div class="card h-100 shadow-sm border-0 job-card {{ $jobListing->status === 'closed' ? 'bg-dark-subtle' : '' }}">
    <div class="card-body d-flex flex-column p-3 p-lg-4">
        <div class="mb-auto">
            <h5 class="card-title fw-bold text-truncate mb-2">{{ $jobListing->title }}</h5>
            <p class="card-text text-muted mb-2 small text-truncate">{{ $jobListing->category }}</p>
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <span class="badge bg-secondary text-capitalize">{{ $jobListing->job_type }}</span>
                @if ($jobListing->status === 'closed')
                    <span class="badge bg-danger"><i class="fas fa-lock me-1"></i>Closed</span>
                @else
                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Open</span>
                @endif
            </div>
            <div class="d-flex align-items-center mb-3">
                <strong class="me-1 text-nowrap">₱{{ number_format($jobListing->salary ?? 0, 2) }}</strong>
                @if ($jobListing->rate)
                    <span class="text-muted small">({{ ucfirst($jobListing->rate) }})</span>
                @endif
            </div>

            <div class="card-info mb-3">
                <div class="d-flex align-items-center text-muted small mb-1">
                    <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                    <span class="text-truncate">{{ $jobListing->location }}</span>
                </div>
                <div class="d-flex align-items-center text-muted small mb-1">
                    <i class="fas fa-calendar-alt me-2 text-secondary"></i>
                    <span class="text-nowrap">Posted {{ $jobListing->created_at->format('M d, Y') }}</span>
                </div>
                <div class="d-flex align-items-center text-muted small mb-1">
                    <i class="fas fa-users me-2 text-secondary"></i>
                    <span class="text-nowrap">Applications:
                        <strong>{{ $jobListing->jobApplications()->count() }}</strong></span>
                </div>
                <div class="d-flex align-items-center text-muted small">
                    <i class="fas fa-clipboard-list me-2 text-secondary"></i>
                    <span class="text-nowrap">Vacancies: <strong>{{ $jobListing->vacancies }}</strong></span>
                </div>
            </div>

            <!-- Status-wise Count -->
            <div class="application-stats mb-3">
                <div class="d-flex flex-wrap gap-1">
                    <span class="badge bg-warning" data-bs-toggle="tooltip" title="Pending Applications">
                        <i
                            class="fas fa-clock me-1"></i>{{ $jobListing->jobApplications()->where('status', 'pending')->count() }}
                    </span>
                    <span class="badge bg-danger" data-bs-toggle="tooltip" title="Rejected Applications">
                        <i
                            class="fas fa-times-circle me-1"></i>{{ $jobListing->jobApplications()->where('status', 'rejected')->count() }}
                    </span>
                    <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Cancelled Applications">
                        <i
                            class="fas fa-ban me-1"></i>{{ $jobListing->jobApplications()->where('status', 'cancelled')->count() }}
                    </span>
                    <span class="badge bg-success" data-bs-toggle="tooltip" title="Accepted Applications">
                        <i
                            class="fas fa-check-circle me-1"></i>{{ $jobListing->jobApplications()->where('status', 'accepted')->count() }}
                    </span>
                </div>
            </div>
        </div>

        @php
            $application = $jobListing->jobApplications->first();
        @endphp

        <div class="card-actions mt-auto">
            @if ($jobListing->has_applied)
                <a href="{{ route('expert.job-applications.show', $application) }}" class="btn btn-warning w-100 mb-2">
                    <i class="fas fa-eye me-1"></i> View Application
                </a>
            @endif

            <button class="btn btn-info btn-sm w-100" data-bs-toggle="modal"
                data-bs-target="#viewJobModal{{ $jobListing->id }}">
                <i class="fas fa-info-circle me-1"></i> Show More
            </button>
        </div>
    </div>
</div>