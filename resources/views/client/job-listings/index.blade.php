@extends('client.shell')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">My Job Listings</h2>
            <a href="{{ route('client.job-listings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Post a Job</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($jobListings->isEmpty())
            <div class="alert alert-info text-center">No job listings found. Start by posting a job.</div>
        @else
            <div class="row">
                @foreach ($jobListings as $job)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $job->title }}</h5>
                                <p class="card-text text-muted mb-1">{{ $job->category }}</p>
                                <p class="card-text">
                                    <span class="badge bg-secondary text-capitalize">{{ $job->employment_type }}</span>
                                    <br>
                                    <strong>₱{{ number_format($job->salary ?? 0, 2) }}</strong>
                                </p>
                                <p class="card-text text-muted small mb-2">
                                    <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                </p>
                                <p class="card-text text-muted small">
                                    <i class="bi bi-calendar"></i> Posted on {{ $job->created_at->format('M d, Y') }}
                                </p>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#viewJobModal{{ $job->id }}">
                                        View
                                    </button>

                                    <a href="{{ route('client.job-listings.edit', $job->id) }}"
                                        class="btn btn-outline-warning btn-sm">Edit</a>

                                    <!-- Delete Button (Triggers Modal) -->
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteJobModal" data-job-id="{{ $job->id }}">
                                        Delete
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Include Modal File -->
                    @include('client.job-listings.ui.show-modal', ['job' => $job])
                @endforeach

                <!-- Delete Confirmation Modal -->
                @include('client.job-listings.ui.destroy-modal')
            </div>
        @endif
    </div>
@endsection