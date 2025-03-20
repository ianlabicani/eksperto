<div class="col-md-6 col-lg-4 mb-4">
    <div class="card shadow border-0">
        <div class="card-body">
            <h5 class="card-title fw-bold">
                {{ $jobApplication->expert->name }}
            </h5>
            <p class="card-text text-muted">
                <i class="bi bi-envelope"></i> {{ $jobApplication->expert->email }}
            </p>
            <p class="card-text text-muted">
                <i class="bi bi-calendar"></i> Applied on {{ $jobApplication->created_at->format('M d, Y') }}
            </p>
            <p class="card-text">

                @php
                    $status = $jobApplication->status;
                    $statusBadge = match ($status) {
                        'pending' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'cancelled' => 'secondary',
                        default => 'dark',
                    };
                @endphp
                <span class="badge bg-{{ $statusBadge }}">
                    {{ ucfirst($jobApplication->status) }}
                </span>
            </p>

            <div class="d-flex justify-content-between">
                @if ($jobApplication->status === 'accepted')
                    <a href="{{ route('client.job-applications.show', $jobApplication) }}"
                        class="btn btn-outline-primary btn-sm w-100">Review Application</a>
                @else
                    <button type="button" class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal"
                        data-bs-target="#viewApplicationModal{{ $jobApplication->id }}">
                        View Application
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- View Application Modal -->
<div class="modal fade" id="viewApplicationModal{{ $jobApplication->id }}" tabindex="-1"
    aria-labelledby="viewApplicationLabel{{ $jobApplication->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplicationLabel{{ $jobApplication->id }}">
                    Application Details - {{ $jobApplication->expert->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Email:</strong> {{ $jobApplication->expert->email }}</p>
                <p><strong>Applied for:</strong> {{ $jobApplication->jobListing->title }}</p>
                <p><strong>Status:</strong>
                    @php
                        $status = $jobApplication->status;
                        $statusBadge = match ($status) {
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'secondary',
                            default => 'dark',
                        };
                    @endphp
                    <span class="badge bg-{{ $statusBadge }}">
                        {{ ucfirst($jobApplication->status) }}
                    </span>
                </p>
                <p><strong>Cover Letter:</strong></p>
                <p>{!! nl2br(e($jobApplication->cover_letter ?? 'No cover letter provided.')) !!}</p>
                <p><strong>Resume:</strong>
                    @if ($jobApplication->resume)
                        <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank"
                            class="btn btn-outline-primary btn-sm">View Resume</a>
                    @else
                        <span class="text-muted">No resume uploaded</span>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if ($jobApplication->status === 'accepted')
                    Review the application
                @else
                    <form action="{{ route('client.job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                    </form>

                    <form action="{{ route('client.job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>