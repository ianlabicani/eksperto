@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">{{ $jobListing->title }}</h2>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $jobListing->category }}</h5>
                <p class="card-text"><strong>Type:</strong> {{ ucfirst($jobListing->job_type) }}</p>
                <p class="card-text"><strong>Salary:</strong> ₱{{ number_format($jobListing->salary ?? 0, 2) }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $jobListing->location }}</p>
                <p class="card-text"><strong>Posted On:</strong> {{ $jobListing->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <h3>Apply for this Job</h3>
        <form action="{{ route('expert.job-applications.store') }}" method="POST">
            @csrf
            <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">
            <div class="mb-3">
                <label for="cover_letter" class="form-label">Cover Letter (optional)</label>
                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Apply Now</button>
        </form>
    </div>
@endsection