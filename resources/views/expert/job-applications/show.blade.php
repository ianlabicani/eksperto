@extends('expert.shell')

@section('expert-content')
    <div class="container mt-4">
        <!-- Header Section with improved spacing and hierarchy -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('expert.job-applications.index') }}" class="text-decoration-none">
                                <i class="fas fa-briefcase"></i> Applications
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0 display-6">
                    {{ $jobApplication->jobListing->title }}
                </h2>
                <p class="text-muted">
                    <i class="fas fa-clock me-1"></i> Submitted {{ $jobApplication->created_at->diffForHumans() }}
                </p>
            </div>
            @php
                $status = $jobApplication->status;
                $statusBadge = match ($status) {
                    'pending' => 'warning',
                    'accepted' => 'success',
                    'rejected' => 'danger',
                    'cancelled' => 'secondary',
                    default => 'dark',
                };
                $statusIcon = match ($status) {
                    'pending' => 'clock',
                    'accepted' => 'check-circle',
                    'rejected' => 'times-circle',
                    'cancelled' => 'ban',
                    default => 'info-circle',
                };
            @endphp
            <div class="text-end">
                <span class="badge bg-{{ $statusBadge }} px-3 py-2 rounded-pill fs-6 mb-2 d-block">
                    <i class="fas fa-{{ $statusIcon }} me-1"></i> {{ ucfirst($status) }}
                </span>
                <span class="text-muted small">
                    <i class="fas fa-map-marker-alt me-1"></i> {{ $jobApplication->jobListing->location }}
                </span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Application Details -->
            <div class="col-lg-8">
                <!-- Applicant Details Card -->
                <div class="card shadow-sm rounded-4 border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="fas fa-user fa-lg text-light"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ $jobApplication->expert->name }}</h5>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-envelope me-2"></i>{{ $jobApplication->expert->email }}
                                </p>
                            </div>
                        </div>

                        @if ($jobApplication->resume)
                            <a href="{{ asset('storage/' . $jobApplication->resume) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="fas fa-file-pdf me-2"></i> View Resume
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Cover Letter Card -->
                <div class="card shadow-sm rounded-4 border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-2 me-2">
                                <i class="fas fa-envelope-open-text text-light"></i>
                            </div>
                            Cover Letter
                        </h5>
                        @if ($jobApplication->cover_letter)
                            <div class="bg-light p-4 rounded-4" style="max-height: 400px; overflow-y: auto;">
                                <div class="prose" style="white-space: pre-line;">
                                    {{ $jobApplication->cover_letter }}
                                </div>
                            </div>
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-file-alt fa-3x mb-3"></i>
                                <p class="mb-0">No cover letter provided</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status Alert -->
                @if ($jobApplication->status !== 'pending')
                    <div class="alert alert-{{ $statusBadge }} d-flex align-items-center rounded-4 border-0">
                        <div class="bg-white rounded-circle p-2 me-3">
                            <i class="fas fa-{{ $statusIcon }} text-{{ $statusBadge }}"></i>
                        </div>
                        <div>
                            @if ($status === 'cancelled')
                                You cancelled this application.
                            @elseif ($status === 'accepted')
                                Congratulations! Your application has been accepted.
                            @elseif ($status === 'rejected')
                                We're sorry, your application has been rejected.
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Cancel Button for Pending Applications -->
                @if ($jobApplication->status === 'pending')
                    <button type="button" class="btn btn-outline-danger rounded-pill w-100 py-2" data-bs-toggle="modal"
                        data-bs-target="#confirmCancelModal">
                        <i class="fas fa-times me-2"></i> Cancel Application
                    </button>
                @endif
            </div>

            <!-- Contract Section -->
            <div class="col-lg-4">
                @if ($jobApplication->jobContract)
                    <div class="card shadow-sm rounded-4 border-0">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-file-signature fa-lg text-light"></i>
                                </div>
                                <h5 class="fw-bold mb-0">Contract Details</h5>
                            </div>

                            @php
                                $contractStatus = $jobApplication->jobContract->status;
                                $contractBadge = match ($contractStatus) {
                                    'pending' => 'warning',
                                    'accepted' => 'success',
                                    'rejected' => 'danger',
                                    'cancelled' => 'secondary',
                                    default => 'dark',
                                };
                                $contractIcon = match ($contractStatus) {
                                    'pending' => 'clock',
                                    'accepted' => 'check-circle',
                                    'rejected' => 'times-circle',
                                    'cancelled' => 'ban',
                                    default => 'info-circle',
                                };
                            @endphp

                            <span class="badge bg-{{ $contractBadge }} mb-4 px-3 py-2 rounded-pill d-block text-center">
                                <i class="fas fa-{{ $contractIcon }} me-1"></i> {{ ucfirst($contractStatus) }}
                            </span>

                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-light rounded-circle p-2 me-2">
                                        <i class="fas fa-calendar-alt text-light"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Start Date</small>
                                        <strong>{{ \Carbon\Carbon::parse($jobApplication->jobContract->start_date)->format('M d, Y') }}</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2">
                                        <i class="fas fa-calendar-check text-light"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">End Date</small>
                                        <strong>{{ $jobApplication->jobContract->end_date ? \Carbon\Carbon::parse($jobApplication->jobContract->end_date)->format('M d, Y') : 'Ongoing' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-file-alt text-light me-2"></i>Contract Terms
                                </h6>
                                <div class="bg-light p-3 rounded-4" style="max-height: 200px; overflow-y: auto;">
                                    <div style="white-space: pre-line;">{{ $jobApplication->jobContract->contract_terms }}</div>
                                </div>
                            </div>

                            <a href="{{ route('expert.job-contracts.show', $jobApplication->jobContract->id) }}"
                                class="btn btn-primary rounded-pill w-100 py-2">
                                <i class="fas fa-eye me-2"></i> View Full Contract
                            </a>
                        </div>
                    </div>
                @else
                    @if($jobApplication->status === 'pending')
                        <div class="alert alert-info rounded-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-2 me-3">
                                    <i class="fas fa-info-circle text-info"></i>
                                </div>
                                <div>The client is still reviewing your application.</div>
                            </div>
                        </div>
                    @elseif($jobApplication->status === 'rejected')
                        <div class="alert alert-danger rounded-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-2 me-3">
                                    <i class="fas fa-times-circle text-danger"></i>
                                </div>
                                <div>Your application was not accepted. You might want to explore other opportunities.</div>
                            </div>
                        </div>
                    @elseif($jobApplication->status === 'cancelled')
                        <div class="alert alert-secondary rounded-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-2 me-3">
                                    <i class="fas fa-ban text-secondary"></i>
                                </div>
                                <div>You cancelled this application.</div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 text-center pb-0">
                    <h5 class="modal-title w-100 text-danger" id="confirmCancelModalLabel">
                        Cancel Application
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                    </div>
                    <h5 class="mb-2">Are you sure?</h5>
                    <p class="text-muted mb-0">
                        This action cannot be undone. The application will be permanently cancelled.
                    </p>
                </div>
                <div class="modal-footer flex-column border-0 px-4 pb-4">
                    <form action="{{ route('expert.job-applications.update', $jobApplication->id) }}" method="POST"
                        class="w-100">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger rounded-pill w-100 mb-2">
                            <i class="fas fa-check me-2"></i> Yes, Cancel Application
                        </button>
                        <button type="button" class="btn btn-light rounded-pill w-100" data-bs-dismiss="modal">
                            Keep Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar styling */
        .bg-light::-webkit-scrollbar {
            width: 6px;
        }

        .bg-light::-webkit-scrollbar-track {
            background: transparent;
        }

        .bg-light::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 3px;
        }

        .bg-light::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }

        /* Smooth transitions */
        .btn,
        .badge,
        .alert {
            transition: all 0.2s ease-in-out;
        }

        /* Hover effects */
        .btn:hover {
            transform: translateY(-1px);
        }

        /* Typography */
        .prose {
            line-height: 1.6;
            font-size: 1rem;
            color: #4a5568;
        }

        /* Card hover effect */
        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection