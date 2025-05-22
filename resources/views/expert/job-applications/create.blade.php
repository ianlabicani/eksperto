@extends('expert.shell')

@section('expert-content')
    <div class="container py-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Job Listings
            </a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Job Details Card -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-primary bg-opacity-10 py-3 border-0">
                        <span class="badge bg-primary text-white mb-2">{{ $jobListing->category }}</span>
                        <h3 class="fw-bold mb-0 text-light">{{ $jobListing->title }}</h3>
                        <div class="d-flex align-items-center text-secondary mt-2 small">
                            <i class="fas fa-building me-1 text-light"></i>
                            <span class="text-light">{{ optional($jobListing->client)->name ?? 'Company Name' }}</span>
                            <span class="mx-2 text-light">•</span>
                            <i class="fas fa-map-marker-alt me-1 text-light"></i>
                            <span class="text-light">{{ $jobListing->location }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-money-bill-wave text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-secondary small">Salary</div>
                                        <div class="fw-semibold text-dark">₱{{ number_format($jobListing->salary ?? 0, 2) }}
                                            @if (isset($jobListing->rate))
                                                <span class="text-secondary small">({{ ucfirst($jobListing->rate) }})</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-briefcase text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-secondary small">Employment Type</div>
                                        <div class="fw-semibold text-dark">{{ ucfirst($jobListing->job_type) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-calendar-alt text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-secondary small">Posted On</div>
                                        <div class="fw-semibold text-dark">{{ $jobListing->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-clipboard-list text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-secondary small">Vacancies</div>
                                        <div class="fw-semibold text-dark">{{ $jobListing->vacancies ?? 'Not specified' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(!empty($jobListing->description))
                        <div class="mb-3">
                            <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-align-left text-primary me-2"></i>Job Description</h5>
                            <div class="bg-light p-3 rounded">
                                <div class="text-dark">{!! nl2br(e($jobListing->description)) !!}</div>
                            </div>
                        </div>
                        @endif

                        @if(!empty($jobListing->requirements))
                        <div class="mb-3">
                            <h5 class="fw-bold mb-3 text-dark"><i class="fas fa-file-alt text-primary me-2"></i>Requirements</h5>
                            <div class="bg-light p-3 rounded">
                                <div class="text-dark">{!! nl2br(e($jobListing->requirements)) !!}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Application Form Card -->
                <div class="card border-0 shadow-sm rounded-4 sticky-lg-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white py-3 border-0 rounded-top-4">
                        <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Submit Your Application</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('expert.job-applications.store') }}" method="POST" id="application-form">
                            @csrf
                            <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">
                            <input type="hidden" name="client_id" value="{{ $jobListing->client_id }}">

                            <div class="mb-4">
                                <label for="cover_letter" class="form-label fw-semibold text-dark">Cover Letter</label>
                                <p class="text-secondary small mb-2">Tell the employer why you're a great fit for this role. Highlight your relevant skills and experience.</p>
                                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="6" placeholder="Write your cover letter here..."></textarea>
                            </div>

                            <div class="alert alert-info border-0 d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle fs-4 me-3 text-primary"></i>
                                <div class="small text-dark">
                                    Your profile information will be included with this application automatically.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2" id="submit-button">
                                <i class="fas fa-paper-plane me-2"></i>Submit Application
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission with loading state
            const form = document.getElementById('application-form');
            const submitButton = document.getElementById('submit-button');

            if (form && submitButton) {
                form.addEventListener('submit', function() {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';
                });
            }
        });
    </script>
    @endpush
@endsection
