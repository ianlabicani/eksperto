@extends('client.shell')

@section('client-content')
    <div class="container py-4">
        <!-- Back button and title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold mb-0">
                <i class="fas fa-file-alt me-2 text-primary"></i>Application Details
            </h2>
            <a href="{{ route('client.job-applications.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Applications
            </a>
        </div>

        <div class="row g-4">
            <!-- Left Column: Applicant Details -->
            <div class="col-lg-4">
                <!-- Applicant Card -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                        <h5 class="mb-0 fw-bold text-light">
                            <i class="fas fa-user-circle me-2"></i>Applicant
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="avatar-placeholder rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 100px; height: 100px;">
                                <i class="fas fa-user fa-3x text-light opacity-50"></i>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $expert->name }}</h5>
                            <p class="text-muted mb-0">
                                <i class="fas fa-envelope me-1"></i> {{ $expert->email }}
                            </p>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="fas fa-calendar-alt text-light"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Applied on</div>
                                <div class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($jobApplication->created_at)->format('M d, Y') }}
                                </div>
                                <div class="text-muted small">
                                    {{ \Carbon\Carbon::parse($jobApplication->created_at)->format('h:i A') }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                <i class="fas fa-clipboard-check text-light"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Status</div>
                                @php
                                    $statusClass = match ($jobApplication->status) {
                                        'pending' => 'bg-warning',
                                        'accepted' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                    $statusIcon = match ($jobApplication->status) {
                                        'pending' => 'fa-hourglass-half',
                                        'accepted' => 'fa-check-circle',
                                        'rejected' => 'fa-times-circle',
                                        default => 'fa-info-circle'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill">
                                    <i class="fas {{ $statusIcon }} me-1"></i>
                                    {{ ucfirst($jobApplication->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Card (for Pending Applications) -->
                @if ($jobApplication->status === 'pending')
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-header bg-warning bg-opacity-10 border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-tasks me-2 text-warning"></i>Actions Required
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted mb-3">This application requires your review. Would you like to accept or reject
                                this applicant?</p>
                            <div class="d-grid gap-2">
                                <form action="{{ route('client.job-applications.accept', $jobApplication->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-check-circle me-2"></i>Accept Application
                                    </button>
                                </form>

                                <form action="{{ route('client.job-applications.reject', $jobApplication->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-times-circle me-2"></i>Reject Application
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contract Creation Card (for Accepted Applications) -->
                @if ($jobApplication->status === 'accepted' && !$jobApplication->jobContract)
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-file-contract me-2 text-success"></i>Create Contract
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted mb-3">This application has been accepted. You can now create a contract for
                                this applicant.</p>
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#createContractModal">
                                <i class="fas fa-file-signature me-2"></i>Create Contract
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Application Details -->
            <div class="col-lg-8">
                <!-- Cover Letter Card -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                        <h5 class="mb-0 fw-bold text-light">
                            <i class="fas fa-envelope-open-text me-2 "></i>Cover Letter
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if(!empty($jobApplication->cover_letter))
                            <div class="bg-light p-3 rounded-3">
                                {!! nl2br(e($jobApplication->cover_letter)) !!}
                            </div>
                        @else
                            <div class="text-center text-muted p-4">
                                <i class="fas fa-file-alt fa-3x mb-3 opacity-50"></i>
                                <p>No cover letter provided.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Work Experience Card -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                        <h5 class="mb-0 fw-bold text-light">
                            <i class="fas fa-briefcase me-2 "></i>Work Experience
                        </h5>
                    </div>

                    @if ($expert->workExperiences->isNotEmpty())
                        <div class="card-body p-4">
                            <div class="timeline">
                                @foreach ($expert->workExperiences as $experience)
                                    <div class="timeline-item mb-4 position-relative">
                                        <div class="timeline-dot bg-primary rounded-circle position-absolute"
                                            style="left: -40px; top: 0; width: 12px; height: 12px;"></div>
                                        <h6 class="fw-bold mb-1">{{ $experience->job_title }}</h6>
                                        <p class="mb-1 text-primary">{{ $experience->company_name }}</p>
                                        <p class="mb-2 text-muted small">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} –
                                            {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                                        </p>
                                        <div class="bg-light p-3 rounded-3">
                                            {!! nl2br(e($experience->description)) !!}
                                        </div>
                                        @unless($loop->last)
                                            <div class="timeline-line position-absolute bg-light"
                                                style="left: -34px; top: 12px; width: 1px; height: calc(100% + 24px);"></div>
                                        @endunless
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="card-body p-4">
                            <div class="text-center text-muted p-4">
                                <i class="fas fa-briefcase fa-3x mb-3 opacity-50"></i>
                                <p>No work experience listed.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contract Modal -->
        @if ($jobApplication->status === 'accepted' && !$jobApplication->jobContract)
            @include('client.job-applications.partials.job-contract-create')
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }
    </style>
@endpush