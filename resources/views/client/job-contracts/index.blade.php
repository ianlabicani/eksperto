@extends('client.shell')

@section('content')
    <div class="container my-4">
        <a href="{{ route('client.job-contracts.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Create New Contract
        </a>

        <h2 class="mb-4">Job Contracts</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Application</th>
                        <th>Expert</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Contract Terms</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobContracts as $jobContract)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('client.job-applications.show', $jobContract->job_application_id) }}">
                                    {{ $jobContract->jobApplication->jobListing->title }}
                                </a>
                            </td>
                            <td>{{ $jobContract->expert->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $jobContract->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($jobContract->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}</td>
                            <td>
                                {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                            </td>
                            <td>{{ Str::limit($jobContract->contract_terms, 50) }}</td>
                            <td>
                                <a href="{{ route('client.job-contracts.show', $jobContract->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('client.job-contracts.edit', $jobContract->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No job contracts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection