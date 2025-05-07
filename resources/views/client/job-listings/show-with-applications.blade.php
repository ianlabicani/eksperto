@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Applications</h2>

        <!-- Back to Job Listings -->
        <a href="{{ route('client.job-listings.show', $jobListing->id) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to the Job
        </a>

        <!-- Pending Applications -->
        <h4 class="fw-bold text-warning">
            <i class="fas fa-exclamation-circle"></i>
            Pending Applications
        </h4>
        <div class="row">
            @forelse ($pendingApplications as $jobApplication)
                @include('client.job-applications.partials.job-application', ['jobApplication' => $jobApplication])
            @empty
                <div class="alert alert-warning" role="alert">
                    No pending applications.
                </div>
            @endforelse
        </div>

        <!-- Accepted Applications -->
        <h4 class="fw-bold text-success mt-4">
            <i class="fas fa-check-circle"></i>
            Accepted Applications
        </h4>
        <div class="row">
            @forelse ($acceptedApplications as $jobApplication)
                @include('client.job-applications.partials.job-application', ['jobApplication' => $jobApplication])
            @empty
                <div class="alert alert-success" role="alert">
                    No accepted applications.
                </div>
            @endforelse
        </div>

        <!-- Rejected Applications -->
        <h4 class="fw-bold text-danger mt-4">
            <i class="fas fa-times-circle"></i>
            Rejected Applications
        </h4>
        <div class="row">
            @forelse ($rejectedApplications as $jobApplication)
                @include('client.job-applications.partials.job-application', ['jobApplication' => $jobApplication])
            @empty
                <div class="alert alert-danger" role="alert">
                    No rejected applications.
                </div>
            @endforelse
        </div>
    </div>
@endsection
