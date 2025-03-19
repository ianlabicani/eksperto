@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">My Job Applications</h2>

        @if ($jobApplications->isEmpty())
            <div class="alert alert-info text-center">You have not applied for any jobs yet.</div>
        @else
            <div class="row">
                @foreach ($jobApplications as $application)
                    <div class="col-md-6">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $application->jobListing->title }}</h5>
                                <p class="card-text">
                                    <strong>Status:</strong>
                                    @php
                                        $statusBadge = match ($application->status) {
                                            'pending' => 'warning',
                                            'cancelled', 'rejected' => 'danger',
                                            default => 'success',
                                        };
                                        // dd($statusBadge);
                                    @endphp

                                    <span class="badge bg-{{ $statusBadge }}">
                                        {{ ucfirst($application->status) }}
                                    </span>

                                </p>
                                <p class="text-muted">Applied on: {{ $application->created_at->format('M d, Y') }}</p>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('expert.job-applications.show', $application->id) }}"
                                        class="btn btn-sm btn-primary">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection