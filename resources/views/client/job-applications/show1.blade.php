@extends('client.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Application Details</h2>
        <a href="{{ route('client.job-applications.index', ['job_listing_id' => $jobApplication->jobListing->id]) }}"
            class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Applications
        </a>

        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">{{ $jobApplication->jobListing->title }}</h4>
                <p class="card-text"><strong>Location:</strong> {{ $jobApplication->jobListing->location }}</p>
                <p class="card-text"><strong>Application Status:</strong>
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
                <p class="card-text"><strong>Submitted on:</strong> {{ $jobApplication->created_at->format('M d, Y') }}</p>

                <h5 class="mt-4">Freelancer Details</h5>
                <p><strong>Name:</strong> {{ $jobApplication->expert->name }}</p>
                <p><strong>Email:</strong> {{ $jobApplication->expert->email }}</p>
                <p><strong>Cover Letter:</strong> {{ $jobApplication->cover_letter ?? 'No cover letter provided.' }}</p>

                <p><strong>Resume:</strong>
                    @if ($jobApplication->resume)
                        <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">View Resume</a>
                    @else
                        <span class="text-muted">No resume uploaded</span>
                    @endif
                </p>

                <!-- Action Buttons -->
                @if ($jobApplication->status === 'pending')
                    <form action="{{ route('client.job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Approve
                        </button>
                    </form>

                    <form action="{{ route('client.job-applications.update', $jobApplication->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Reject
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection