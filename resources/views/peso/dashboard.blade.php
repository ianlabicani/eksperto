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
            <!-- Job Listings Count -->
            <div class="col-md-4 mb-1">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Total Job Listings</h5>
                        <h2 class="fw-bold text-primary">{{ $totalJobListings }}</h2>
                    </div>
                </div>
            </div>
            <!-- Active Job Listings -->
            <div class="col-md-4 mb-1">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Active Job Listings</h5>
                        <h2 class="fw-bold text-success">{{ $totalActiveJobs }}</h2>
                    </div>
                </div>
            </div>

            <!-- Jobs Posted Today -->
            <div class="col-md-4 mb-1">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <h5 class="fw-bold text-uppercase">Jobs Posted Today</h5>
                        <h2 class="fw-bold text-warning">{{ $jobsToday }}</h2>
                    </div>
                </div>
            </div>

            <!-- TODO: Show how many jobs are there in a certain job category -->
        </div>
    </div>
@endsection