@extends('expert.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-file-contract"></i> Job Contract Details</h2>

        <a href="{{ route('expert.job-contracts.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Contracts
        </a>

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-briefcase"></i>
                    {{ $jobContract->jobApplication->jobListing->title }}</h4>
                <p><strong><i class="fas fa-calendar-alt"></i> Start Date:</strong>
                    {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                </p>
                <p><strong><i class="fas fa-calendar-check"></i> End Date:</strong>
                    {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                </p>
                <p class="mt-2">
                    <strong><i class="fas fa-info-circle"></i> Status:</strong>
                    @php
                        $status = $jobContract->status;
                        $statusBadge = match ($status) {
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'secondary',
                            default => 'dark',
                        };
                    @endphp
                    <span class="badge bg-{{ $statusBadge }}">
                        {{ ucfirst($jobContract->contractNegotiation->status) }}
                    </span>
                </p>
                <p><strong><i class="fas fa-file-alt"></i> Contract Terms:</strong></p>
                <div class="border p-3 bg-light rounded w-75 me-auto">
                    {!! nl2br(e($jobContract->contract_terms)) !!}
                </div>

                <!-- TODO:  make another layer for checking this in controller-->
                @if ($jobContract->contractNegotiation === null)
                    <div class="mt-4 d-flex gap-2 align-items-center">
                        <form action="{{ route('expert.job-contracts.accept', $jobContract->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Accept Contract
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Check if negotiation has already been requested -->
        @if ($jobContract->contractNegotiation !== null)
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> You have already negotiated. Awaiting client's response.
            </div>

            <!-- Display Negotiation Details -->
            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-comments"></i> Negotiation Request</h5>
                    <p><strong><i class="fas fa-user"></i> Expert:</strong>
                        {{ $jobContract->contractNegotiation->expert->name }}
                    </p>
                    <p class="mt-2">
                        <strong><i class="fas fa-info-circle"></i> Status:</strong>

                        @php
                            $status = $jobContract->contractNegotiation->status;
                            $statusBadge = match ($status) {
                                'pending' => 'warning',
                                'accepted' => 'success',
                                'rejected' => 'danger',
                                'cancelled' => 'secondary',
                                default => 'dark',
                            };
                        @endphp

                        <span class="badge bg-{{ $statusBadge }}">
                            {{ ucfirst($jobContract->contractNegotiation->status) }}
                        </span>
                    </p>
                    <p><strong><i class="fas fa-file-alt"></i> Proposed Changes:</strong></p>
                    <div class="border p-3 bg-light rounded w-75 ms-auto">
                        {!! nl2br(e($jobContract->contractNegotiation->negotiation_message)) !!}
                    </div>

                </div>
            </div>
        @else
            <!-- Amend Contract Form -->
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-edit"></i> Negotiate Contract</h5>
                    <p class="text-muted">
                        <small><i class="fas fa-info-circle"></i> You can only negotiate once.
                            If the client does not accept your amendment, the application will be terminated.</small>
                    </p>

                    <form action="{{ route('expert.contract-negotiations.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="job_contract_id" value="{{ $jobContract->id }}">
                        <div class="mb-3">
                            <label for="negotiation_message" class="form-label"><i class="fas fa-file-alt"></i> Proposed
                                Changes</label>
                            <textarea class="form-control" name="negotiation_message" id="negotiation_message" rows="5"
                                required>{{ old('negotiation_message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane"></i> Submit Negotiation
                            Request</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
