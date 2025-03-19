@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Application Details</h2>
        <a href="{{ route('expert.job-applications.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back to Applications
        </a>

        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">{{ $jobApplication->jobListing->title }}</h4>
                <p class="card-text"><strong>Location:</strong> {{ $jobApplication->jobListing->location }}</p>
                <p class="card-text"><strong>Application Status:</strong>
                    <span
                        class="badge bg-{{ $jobApplication->status == 'pending' ? 'warning' : ($jobApplication->status == 'approved' ? 'success' : 'danger') }}">
                        {{ ucfirst($jobApplication->status) }}
                    </span>
                </p>
                <p class="card-text"><strong>Submitted on:</strong> {{ $jobApplication->created_at->format('M d, Y') }}</p>

                <h5 class="mt-4">Applicant Details</h5>
                <p><strong>Name:</strong> {{ $jobApplication->expert->name }}</p>
                <p><strong>Email:</strong> {{ $jobApplication->expert->email }}</p>
                <p><strong>Resume:</strong>
                    @if ($jobApplication->resume)
                        <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">View Resume</a>
                    @else
                        <span class="text-muted">No resume uploaded</span>
                    @endif
                </p>

                @if ($jobApplication->status == 'cancelled')
                    <div class="alert alert-danger mt-4">
                        You cancelled thi application.
                    </div>

                @else
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-lg w-100 btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmCancelModal">
                        <i class="fas fa-times"></i> Cancel Application
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCancelModalLabel">Cancel Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this application? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('expert.job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection