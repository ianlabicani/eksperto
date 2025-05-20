<section id="job-listings" class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-primary bg-opacity-10 text-light px-3 py-2 mb-3"
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

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($jobListings as $job)
                <div class="col d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="card border-0 h-100 job-card shadow-sm">
                        <div class="card-body p-4 d-flex flex-column">
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
                            <h4 class="card-title mb-3 text-truncate">{{ $job->title }}</h4>
                            <div class="d-flex flex-column gap-2 mb-4">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-tag me-2 text-primary"></i>
                                    <span class="text-truncate">{{ $job->category }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fa-solid fa-location-dot me-2 text-primary"></i>
                                    <span class="text-truncate">{{ $job->location }}</span>
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
                            @auth
                                @if ($user->isClient())
                                    <a href="{{ route('client.job-listings.show', $job) }}" class="btn btn-primary w-100 mt-auto"
                                        style="border-radius: 50px;">
                                        Apply Now <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                @else ($user->isExpert())
                                    <a href="{{ route('expert.job-listings.show', $job) }}" class="btn btn-primary w-100 mt-auto"
                                        style="border-radius: 50px;">
                                        View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                @endif

                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-auto"
                                    style="border-radius: 50px;">
                                    Login to Apply <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            @endauth

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

<style>
    .job-card {
        transition: all 0.2s ease;
        border-radius: 0.75rem;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .job-card .card-title {
        min-height: 28px;
        line-height: 1.3;
    }

    .job-card .text-truncate {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (max-width: 767.98px) {
        .job-card .d-flex.flex-column.gap-2 {
            font-size: 0.9rem;
        }
    }
</style>