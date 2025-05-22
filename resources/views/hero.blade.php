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