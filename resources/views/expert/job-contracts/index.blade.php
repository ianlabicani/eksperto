@extends('expert.shell')

@section('expert-content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 fw-bold text-primary">My Contracts</h1>
                <a href="{{ route('expert.dashboard') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    @if ($jobContracts->isEmpty())
        <div class="alert alert-info rounded-3 shadow-sm border-0 p-4 text-center">
            <i class="fas fa-file-signature fs-4 mb-3 d-block"></i>
            <h4 class="fw-bold">No Active Contracts</h4>
            <p class="mb-0">You don't have any job contracts at the moment. Contracts will appear here once your job
                applications are accepted.</p>
        </div>
    @else
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 px-4"><i class="fas fa-briefcase text-primary me-2"></i>Job Title</th>
                                <th class="py-3"><i class="fas fa-calendar-alt text-primary me-2"></i>Start Date</th>
                                <th class="py-3"><i class="fas fa-calendar-check text-primary me-2"></i>End Date</th>
                                <th class="py-3 text-end pe-4"><i class="fas fa-cogs text-primary me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobContracts as $contract)
                                <tr>
                                    <td class="py-3 px-4 fw-medium">{{ $contract->jobApplication->jobListing->title }}</td>
                                    <td class="py-3">{{ \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        @if($contract->end_date)
                                            {{ \Carbon\Carbon::parse($contract->end_date)->format('M d, Y') }}
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                                <i class="fas fa-clock me-1"></i> Ongoing
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-end pe-4">
                                        <a href="{{ route('expert.job-contracts.show', $contract->id) }}"
                                            class="btn btn-primary btn-sm px-3">
                                            <i class="fas fa-file-contract me-1"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination (if available) -->
        @if($jobContracts instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-center mt-4">
                {{ $jobContracts->links() }}
            </div>
        @endif
    @endif
@endsection
