@extends('shell')

@section('content')

    @auth
        @if ($user->isClient())
            @include('client._ui.navbar')
        @else ($user->isExpert())
            @include('expert._ui.navbar')
        @endif
    @else
        @include('guest._ui.navbar')
    @endauth

    <section class="py-5" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-4">Find & Hire Top Experts</h1>
                    <p class="lead mb-4">Connect with skilled professionals for your projects and get things done
                        efficiently with our trusted platform.</p>
                    <div class="d-flex flex-wrap gap-3">
                        @auth
                            @if (Auth::user()->isClient())
                                <a href="{{ route('client.dashboard') }}" class="btn btn-light px-4 py-2 fw-semibold"
                                    style="border-radius: 50px;">
                                    Post a Job <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            @elseif (Auth::user()->isExpert())
                                <a href="{{ route('expert.dashboard') }}" class="btn btn-light px-4 py-2 fw-semibold"
                                    style="border-radius: 50px;">
                                    Go to Dashboard <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>

                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light px-4 py-2 fw-semibold"
                                style="border-radius: 50px;">
                                Get Started <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        @endauth
                        <a href="#features" class="btn btn-outline-light px-4 py-2" style="border-radius: 50px;">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        class="img-fluid rounded-4 shadow" alt="People collaborating"
                        style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="banner my-5" data-aos="zoom-in">
            <div class="rounded-4 overflow-hidden shadow">
                <img src="{{ asset('images/eksperto-home-banner.png') }}" class="img-fluid w-100"
                    alt="Eksperto platform banner">
            </div>
        </div>

        <!-- job-listings card -->

        <section id="job-listings" class="py-5 my-5">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <span class="badge bg-primary bg-opacity-10 text-light px-3 py-2 mb-3"
                        style="border-radius: 50px;">Opportunities</span>
                    <h2 class="display-5 fw-bold">Latest Job Listings</h2>
                    <p class="text-muted col-lg-8 mx-auto">Find your next opportunity or the perfect expert for your
                        project.
                    </p>
                </div>

                <div class="text-center mb-4" data-aos="fade-up">
                    <h4 class="mb-0 text-primary">Job Offerings By Individual Clients</h4>
                    <div class="d-inline-block mt-2"
                        style="width: 80px; height: 4px; background-color: var(--primary-color);">
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($jobListings as $job)
                        <div class="col d-flex align-items-stretch" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 50 }}">
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
                                            <a href="{{ route('client.job-listings.show', $job) }}"
                                                class="btn btn-primary w-100 mt-auto" style="border-radius: 50px;">
                                                Apply Now <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        @else ($user->isExpert())
                                            <a href="{{ route('expert.job-listings.show', $job) }}"
                                                class="btn btn-primary w-100 mt-auto" style="border-radius: 50px;">
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


        <section class="quick-guide py-5" style="background-color: #f8f9fc;">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge bg-primary bg-opacity-10 text-light px-3 py-2 mb-3" style="border-radius: 50px;">
                    How It Works
                </span>
                <h2 class="display-5 fw-bold">Getting Started is Easy</h2>
                <p class="text-muted col-lg-8 mx-auto">Follow these simple steps to make the most of our platform.</p>
            </div>

            <div class="row g-4 mb-5">
                @php
                    $steps = [
                        [
                            'number' => 1,
                            'icon' => 'fas fa-user-plus',
                            'title' => 'Create an Account',
                            'description' => 'Register for free and create your professional profile. This is your first step to connecting with clients or finding skilled experts.',
                            'button_text' => 'Register Now',
                            'button_link' => route('register'),
                            'delay' => 100
                        ],
                        [
                            'number' => 2,
                            'icon' => 'fas fa-address-card',
                            'title' => 'Complete Your Profile',
                            'description' => 'Enhance your visibility by updating your profile with skills, experience, and portfolio. A complete profile attracts more opportunities.',
                            'button_text' => auth()->check() ? 'Update Profile' : 'Login to Continue',
                            'button_link' => auth()->check() ? route(auth()->user()->isClient() ? 'client.profile.index' : 'expert.profile.index') : route('login'),
                            'delay' => 200
                        ],
                        [
                            'number' => 3,
                            'icon' => 'fas fa-magnifying-glass-dollar',
                            'title' => 'Find Opportunities',
                            'description' => 'Browse available job postings or search for experts that match your project needs. Connect, collaborate, and succeed together.',
                            'button_text' => 'Explore Jobs',
                            'button_link' => '/login',
                            'delay' => 300
                        ]
                    ];
                @endphp

                @foreach($steps as $step)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $step['delay'] }}">
                        <div class="card hover border-0 h-100 p-4 position-relative">
                            <div class="position-absolute top-0 start-0 mt-3 ms-3 bg-primary rounded-circle text-white d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; z-index: 1;">
                                <span class="fw-bold">{{ $step['number'] }}</span>
                            </div>
                            <div class="text-center mb-4 mt-4">
                                <div class="bg-primary bg-opacity-20 rounded-circle d-inline-flex p-4">
                                    <i class="{{ $step['icon'] }} fa-2x text-light"></i>
                                </div>
                            </div>
                            <h4 class="text-center mb-3">{{ $step['title'] }}</h4>
                            <p class="text-muted">
                                {{ $step['description'] }}
                            </p>
                            <div class="mt-auto text-center">
                                <a href="{{ $step['button_link'] }}" class="btn btn-outline-primary px-4"
                                    style="border-radius: 50px;">
                                    {{ $step['button_text'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- features -->
    <section id="features" class="py-5 my-5" style="background-color: #f8f9fc;">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge bg-primary bg-opacity-10 text-light px-3 py-2 mb-3" style="border-radius: 50px;">Our
                    Benefits</span>
                <h2 class="display-5 fw-bold">Why Choose <span class="text-primary">Eksperto</span>?</h2>
                <p class="text-muted col-lg-8 mx-auto">A trusted platform connecting clients with top-tier professionals to
                    get projects done right.</p>
            </div>

            <div class="row g-4">
                @php
                    $features = [
                        [
                            'icon' => 'fas fa-certificate',
                            'title' => 'Verified Experts',
                            'description' => 'Every professional on our platform is thoroughly vetted and verified to ensure you work with only the best in your industry.',
                            'delay' => 100
                        ],
                        [
                            'icon' => 'fas fa-lock',
                            'title' => 'Secure Transactions',
                            'description' => 'Our secure payment system ensures your financial information is protected while maintaining transparent processes.',
                            'delay' => 200
                        ],
                        [
                            'icon' => 'fas fa-headset',
                            'title' => '24/7 Support',
                            'description' => 'Our dedicated support team is available around the clock to assist you with any issues or questions you may have.',
                            'delay' => 300
                        ]
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $feature['delay'] }}">
                        <div class="card hover h-100 border-0 p-4">
                            <div class="text-center mb-3">
                                <div class="bg-primary bg-opacity-20 d-inline-flex p-3 rounded-circle">
                                    <i class="{{ $feature['icon'] }} fa-2x text-light"></i>
                                </div>
                            </div>
                            <h4 class="card-title text-center mb-3">{{ $feature['title'] }}</h4>
                            <p class="card-text text-muted text-center">
                                {{ $feature['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="bg-dark py-5">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <h5 class="text-white mb-3">Eksperto</h5>
                    <p class="text-light opacity-75">Connecting skilled professionals with clients for successful project
                        collaboration.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Services</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="text-white mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-light opacity-75">
                            <i class="fa-solid fa-envelope me-2"></i>
                            <a href="mailto:ekspertoapp@gmail.com"
                                class="text-light opacity-75 text-decoration-none">ekspertoapp@gmail.com</a>
                        </li>
                        <li class="mb-2 text-light opacity-75">
                            <i class="fa-solid fa-globe me-2"></i>
                            <a href="https://ekspertoapp.com"
                                class="text-light opacity-75 text-decoration-none">ekspertoapp.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 opacity-25">

            <div class="text-center text-light opacity-75">
                <p class="mb-0">&copy; 2024-2025 Eksperto. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection

@push('styles')
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
@endpush