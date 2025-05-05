@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Applications</h2>

        <!-- Back to Job Listings -->
        <a href="{{ route('client.job-listings.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Job Listings
        </a>

        <!-- Job Listing Details -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h4 class="card-title fw-bold">{{ $jobListing->title }}</h4>
                <p class="card-text text-muted">
                    <strong>Category:</strong> {{ $jobListing->category }} <br>
                    <strong>Employment Type:</strong> {{ ucfirst($jobListing->employment_type) }} <br>
                    <strong>Salary:</strong> ₱{{ number_format($jobListing->salary ?? 0, 2) }} <br>
                    <strong>Location:</strong> {{ $jobListing->location }} <br>
                    <strong>Deadline:</strong>
                    {{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'N/A' }}
                </p>
                <p><strong>Description:</strong> {!! nl2br(e($jobListing->description)) !!}</p>
            </div>
        </div>

        <!-- Pending Applications -->
        <h4 class="fw-bold text-warning">
            <i class="fas fa-exclamation-circle"></i>
            Pending Applications
        </h4>
        <div class="row">
            @forelse ($pendingApplications as $jobApplication)
                @include('client.job-applications._ui.job-application-card', ['jobApplication' => $jobApplication])
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
                @include('client.job-applications._ui.job-application-card', ['jobApplication' => $jobApplication])
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
                @include('client.job-applications._ui.job-application-card', ['jobApplication' => $jobApplication])
            @empty
                <div class="alert alert-danger" role="alert">
                    No rejected applications.
                </div>
            @endforelse
        </div>
    </div>
@endsection