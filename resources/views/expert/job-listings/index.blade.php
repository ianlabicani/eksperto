@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Listings</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('expert.job-listings.index') }}" class="mb-3">
            <div class="row g-2">
                <!-- Search -->
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search title or category"
                        value="{{ request('search') }}">
                </div>

                <!-- Status Filter -->
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Date Range Filter -->
                <div class="col-md-5 d-flex align-items-center justify-content-between">
                    <!-- Start Date -->
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">

                    <!-- Arrow Icon -->
                    <span class="mx-2">
                        <i class="fas fa-arrow-right"></i>
                    </span>

                    <!-- End Date -->
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>


                <!-- Filter & Reset Buttons -->
                <div class="col-md-2 d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"><i
                            class="fas fa-filter"></i>
                        Filter</button>
                    <a href="{{ route('expert.job-listings.index') }}" class="btn btn-secondary d-flex text-nowrap">Clear
                        Filters</a>
                </div>
            </div>
        </form>

        @if ($jobListings->isEmpty())
            <div class="alert alert-info text-center">No job listings available.</div>
        @else
            <div class="row">
                @foreach ($jobListings as $job)
                    <div class="col-md-3 col-lg-4 mb-4">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Include Modal File -->
                    @include('expert.job-listings.ui.show-modal', ['job' => $job])
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $jobListings->links() }}
            </div>
        @endif
    </div>
@endsection