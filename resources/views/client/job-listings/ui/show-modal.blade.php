<div class="modal fade" id="viewJobModal{{ $job->id }}" tabindex="-1" aria-labelledby="viewJobModalLabel{{ $job->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewJobModalLabel{{ $job->id }}">{{ $job->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Category:</strong> {{ $job->category }}</p>
                <p><strong>Salary:</strong> ₱{{ number_format($job->salary ?? 0, 2) }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Employment Type:</strong> {{ ucfirst($job->employment_type) }}</p>
                <p><strong>Requirements:</strong> {!! nl2br(e($job->requirements)) !!}</p>
                <p><strong>Deadline:</strong>
                    {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('M d, Y') : 'N/A' }}</p>
                <p><strong>Description:</strong> {!! nl2br(e($job->description)) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('client.job-listings.edit', $job->id) }}" class="btn btn-primary">Edit Job</a>
            </div>
        </div>
    </div>
</div>