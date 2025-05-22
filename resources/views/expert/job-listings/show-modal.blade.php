<div class="modal fade" id="viewJobModal{{ $jobListing->id }}" tabindex="-1"
    aria-labelledby="viewJobModalLabel{{ $jobListing->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-primary bg-opacity-10 py-4">
                <div>
                    <span class="badge bg-primary mb-2">{{ $jobListing->category }}</span>
                    <h4 class="modal-title fw-bold text-light" id="viewJobModalLabel{{ $jobListing->id }}">
                        {{ $jobListing->title }}
                    </h4>
                    <div class="d-flex align-items-center text-muted small mt-2">
                        <i class="fas fa-building me-2 text-light"></i>
                        <span class="text-light">{{ optional($jobListing->client)->name ?? 'Company Name' }}</span>
                        <span class="mx-2 text-light">•</span>
                        <i class="fas fa-map-marker-alt me-2 text-light"></i>
                        <span class="text-light">{{ $jobListing->location }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-3 text-dark"><i
                                        class="fas fa-info-circle me-2 text-primary"></i>Job Details
                                </h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-money-bill-wave text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Salary</div>
                                        <div class="fw-semibold">₱{{ number_format($jobListing->salary ?? 0, 2) }}
                                            @if ($jobListing->rate)
                                                <span class="text-muted small">({{ ucfirst($jobListing->rate) }})</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-briefcase text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Employment Type</div>
                                        <div class="fw-semibold">{{ ucfirst($jobListing->job_type) }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-calendar-alt text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Deadline</div>
                                        <div class="fw-semibold">
                                            {{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'No deadline specified' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-3 text-dark"><i
                                        class="fas fa-chart-line me-2 text-primary"></i>Application
                                    Stats</h6>
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-warning" data-bs-toggle="tooltip"
                                        title="Pending Applications">
                                        <i
                                            class="fas fa-clock me-1"></i>{{ $jobListing->jobApplications()->where('status', 'pending')->count() }}
                                    </span>
                                    <span class="badge bg-danger" data-bs-toggle="tooltip"
                                        title="Rejected Applications">
                                        <i
                                            class="fas fa-times-circle me-1"></i>{{ $jobListing->jobApplications()->where('status', 'rejected')->count() }}
                                    </span>
                                    <span class="badge bg-secondary" data-bs-toggle="tooltip"
                                        title="Cancelled Applications">
                                        <i
                                            class="fas fa-ban me-1"></i>{{ $jobListing->jobApplications()->where('status', 'cancelled')->count() }}
                                    </span>
                                    <span class="badge bg-success" data-bs-toggle="tooltip"
                                        title="Accepted Applications">
                                        <i
                                            class="fas fa-check-circle me-1"></i>{{ $jobListing->jobApplications()->where('status', 'accepted')->count() }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-users text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Total Applications</div>
                                        <div class="fw-semibold">{{ $jobListing->jobApplications()->count() }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                        <i class="fas fa-clipboard-list text-light"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Vacancies</div>
                                        <div class="fw-semibold">{{ $jobListing->vacancies }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-align-left text-primary me-2"></i>Job Description</h5>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($jobListing->description)) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold mb-3"><i class="fas fa-file-alt text-primary me-2"></i>Requirements</h5>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($jobListing->requirements)) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 gap-2 p-4">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>

                @php
                    $application = $jobListing->jobApplications->firstWhere('expert_id', auth()->user()->id);
                @endphp

                @if (!$jobListing->has_applied)
                    <a href="{{ route('expert.job-applications.create', ['job_listing_id' => $jobListing->id]) }}"
                        class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Apply Now
                    </a>
                @else
                    <a href="{{ route('expert.job-applications.show', $application) }}" class="btn btn-primary">
                        <i class="fas fa-eye me-1"></i> View Application
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>