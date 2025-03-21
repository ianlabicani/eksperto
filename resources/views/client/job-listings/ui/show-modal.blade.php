<div class="modal fade" id="viewJobModal{{ $jobListing->id }}" tabindex="-1"
    aria-labelledby="viewJobModalLabel{{ $jobListing->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewJobModalLabel{{ $jobListing->id }}">
                    <i class="fas fa-briefcase"></i> {{ $jobListing->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong><i class="fas fa-layer-group"></i> Category:</strong> {{ $jobListing->category }}</p>
                <p><strong><i class="fas fa-user-friends"></i> Vacancies:</strong> {{ $jobListing->vacancies }}</p>
                <p><strong><i class="fas fa-money-bill-wave"></i> Salary:</strong>
                    ₱{{ number_format($jobListing->salary ?? 0, 2) }}</p>
                <p><strong><i class="fas fa-map-marker-alt"></i> Location:</strong> {{ $jobListing->location }}</p>
                <p><strong><i class="fas fa-clock"></i> Rate:</strong> {{ $jobListing->rate }}</p>
                <p><strong><i class="fas fa-briefcase"></i> Employment Type:</strong>
                    {{ ucfirst($jobListing->employment_type) }}</p>
                <p><strong><i class="fas fa-list-check"></i> Requirements:</strong>
                    {!! nl2br(e($jobListing->requirements)) !!}</p>
                <p><strong><i class="fas fa-calendar-alt"></i> Deadline:</strong>
                    {{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'N/A' }}
                </p>
                <p><strong><i class="fas fa-file-alt"></i> Description:</strong>
                    {!! nl2br(e($jobListing->description)) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger me-auto" data-bs-toggle="modal"
                    data-bs-target="#deleteJobModal" data-job-id="{{ $jobListing->id }}">
                    <i class="fas fa-trash"></i> Delete
                </button>
                <a href="{{ route('client.job-applications.index', ['job_listing_id' => $jobListing->id]) }}"
                    class="btn btn-outline-primary">
                    <i class="fas fa-eye"></i> View Applications
                </a>
                <a href="{{ route('client.job-listings.edit', $jobListing->id) }}" class="btn btn-outline-warning">
                    <i class="fas fa-edit"></i> Edit Job
                </a>
            </div>
        </div>
    </div>
</div>

@include('client.job-listings.ui.destroy-modal')
