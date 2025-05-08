@extends('client.shell')

@section('client-content')
    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('client.job-listings.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill me-3">
                <i class="fas fa-arrow-left me-1"></i> Back to Jobs
            </a>
            <h4 class="fw-bold m-0">Job Details</h4>
        </div>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">{{ $jobListing->title }}</h4>
                            @php
                                $statusColor = match ($jobListing->status) {
                                    'open' => 'success',
                                    'filled' => 'info',
                                    'closed' => 'danger',
                                    default => 'secondary'
                                };
                                $statusIcon = match ($jobListing->status) {
                                    'open' => 'fas fa-check-circle',
                                    'filled' => 'fas fa-user-check',
                                    'closed' => 'fas fa-times-circle',
                                    default => 'fas fa-circle'
                                };
                            @endphp
                            <span class="badge bg-{{ $statusColor }} bg-opacity-10 text-{{ $statusColor }} py-2 px-3">
                                <i class="{{ $statusIcon }} me-1"></i> {{ ucfirst($jobListing->status) }}
                            </span>
                        </div>

                        <div class="d-flex flex-wrap text-muted small mb-4">
                            <div class="me-3 mb-2">
                                <i class="fas fa-tag me-1"></i> {{ $jobListing->category }}
                            </div>
                            <div class="me-3 mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $jobListing->location ?: 'Remote' }}
                            </div>
                            <div class="me-3 mb-2">
                                <i class="fas fa-briefcase me-1"></i> {{ ucfirst($jobListing->job_type) }}
                            </div>
                            <div class="mb-2">
                                <i class="fas fa-calendar-alt me-1"></i> Posted
                                {{ $jobListing->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        <h5 class="fw-semibold mb-2">Description</h5>
                        <div class="mb-4">
                            {!! nl2br(e($jobListing->description)) !!}
                        </div>

                        <h5 class="fw-semibold mb-2">Requirements</h5>
                        <div class="mb-3">
                            {!! nl2br(e($jobListing->requirements)) !!}
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Applications ({{ $jobListing->jobApplications->count() }})</h5>

                        @if($jobListing->jobApplications->count() > 0)
                            <div class="mb-3">
                                <a href="{{ route('client.job-listings.show-with-applications', $jobListing->id) }}"
                                    class="btn btn-primary px-4">
                                    <i class="fas fa-users me-2"></i>View Applications
                                </a>
                            </div>

                            <div class="small text-muted">
                                Manage applications and select candidates for this job.
                            </div>
                        @else
                            <div class="alert alert-light border-0 text-center">
                                <div class="mb-2"><i class="fas fa-info-circle text-muted"></i></div>
                                <p class="mb-0">No applications received yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Job Details</h5>

                        <div class="mb-3 pb-3 border-bottom">
                            <div class="small text-muted mb-1">Salary/Budget</div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                <span class="fw-medium">₱{{ number_format($jobListing->salary ?? 0, 2) }}
                                    ({{ ucfirst($jobListing->rate) }})</span>
                            </div>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <div class="small text-muted mb-1">Vacancies</div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span class="fw-medium">{{ $jobListing->vacancies }} position(s)</span>
                            </div>
                        </div>

                        <div class="mb-3 pb-3 border-bottom">
                            <div class="small text-muted mb-1">Application Deadline</div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-danger me-2"></i>
                                <span
                                    class="fw-medium">{{ $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') : 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="small text-muted mb-1">Job Type</div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-briefcase text-secondary me-2"></i>
                                <span class="fw-medium text-capitalize">{{ $jobListing->job_type }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card no-hover border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Actions</h5>

                        <div class="d-grid gap-2">
                            <a href="{{ route('client.job-listings.edit', $jobListing->id) }}"
                                class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Edit Job
                            </a>

                            <a href="{{ route('client.job-listings.showWithContracts', $jobListing->id) }}"
                                class="btn btn-outline-success">
                                <i class="fas fa-file-contract me-2"></i>View Contracts
                            </a>

                            @if($jobListing->status == 'open')
                                <button type="button" class="btn btn-outline-danger" id="closeJobBtn">
                                    <i class="fas fa-times-circle me-2"></i>Close Job
                                </button>

                                <form id="closeJobForm" method="POST"
                                    action="{{ route('client.job-listings.update-status', $jobListing->id) }}" class="d-none">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="closed">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle close job button
            const closeJobBtn = document.getElementById('closeJobBtn');
            const closeJobForm = document.getElementById('closeJobForm');

            if (closeJobBtn) {
                closeJobBtn.addEventListener('click', function () {
                    if (confirm('Are you sure you want to close this job listing?')) {
                        // Disable button and show loading state
                        this.disabled = true;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Closing...';

                        // Submit the form
                        closeJobForm.submit();
                    }
                });
            }
        });
    </script>
@endpush