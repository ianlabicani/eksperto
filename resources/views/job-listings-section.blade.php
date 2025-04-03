<section id="job-listings" class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Latest Job Listings</h2>
        <p class="text-muted">Explore opportunities from top clients.</p>
    </div>

    <div class="row">
        <div class="col-12 text-center fw-bold">
            <h3 class="text-muted">Job Offerings By Individual Clients</h3>
        </div>
        @forelse ($jobListings as $job)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $job->title }}</h5>
                        <p class="text-muted mb-1"><strong>Category:</strong> {{ $job->category }}</p>
                        <p class="text-muted mb-1"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="text-muted mb-1"><strong>Type:</strong> {{ ucfirst($job->job_type) }}</p>
                        <p class="text-muted mb-1">
                            <strong>Salary:</strong>
                            {{ $job->rate === 'hourly' ? '₱' . number_format($job->salary, 2) . '/hr' : '₱' . number_format($job->salary, 2) . '/mo' }}
                        </p>
                        <p class="text-muted"><strong>Deadline:</strong>
                            {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</p>
                        <a href="" class="btn btn-primary w-100">Apply Now</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">No job listings available.</div>
            </div>
        @endforelse
    </div>
</section>