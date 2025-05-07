<div class="col-md-6">
    <a href="{{ route('client.job-applications.show', $jobApplication) }}" class="text-decoration-none">
        <div
            class="card shadow-sm h-100 border-start border-{{ $jobApplication->status == 'pending' ? 'warning' : ($jobApplication->status == 'accepted' ? 'success' : 'danger') }}">
            <div class="card-body">
                <h5 class="card-title text-dark mb-2">
                    <i class="fas fa-file-alt me-2 text-secondary"></i>{{ $jobApplication->jobListing->title }}
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <i class="fas fa-user me-2"></i>{{ $jobApplication->expert->name }}
                </h6>
                <p class="mb-2 text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $jobApplication->jobListing->location }}
                </p>
                <span
                    class="badge bg-{{ $jobApplication->status == 'pending' ? 'warning' : ($jobApplication->status == 'accepted' ? 'success' : 'danger') }}">
                    <i class="fas fa-info-circle me-1"></i>{{ ucfirst($jobApplication->status) }}
                </span>
            </div>
        </div>
    </a>
</div>