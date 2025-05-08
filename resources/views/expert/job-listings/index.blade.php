@extends('expert.shell')

@section('expert-content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 fw-bold text-primary">Job Opportunities</h1>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            @include('expert.job-listings._ui.filter-form')
        </div>
    </div>

    @if ($noExpertiseCategories)
        <div class="alert alert-warning rounded-3 shadow-sm border-0 p-4">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Complete Your Profile</h5>
                    <p class="mb-0">Update your expertise to see better job recommendations that match your skills.</p>
                    <a href="{{ route('expert.profile.index') }}" class="btn btn-sm btn-warning mt-2">Update Profile</a>
                </div>
            </div>
        </div>
    @endif

    @if ($jobListings->isEmpty())
        <div class="alert alert-info rounded-3 shadow-sm border-0 p-4 text-center">
            <i class="fas fa-info-circle fs-4 mb-3"></i>
            <h4 class="fw-bold">No Job Listings Available</h4>
            <p class="mb-0">Check back later for new opportunities or adjust your search criteria.</p>
        </div>
    @else
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="h4 fw-bold text-primary">
                    Opportunities Matched to Your Expertise
                </h2>
                <p class="text-muted">We've found these jobs based on your profile and skills</p>
            </div>

            <div class="row g-4">
                @foreach ($jobListings as $jobListing)
                    <div class="col-md-6 col-lg-4">
                        @include('expert.job-listings._ui.job-listing-card', ['jobListing' => $jobListing])
                    </div>

                    <!-- Show Modal -->
                    @include('expert.job-listings._ui.show-modal', ['jobListing' => $jobListing])
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $jobListings->links() }}
            </div>
        </div>
    @endif
@endsection
