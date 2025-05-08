<section id="job-listings" class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3"
                style="border-radius: 50px;">Opportunities</span>
            <h2 class="display-5 fw-bold">Latest Job Listings</h2>
            <p class="text-muted col-lg-8 mx-auto">Find your next opportunity or the perfect expert for your project.
            </p>
        </div>

        <div class="text-center mb-4" data-aos="fade-up">
            <h4 class="mb-0 text-primary">Job Offerings By Individual Clients</h4>
            <div class="d-inline-block mt-2" style="width: 80px; height: 4px; background-color: var(--primary-color);">
            </div>
        </div>

        <div class="row g-4">
            @forelse ($jobListings as $job)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span
                                    class="badge {{ $job->job_type == 'fulltime' ? 'bg-success' : 'bg-warning' }} px-3 py-2"
                                    style="border-radius: 50px;">
                                    {{ ucfirst($job->job_type) }}
                                </span>
                                <span class="text-muted small">
                                    <i class="fa-solid fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                </span>
                            </div>
                            <h4 class="card-title mb-3">{{ $job->title }}</h4>
                            <div class="d-flex flex-column gap-2 mb-4">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-tag me-2 text-primary"></i>
                                    <span>{{ $job->category }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-location-dot me-2 text-primary"></i>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-money-bill-wave me-2 text-primary"></i>
                                    <span>{{ $job->rate === 'hourly' ? '₱' . number_format($job->salary, 2) . '/hr' : '₱' . number_format($job->salary, 2) . '/mo' }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-calendar me-2 text-primary"></i>
                                    <span>Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <a href="" class="btn btn-primary w-100" style="border-radius: 50px;">
                                Apply Now <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info py-4 text-center" role="alert" data-aos="fade-up">
                        <i class="fa-solid fa-circle-info fa-2x mb-3"></i>
                        <p class="mb-0">No job listings available at the moment. Please check back later.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>