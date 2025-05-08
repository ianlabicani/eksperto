@extends('expert.shell')

@section('expert-content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 fw-bold text-primary">My Applications</h1>
            </div>
        </div>
    </div>

    @if ($jobApplications->isEmpty())
        <div class="alert alert-info rounded-3 shadow-sm border-0 p-4 text-center">
            <i class="fas fa-info-circle fs-4 mb-3 d-block"></i>
            <h4 class="fw-bold">No Applications Yet</h4>
            <p class="mb-3">You haven't applied for any jobs yet. Browse available opportunities to get started.</p>
            <a href="{{ route('expert.job-listings.index') }}" class="btn btn-primary">Browse Jobs</a>
        </div>
    @else
        <div class="row g-4">
            @foreach ($jobApplications as $application)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bold text-truncate">{{ $application->jobListing->title }}</h5>
                                @php
                                    $statusClass = match ($application->status) {
                                        'pending' => 'bg-warning bg-opacity-10 text-warning',
                                        'cancelled', 'rejected' => 'bg-danger bg-opacity-10 text-danger',
                                        'accepted' => 'bg-success bg-opacity-10 text-success',
                                        default => 'bg-primary bg-opacity-10 text-primary',
                                    };

                                    $statusIcon = match ($application->status) {
                                        'pending' => 'fa-hourglass-half',
                                        'cancelled' => 'fa-times-circle',
                                        'rejected' => 'fa-times-circle',
                                        'accepted' => 'fa-check-circle',
                                        default => 'fa-info-circle',
                                    };
                                @endphp

                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill">
                                    <i class="fas {{ $statusIcon }} me-1"></i>
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <p class="card-text mb-1">
                                    <i class="fas fa-building text-muted me-2"></i>
                                    {{ $application->jobListing->client->name ?? 'Client' }}
                                </p>
                                <p class="card-text mb-1">
                                    <i class="far fa-calendar-alt text-muted me-2"></i>
                                    Applied: {{ $application->created_at->format('M d, Y') }}
                                </p>
                            </div>

                            <div class="mt-auto">
                                <a href="{{ route('expert.job-applications.show', $application->id) }}"
                                    class="btn btn-primary w-100">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endif
@endsection