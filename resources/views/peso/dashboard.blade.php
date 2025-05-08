@extends('peso.shell')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Dashboard</h1>
            </div>

            <div class="col-md-12 mt-3">
                <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Total Job Listings -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Total Job Listings</h5>
                        <h2 class="fw-bold text-primary">{{ $totalJobListings }}</h2>
                    </div>
                </div>
            </div>

            <!-- Active Job Listings -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Active Job Listings</h5>
                        <h2 class="fw-bold text-success">{{ $totalActiveJobs }}</h2>
                    </div>
                </div>
            </div>

            <!-- Closed Job Listings -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Closed Job Listings</h5>
                        <h2 class="fw-bold text-danger">{{ $totalClosedJobs }}</h2>
                    </div>
                </div>
            </div>

            <!-- Jobs Posted Today -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Jobs Posted Today</h5>
                        <h2 class="fw-bold text-warning">{{ $jobsToday }}</h2>
                    </div>
                </div>
            </div>

            <!-- Jobs This Week -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Jobs This Week</h5>
                        <h2 class="fw-bold text-info">{{ $jobsThisWeek }}</h2>
                    </div>
                </div>
            </div>

            <!-- Jobs This Month -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Jobs This Month</h5>
                        <h2 class="fw-bold text-primary">{{ $jobsThisMonth }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Applications -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Total Applications</h5>
                        <h2 class="fw-bold text-dark">{{ $totalApplications }}</h2>
                    </div>
                </div>
            </div>

            <!-- Applications This Month -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Applications This Month</h5>
                        <h2 class="fw-bold text-success">{{ $applicationsThisMonth }}</h2>
                    </div>
                </div>
            </div>

            <!-- Active Employers -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Active Employers</h5>
                        <h2 class="fw-bold text-info">{{ $totalEmployers }}</h2>
                    </div>
                </div>
            </div>

            <!-- Unique Applicants This Month -->
            <div class="col-md-4 mb-1">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Unique Applicants This Month</h5>
                        <h2 class="fw-bold text-secondary">{{ $uniqueApplicantsThisMonth }}</h2>
                    </div>
                </div>
            </div>

            <!-- Job Listings by Category -->
            <div class="col-md-12 mt-4">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="fw-bold text-uppercase">Job Listings by Category</h5>
                        <ul class="list-group">
                            @foreach ($jobsByCategory as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ ucfirst($category->category) }}
                                    <span class="badge bg-primary rounded-pill">{{ $category->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Most Popular Jobs -->
            <div class="col-md-12 mt-4">
                <div class="card hover shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="fw-bold text-uppercase">Most Popular Job Listings</h5>
                        <ul class="list-group">
                            @foreach ($popularJobs as $job)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $job->title }}
                                    <span class="badge bg-success rounded-pill">{{ $job->applications_count }}
                                        Applications</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
