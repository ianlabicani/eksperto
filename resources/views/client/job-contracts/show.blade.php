@extends('client.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-file-contract"></i> Job Contract Details</h2>

        @include('_ui.button-back')

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-briefcase"></i>
                    {{ $jobContract->jobApplication->jobListing->title }}
                </h4>
                <p><strong><i class="fas fa-calendar-alt"></i> Start Date:</strong>
                    {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                </p>
                <p><strong><i class="fas fa-calendar-check"></i> End Date:</strong>
                    {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                </p>
                <p class="mt-2">
                    <strong><i class="fas fa-info-circle"></i> Status:</strong>
                    @php
                        $statusBadge = match ($jobContract->status) {
                            'pending' => 'warning',
                            'active' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'secondary',
                            default => 'dark',
                        };
                    @endphp
                    <span class="badge bg-{{ $statusBadge }}">
                        {{ ucfirst($jobContract->status) }}
                    </span>
                </p>
                <p><strong><i class="fas fa-file-alt"></i> Contract Terms:</strong></p>
                <div class="border p-3 bg-light rounded w-75 ms-auto">
                    {!! nl2br(e($jobContract->contract_terms)) !!}
                </div>
            </div>
        </div>

        @if ($jobContract->status === 'active')
            <div class="alert alert-success mt-4">
                <i class="fas fa-check-circle"></i> Congratulations! Your contract is now active. We wish you a successful
                collaboration ahead!
            </div>
        @endif

        <!-- Display Negotiation Request if exists -->
        @if ($jobContract->contractNegotiation !== null)
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-comments"></i> Expert's Negotiation Request</h5>
                    <p><strong><i class="fas fa-user"></i> Expert:</strong>
                        {{ $jobContract->contractNegotiation->expert->name }}
                    </p>
                    <p><strong><i class="fas fa-file-alt"></i> Proposed Changes:</strong></p>
                    <p class="mt-2">
                        <strong><i class="fas fa-info-circle"></i> Status:</strong>
                        @php
                            $negotiationStatus = $jobContract->contractNegotiation->status;
                            $negotiationBadge = match ($negotiationStatus) {
                                'pending' => 'warning',
                                'accepted' => 'success',
                                'rejected' => 'danger',
                                default => 'dark',
                            };
                        @endphp
                        <span class="badge bg-{{ $negotiationBadge }}">
                            {{ ucfirst($negotiationStatus) }}
                        </span>
                    </p>
                    <div class="border p-3 bg-light rounded w-75 me-auto">
                        {!! nl2br(e($jobContract->contractNegotiation->negotiation_message)) !!}
                    </div>

                    <!-- Client can accept or reject if negotiation is still pending -->
                    @if($negotiationStatus === 'pending')
                        <div class="mt-3 d-flex gap-2">
                            <form action="{{ route('client.contract-negotiations.accept', $jobContract->contractNegotiation->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Accept Negotiation
                                </button>
                            </form>

                            <form action="{{ route('client.contract-negotiations.reject', $jobContract->contractNegotiation->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i> Reject Negotiation
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection