@extends('peso.shell')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold">Job Listings</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('peso.job-listings.index') }}" class="mb-3">
            <div class="row g-2">
                <!-- Search -->
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search title or category"
                        value="{{ request('search') }}">
                </div>

                <!-- Status Filter -->
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Date Range Filter -->
                <div class="col-md-4 d-flex align-items-center">
                    <!-- Start Date -->
                    <input type="date" name="start_date" class="form-control me-2" value="{{ request('start_date') }}">

                    <!-- Arrow Icon -->
                    <span class="mx-2">
                        <i class="fas fa-arrow-right"></i>
                    </span>

                    <!-- End Date -->
                    <input type="date" name="end_date" class="form-control ms-2" value="{{ request('end_date') }}">
                </div>


                <!-- Filter & Reset Buttons -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                    <a href="{{ route('peso.job-listings.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if ($jobListings->isEmpty())
            <div class="alert alert-info text-center">No job listings available.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Job Type</th>
                        <th>Salary</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Posted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobListings as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->category }}</td>
                            <td class="text-capitalize">{{ $job->job_type }}</td>
                            <td>₱{{ number_format($job->salary ?? 0, 2) }}</td>
                            <td>{{ $job->location }}</td>
                            <td>
                                <span class="badge {{ $job->status == 'open' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td>{{ $job->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('peso.job-listings.show', $job->id) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                                <a href="{{ route('peso.job-listings.edit', $job->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                <form action="{{ route('peso.job-listings.destroy', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this job?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $jobListings->links() }}
            </div>
        @endif
    </div>
@endsection