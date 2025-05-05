@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-briefcase"></i> My Job Applicants</h2>

        @if ($jobApplications->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> You haven't applied for any jobs yet.
            </div>
        @else
            <div class="list-group">
                @foreach ($jobApplications as $applicant)
                    <a href="{{ route('client.job-listings.showWithApplications', ['jobListing' => $applicant->jobListing->id]) }}"
                        class=" list-group-item list-group-item-action">
                        <h4 class="mb-1"><i class="fas fa-file-alt"></i> {{ $applicant->jobListing->title }}</h4>
                        <h5 class="mb-1"><i class="fas fa-user-alt"></i> {{ $applicant->expert->name }}</h5>
                        <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $applicant->jobListing->location }}</p>
                        <small>
                            <i class="fas fa-info-circle"></i> Status:
                            <span
                                class="badge bg-{{ $applicant->status == 'pending' ? 'warning' : ($applicant->status == 'accepted' ? 'success' : 'danger') }}">
                                {{ ucfirst($applicant->status) }}
                            </span>
                        </small>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection