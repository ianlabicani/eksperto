@extends('client.shell')

@section('client-content')
    <div class="container mt-5 mb-5">

        {{-- Job Listing Details --}}
        <div class="mb-5">
            <h2 class="fw-bold text-dark mb-4"><i class="fas fa-briefcase me-2 text-primary"></i> Job Listing Details</h2>

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary">{{ $jobListing->title }}</h4>
                    <p class="text-muted mb-3"><i class="fas fa-code me-1"></i> {{ $jobListing->category }}</p>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <p><i class="fas fa-tag me-1 text-secondary"></i><strong>Salary:</strong>
                                ₱{{ number_format($jobListing->salary, 2) }}</p>
                            <p><i class="fas fa-briefcase me-1 text-secondary"></i><strong>Job Type:</strong>
                                {{ ucfirst($jobListing->job_type) }}</p>
                            <p><i class="fas fa-clock me-1 text-secondary"></i><strong>Rate:</strong>
                                {{ ucfirst($jobListing->rate) }}</p>
                            <p><i class="fas fa-users me-1 text-secondary"></i><strong>Vacancies:</strong>
                                {{ $jobListing->vacancies }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-map-marker-alt me-1 text-secondary"></i><strong>Location:</strong>
                                {{ $jobListing->location }}</p>
                            <p><i class="fas fa-calendar-alt me-1 text-secondary"></i><strong>Deadline:</strong>
                                {{ \Carbon\Carbon::parse($jobListing->deadline)->format('M d, Y') }}</p>
                            <p><i class="fas fa-info-circle me-1 text-secondary"></i><strong>Status:</strong>
                                <span class="badge bg-{{ $jobListing->status === 'open' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($jobListing->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <p class="fw-semibold"><i class="fas fa-align-left me-1 text-secondary"></i> Description:</p>
                    <div class="bg-light p-3 rounded mb-4 border">
                        {!! nl2br(e($jobListing->description)) !!}
                    </div>

                    <p class="fw-semibold"><i class="fas fa-tools me-1 text-secondary"></i> Requirements:</p>
                    <div class="bg-light p-3 rounded border">
                        {!! nl2br(e($jobListing->requirements)) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Job Contract --}}
        <div class="mb-5">
            <h2 class="fw-bold text-dark mb-4"><i class="fas fa-file-contract me-2 text-primary"></i> Job Contract Details
            </h2>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold"><i class="fas fa-briefcase me-2 text-secondary"></i>
                        {{ $jobContract->jobApplication->jobListing->title }}</h4>
                    <p><i class="fas fa-calendar-alt me-1 text-secondary"></i><strong>Start Date:</strong>
                        {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}</p>
                    <p><i class="fas fa-calendar-check me-1 text-secondary"></i><strong>End Date:</strong>
                        {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                    </p>

                    @php
                        $statusBadge = match ($jobContract->status) {
                            'pending' => 'warning',
                            'active' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'secondary',
                            default => 'dark',
                        };
                    @endphp

                    <p><i class="fas fa-info-circle me-1 text-secondary"></i><strong>Status:</strong>
                        <span class="badge bg-{{ $statusBadge }}">{{ ucfirst($jobContract->status) }}</span>
                    </p>

                    <p><i class="fas fa-file-alt me-1 text-secondary"></i><strong>Contract Terms:</strong></p>
                    <div class="bg-light border p-3 rounded w-100">
                        {!! nl2br(e($jobContract->contract_terms)) !!}
                    </div>
                </div>
            </div>
        </div>

        @if ($jobContract->status === 'active')
            <div class="alert alert-success shadow-sm rounded-3 p-4">
                <i class="fas fa-check-circle me-1"></i> Congratulations! Your contract is now active. We wish you a successful
                collaboration ahead!
            </div>
        @endif

        @if ($jobContract->contractNegotiation !== null)
            <div class="card shadow-sm mt-4 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold"><i class="fas fa-comments me-2 text-warning"></i> Expert's Negotiation Request</h5>
                    <p><i class="fas fa-user me-1 text-secondary"></i><strong>Expert:</strong>
                        {{ $jobContract->contractNegotiation->expert->name }}</p>

                    @php
                        $negotiationStatus = $jobContract->contractNegotiation->status;
                        $negotiationBadge = match ($negotiationStatus) {
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            default => 'dark',
                        };
                    @endphp

                    <p><i class="fas fa-info-circle me-1 text-secondary"></i><strong>Status:</strong>
                        <span class="badge bg-{{ $negotiationBadge }}">{{ ucfirst($negotiationStatus) }}</span>
                    </p>

                    <p><i class="fas fa-file-alt me-1 text-secondary"></i><strong>Proposed Changes:</strong></p>
                    <div class="bg-light border p-3 rounded w-100">
                        {!! nl2br(e($jobContract->contractNegotiation->negotiation_message)) !!}
                    </div>

                    @if($negotiationStatus === 'pending')
                        <div class="mt-4 d-flex gap-2">
                            <form action="{{ route('client.contract-negotiations.accept', $jobContract->contractNegotiation->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-1"></i> Accept
                                </button>
                            </form>
                            <form action="{{ route('client.contract-negotiations.reject', $jobContract->contractNegotiation->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times me-1"></i> Reject
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
@endsection
