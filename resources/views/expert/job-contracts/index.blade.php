@extends('expert.shell')

@section('expert-content')
    <div class="container mt-4">
        <h2 class="fw-bold"><i class="fas fa-file-signature"></i> My Job Contracts</h2>

        <a href="{{ route('expert.dashboard') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        @if ($jobContracts->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> You have no job contracts at the moment.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-briefcase"></i> Job Title</th>
                            <th><i class="fas fa-calendar-alt"></i> Start Date</th>
                            <th><i class="fas fa-calendar-check"></i> End Date</th>
                            <th><i class="fas fa-file-alt"></i> Contract Terms</th>
                            <th class="text-center"><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobContracts as $contract)
                            <tr>
                                <td>{{ $contract->jobApplication->jobListing->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') }}</td>
                                <td>{{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('M d, Y') : 'Ongoing' }}
                                </td>
                                <td>
                                    <a href="{{ route('expert.job-contracts.show', $contract->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View Terms
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('expert.job-contracts.show', $contract->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-contract"></i> View Contract
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection