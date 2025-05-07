@extends('client.shell')

@section('client-content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Contracts</h2>

        <!-- Back to Job Listings -->
        <a href="{{ route('client.job-listings.show', $jobListing->id) }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to the Job
        </a>

        <!-- Active Contracts -->
        <h4 class="fw-bold text-success">
            <i class="fas fa-file-contract"></i>
            Active Contracts
        </h4>
        <div class="row">
            @forelse ($activeContracts as $jobContract)
                <div class="col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Contract with {{ $jobContract->expert->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-alt"></i> Start Date:
                                {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-check"></i> End Date:
                                {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                            </p>
                            <p class="mb-3">
                                <span class="badge bg-success">Active</span>
                            </p>
                            <a href="{{ route('client.job-contracts.show', $jobContract->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> View Contract
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info" role="alert">
                    No active contracts.
                </div>
            @endforelse
        </div>

        <!-- Pending Contracts -->
        <h4 class="fw-bold text-warning mt-4">
            <i class="fas fa-clock"></i>
            Pending Contracts
        </h4>
        <div class="row">
            @forelse ($pendingContracts as $jobContract)
                <div class="col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Contract with {{ $jobContract->expert->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-alt"></i> Start Date:
                                {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-check"></i> End Date:
                                {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                            </p>
                            <p class="mb-3">
                                <span class="badge bg-warning">Pending</span>
                            </p>
                            <a href="{{ route('client.job-contracts.show', $jobContract->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> View Contract
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    No pending contracts.
                </div>
            @endforelse
        </div>

        <!-- Completed/Cancelled Contracts -->
        <h4 class="fw-bold text-secondary mt-4">
            <i class="fas fa-check-double"></i>
            Completed/Cancelled Contracts
        </h4>
        <div class="row">
            @forelse ($completedContracts as $jobContract)
                <div class="col-md-6 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Contract with {{ $jobContract->expert->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-alt"></i> Start Date:
                                {{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar-check"></i> End Date:
                                {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Completed' }}
                            </p>
                            <p class="mb-3">
                                <span class="badge bg-{{ $jobContract->status === 'completed' ? 'secondary' : 'danger' }}">
                                    {{ ucfirst($jobContract->status) }}
                                </span>
                            </p>
                            <a href="{{ route('client.job-contracts.show', $jobContract->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> View Contract
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary" role="alert">
                    No completed or cancelled contracts.
                </div>
            @endforelse
        </div>
    </div>
@endsection
