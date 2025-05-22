@extends('client.shell')

@section('client-content')
    <div class="container py-4">
        <h2 class="fw-bold text-primary mb-4">
            <i class="fas fa-briefcase me-2"></i>Job Applications
        </h2>

        <!-- Application Status Summary -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-hourglass-half text-warning"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle text-muted mb-1">Pending</h6>
                            <h3 class="card-title mb-0">{{ $pendingApplications->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle text-muted mb-1">Accepted</h6>
                            <h3 class="card-title mb-0">{{ $acceptedApplications->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle text-muted mb-1">Rejected</h6>
                            <h3 class="card-title mb-0">{{ $rejectedApplications->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-list text-light"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle text-muted mb-1">Total</h6>
                            <h3 class="card-title mb-0">{{ $pendingApplications->count() + $acceptedApplications->count() + $rejectedApplications->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Job Title</th>
                                <th>Applicant</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingApplications as $application)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $application->jobListing->title }}</div>
                                        <div class="text-muted small">{{ $application->jobListing->category }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $application->expert->name }}</div>
                                        <div class="text-muted small">{{ $application->expert->email }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">
                                            <i class="fas fa-hourglass-half me-1"></i>Pending
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('client.job-applications.show', $application->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                        No pending applications
                                    </td>
                                </tr>
                            @endforelse

                            @foreach ($acceptedApplications as $application)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $application->jobListing->title }}</div>
                                        <div class="text-muted small">{{ $application->jobListing->category }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $application->expert->name }}</div>
                                        <div class="text-muted small">{{ $application->expert->email }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Accepted
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('client.job-applications.show', $application->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($rejectedApplications as $application)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $application->jobListing->title }}</div>
                                        <div class="text-muted small">{{ $application->jobListing->category }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $application->expert->name }}</div>
                                        <div class="text-muted small">{{ $application->expert->email }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Rejected
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('client.job-applications.show', $application->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
