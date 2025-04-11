@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Listings</h2>

        <!-- Filter Form -->
        @include('expert.job-listings._ui.filter-form')

        @if ($noExpertiseCategories)
            <div class="alert alert-warning text-center">Update your expertise to see better recommendations.</div>
        @endif

        @if ($jobListings->isEmpty())
            <div class="alert alert-info text-center">No job listings available.</div>
        @else
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h1 class="display-5 fw-bold text-primary">
                        Here are the Job Opportunities for YOU
                    </h1>
                </div>
                @foreach ($jobListings as $jobListing)
                    <div class="col-md-5 col-lg-3 mb-4">
                        @include('expert.job-listings._ui.job-listing-card', ['jobListing' => $jobListing])
                    </div>

                    <!-- Show Modal -->
                    @include('expert.job-listings._ui.show-modal', ['jobListing' => $jobListing])
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $jobListings->links() }}
            </div>
        @endif
    </div>
@endsection