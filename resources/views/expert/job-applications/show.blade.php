@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-file-alt"></i> Job Application Details</h2>
        <a href="{{ route('expert.job-applications.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Applications
        </a>

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-briefcase"></i> {{ $jobApplication->jobListing->title }}</h4>
                <p class="card-text"><strong><i class="fas fa-map-marker-alt"></i> Location:</strong>
                    {{ $jobApplication->jobListing->location }}</p>
                <p class="card-text"><strong><i class="fas fa-info-circle"></i> Application Status:</strong>
                    <span
                        class="badge bg-{{ $jobApplication->status == 'pending' ? 'warning' : ($jobApplication->status == 'approved' ? 'success' : 'danger') }}">
                        {{ ucfirst($jobApplication->status) }}
                    </span>
                </p>
                <p class="card-text"><strong><i class="fas fa-calendar-alt"></i> Submitted on:</strong>
                    {{ $jobApplication->created_at->format('M d, Y') }}</p>

                <h5 class="mt-4"><i class="fas fa-user"></i> Applicant Details</h5>
                <p><strong><i class="fas fa-user"></i> Name:</strong> {{ $jobApplication->expert->name }}</p>
                <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ $jobApplication->expert->email }}</p>
                <p><strong><i class="fas fa-file-pdf"></i> Resume:</strong>
                    @if ($jobApplication->resume)
                        <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i> View Resume
                        </a>
                    @else
                        <span class="text-muted">No resume uploaded</span>
                    @endif
                </p>

                @if ($jobApplication->status == 'cancelled')
                    <div class="alert alert-danger mt-4">
                        <i class="fas fa-exclamation-triangle"></i> You cancelled this application.
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

        <!-- Display Job Contract if exists -->
        @if ($jobApplication->jobContract)
            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-signature"></i> Job Contract</h5>
                    <p><strong><i class="fas fa-calendar-alt"></i> Start Date:</strong>
                        {{ \Carbon\Carbon::parse($jobApplication->jobContract->start_date)->format('M d, Y') }}
                    </p>
                    <p><strong><i class="fas fa-calendar-check"></i> End Date:</strong>
                        {{ $jobApplication->jobContract->end_date ? \Carbon\Carbon::parse($jobApplication->jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                    </p>
                    <p class="mt-2">
                        <strong><i class="fas fa-info-circle"></i> Contract Status:</strong>
                        @php
                            $contractStatus = $jobApplication->jobContract->status;
                            $contractBadge = match ($contractStatus) {
                                'pending' => 'warning',
                                'accepted' => 'success',
                                'rejected' => 'danger',
                                'cancelled' => 'secondary',
                                default => 'dark',
                            };
                        @endphp
                        <span class="badge bg-{{ $contractBadge }}">
                            {{ ucfirst($contractStatus) }}
                        </span>
                    </p>
                    <p><strong><i class="fas fa-file-alt"></i> Contract Terms:</strong></p>
                    <div class="border p-3 bg-light rounded w-75 me-auto">
                        {!! nl2br(e($jobApplication->jobContract->contract_terms)) !!}
                    </div>

                    <a href="{{ route('expert.job-contracts.show', $jobApplication->jobContract->id) }}"
                        class="btn btn-primary mt-3">
                        <i class="fas fa-eye"></i> View Contract Details
                    </a>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> The client is still reviewing your application.
            </div>
        @endif
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCancelModalLabel"><i class="fas fa-exclamation-circle"></i> Cancel
                        Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-exclamation-triangle text-danger"></i> Are you sure you want to cancel this
                    application? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <form action="{{ route('expert.job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Yes, Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection