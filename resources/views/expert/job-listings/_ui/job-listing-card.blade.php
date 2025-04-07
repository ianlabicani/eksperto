<div class="card shadow-lg border-0 job-card {{ $jobListing->status === 'closed' ? 'bg-dark-subtle' : '' }}">
    <div class="card-body">
        <h5 class="card-title fw-bold">{{ $jobListing->title }}</h5>
        <p class="card-text text-muted mb-1">{{ $jobListing->category }}</p>
        <p class="card-text">
            <span class="badge bg-secondary text-capitalize">{{ $jobListing->job_type }}</span>
            <br>
            <strong>₱{{ number_format($jobListing->salary ?? 0, 2) }}</strong>
            @if ($jobListing->rate)
                <span class="text-muted small">({{ ucfirst($jobListing->rate) }})</span>
            @endif
        </p>
        <p class="card-text text-muted small mb-2">
            <i class="fas fa-map-marker-alt"></i> {{ $jobListing->location }}
        </p>
        <p class="card-text text-muted small">
            <i class="fas fa-calendar-alt"></i> Posted on {{ $jobListing->created_at->format('M d, Y') }}
        </p>
        <p class="card-text text-muted small">
            <i class="fas fa-users"></i> Applications:
            <strong>{{ $jobListing->jobApplications()->count() }}</strong>
        </p>
        <p class="card-text text-muted small">
            <i class="fas fa-clipboard-list"></i> Vacancies:
            <strong>{{ $jobListing->vacancies }}</strong>
        </p>

        <!-- Status-wise Count -->
        <p class="card-text medium d-flex gap-2 flex-wrap">
            <span class="badge bg-warning">
                <i class="fas fa-clock"></i> Pending:
                {{ $jobListing->jobApplications()->where('status', 'pending')->count() }}
            </span>
            <span class="badge bg-danger">
                <i class="fas fa-times-circle"></i> Rejected:
                {{ $jobListing->jobApplications()->where('status', 'rejected')->count() }}
            </span>
            <span class="badge bg-secondary">
                <i class="fas fa-ban"></i> Cancelled:
                {{ $jobListing->jobApplications()->where('status', 'cancelled')->count() }}
            </span>
            <span class="badge bg-success">
                <i class="fas fa-check-circle"></i> Accepted:
                {{ $jobListing->jobApplications()->where('status', 'accepted')->count() }}
            </span>
        </p>
        <p class="card-text">
            <strong>Status:</strong>
            @if ($jobListing->status === 'closed')
                <span class="badge bg-danger"><i class="fas fa-lock"></i> Closed</span>
            @else
                <span class="badge bg-success"><i class="fas fa-check"></i> Open</span>
            @endif
        </p>

        @php
            $application = $jobListing->jobApplications->firstWhere('expert_id', auth()->user()->id);
        @endphp

        @if ($jobListing->has_applied)
            <a href="{{ route('expert.job-applications.show', $application) }}" class="btn btn-warning w-100">
                <i class="fas fa-eye"></i> View Application
            </a>
        @endif

        <button class="btn btn-info btn-sm w-100 mt-2" data-bs-toggle="modal"
            data-bs-target="#viewJobModal{{ $jobListing->id }}">Show More</button>
    </div>
</div>