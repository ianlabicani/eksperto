@extends('expert.shell')

@section('expert-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="h3 mb-1 fw-bold">Job Opportunities</h1>
                <p class="text-muted mb-0">Find and apply for jobs that match your expertise</p>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-light" data-bs-toggle="collapse" data-bs-target="#filterSection">
                    <i class="fas fa-sliders-h me-2"></i>Filters
                </button>
                <a href="{{ route('expert.job-listings.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-sync-alt me-2"></i>Reset
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="collapse show mb-4" id="filterSection">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @include('expert.job-listings._ui.filter-form')
                </div>
            </div>
        </div>

        @if ($noExpertiseCategories)
            <div class="alert alert-warning border-0 rounded-4 shadow-sm mb-4">
                <div class="d-flex gap-3 p-2">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Complete Your Profile</h5>
                        <p class="mb-3">Update your expertise to see better job recommendations that match your skills.</p>
                        <a href="{{ route('expert.profile.index') }}" class="btn btn-warning">
                            <i class="fas fa-user-edit me-2"></i>Update Profile
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if ($jobListings->isEmpty())
            <div class="text-center py-5">
                <div class="mb-4">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block">
                        <i class="fas fa-search fa-2x text-info"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-2">No Job Listings Available</h4>
                <p class="text-muted mb-4">Check back later for new opportunities or adjust your search criteria.</p>
                <a href="{{ route('expert.job-listings.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-sync-alt me-2"></i>Reset Filters
                </a>
            </div>
        @else
            <!-- Job Listings Section -->
            <div class="mb-4 text-center">
                <h2 class="h4 fw-bold mb-2">Opportunities Matched to Your Expertise</h2>
                <p class="text-muted">Discover jobs tailored to your skills and experience</p>
            </div>

            <div class="row g-4">
                @foreach ($jobListings as $jobListing)
                    <div class="col-md-6 col-lg-4">
                        @include('expert.job-listings._ui.job-listing-card', ['jobListing' => $jobListing])
                    </div>

                    @include('expert.job-listings.show-modal', ['jobListing' => $jobListing])
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $jobListings->links() }}
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .pagination {
                gap: 0.5rem;
            }

            .page-link {
                border-radius: 0.5rem;
                border: none;
                padding: 0.5rem 1rem;
                color: #6b7280;
                background: #f3f4f6;
            }

            .page-item.active .page-link {
                background: #2563eb;
                color: white;
            }

            .page-link:hover {
                background: #e5e7eb;
                color: #374151;
            }

            .page-item.disabled .page-link {
                background: #f3f4f6;
                color: #9ca3af;
            }
        </style>
    @endpush
@endsection