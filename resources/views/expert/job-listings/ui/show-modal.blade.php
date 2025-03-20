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
                <p><strong><i class="fas fa-list"></i> Category:</strong> {{ $jobListing->category }}</p>
                <p><strong><i class="fas fa-money-bill-wave"></i> Salary:</strong>
                    ₱{{ number_format($jobListing->salary ?? 0, 2) }}</p>
                <p><strong><i class="fas fa-map-marker-alt"></i> Location:</strong> {{ $jobListing->location }}</p>
                <p><strong><i class="fas fa-briefcase"></i> Employment Type:</strong>
                    {{ ucfirst($jobListing->employment_type) }}</p>
                <p><strong><i class="fas fa-file-alt"></i> Requirements:</strong>
                    {!! nl2br(e($jobListing->requirements)) !!}</p>
                <p><strong><i class="fas fa-calendar-alt"></i> Deadline:</strong>
                    {{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'N/A' }}
                </p>
                <p><strong><i class="fas fa-align-left"></i> Description:</strong>
                    {!! nl2br(e($jobListing->description)) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>

                @php
                    $application = $jobListing->jobApplications->firstWhere('expert_id', auth()->user()->id);
                @endphp

                @if ($application)
                    <a href="{{ route('expert.job-applications.show', $application) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Application
                    </a>
                @else
                    <a href="{{ route('expert.job-applications.create', ['job_listing_id' => $jobListing->id]) }}"
                        class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Apply
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>