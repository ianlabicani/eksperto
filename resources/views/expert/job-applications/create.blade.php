@extends('expert.shell')

@section('expert-content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-briefcase"></i> {{ $jobListing->title }}</h2>

        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-tags"></i> {{ $jobListing->category }}</h5>
                <p class="card-text"><strong><i class="fas fa-clipboard-list"></i> Type:</strong>
                    {{ ucfirst($jobListing->job_type) }}</p>
                <p class="card-text"><strong><i class="fas fa-money-bill-wave"></i> Salary:</strong>
                    ₱{{ number_format($jobListing->salary ?? 0, 2) }}</p>
                <p class="card-text"><strong><i class="fas fa-map-marker-alt"></i> Location:</strong>
                    {{ $jobListing->location }}</p>
                <p class="card-text"><strong><i class="fas fa-calendar-alt"></i> Posted On:</strong>
                    {{ $jobListing->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <h3><i class="fas fa-paper-plane"></i> Apply for this Job</h3>
        <form action="{{ route('expert.job-applications.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">
            <input type="hidden" name="client_id" value="{{ $jobListing->client_id }}">

            <div class="mb-3">
                <label for="cover_letter" class="form-label"><i class="fas fa-file-alt"></i> Cover Letter (optional)</label>
                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle"></i> Apply Now
            </button>
        </form>
    </div>
@endsection