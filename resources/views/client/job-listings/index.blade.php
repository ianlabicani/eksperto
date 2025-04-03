@extends('client.shell')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold mb-0">My Job Listings</h2>
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
                @foreach ($jobListings as $jobListing)
                    <div class="col-md-5 col-lg-3 mb-4">
                        @include('client.job-listings._ui.job-listing-card', ['jobListing' => $jobListing])
                    </div>
                    <!-- Include Modal File -->
                    @include('client.job-listings._ui.show-modal', ['jobListing' => $jobListing])
                @endforeach
            </div>
        @endif
    </div>
@endsection