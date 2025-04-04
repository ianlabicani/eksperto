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

            <div class="d-flex gap-2 flex-column">
                <a href="{{ route('profile.show', ['profile' => $jobApplication->expert->profile]) }}"
                    class="btn btn-success btn-sm w-100">
                    View Applicant Profile</a>
                @if ($jobApplication->status === 'accepted')
                    <a href="{{ route('client.job-contracts.show', $jobApplication->jobContract) }}"
                        class="btn btn-outline-primary btn-sm w-100">Review Contract</a>
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
            </div>
            <div class="modal-footer">
                @if ($jobApplication->status === 'accepted')
                    Review the application
                @else
                    @if ($jobApplication->jobContract === null)
                        <a href="{{ route('client.job-contracts.create', ['jobApplication' => $jobApplication]) }}"
                            class="btn btn-primary btn-sm">Create Contract</a>
                    @else
                        <a href="{{ route('client.job-contracts.show', $jobApplication->jobContract) }}"
                            class="btn btn-info btn-sm">View Contract</a>
                    @endif
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