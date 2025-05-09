@extends('client.shell')

@section('client-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1">
                    <i class="fas fa-file-contract me-2"></i>Job Contracts
                </h2>
                <p class="text-muted mb-md-0">Manage your active and past contracts with experts</p>
            </div>

            <div class="d-flex flex-column flex-sm-row mt-3 mt-md-0 gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="contractSearch" class="form-control bg-light border-start-0"
                        placeholder="Search contracts...">
                </div>
                <a href="{{ route('client.job-contracts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create Contract
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <div class="d-flex">
                    <i class="fas fa-check-circle my-auto me-2"></i>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Contract Status Summary with improved visualization -->
        <div class="row g-4 mb-4">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-success bg-opacity-10"
                        style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-success bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-check-circle text-success fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Active</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">
                                {{ $jobContracts->where('status', 'active')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-warning bg-opacity-10"
                        style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-hourglass-half text-warning fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Pending</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">
                                {{ $jobContracts->where('status', 'pending')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-info bg-opacity-10" style="width: 8px; height: 100%; left: 0; top: 0;">
                    </div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-info bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-check-double text-info fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Completed</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">
                                {{ $jobContracts->where('status', 'completed')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                    <div class="position-absolute bg-danger bg-opacity-10"
                        style="width: 8px; height: 100%; left: 0; top: 0;"></div>
                    <div class="card-body d-flex align-items-center ps-4">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-2 p-sm-3">
                            <i class="fas fa-times-circle text-danger fa-lg fa-sm-2x"></i>
                        </div>
                        <div class="ms-2 ms-sm-3">
                            <h6 class="card-subtitle text-muted mb-1 small">Cancelled</h6>
                            <h3 class="card-title mb-0 fw-bold h4 h-sm-3">
                                {{ $jobContracts->where('status', 'cancelled')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter tabs with scrolling on mobile -->
        <div class="mb-4 w-100 overflow-auto pb-2">
            <ul class="nav nav-tabs flex-nowrap" id="contractTabs" role="tablist" style="min-width: 500px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-status="all">
                        All <span class="badge rounded-pill bg-secondary ms-1">{{ $jobContracts->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-status="active">
                        Active <span
                            class="badge rounded-pill bg-success ms-1">{{ $jobContracts->where('status', 'active')->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-status="pending">
                        Pending <span
                            class="badge rounded-pill bg-warning ms-1">{{ $jobContracts->where('status', 'pending')->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-status="completed">
                        Completed <span
                            class="badge rounded-pill bg-info ms-1">{{ $jobContracts->where('status', 'completed')->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-status="cancelled">
                        Cancelled <span
                            class="badge rounded-pill bg-danger ms-1">{{ $jobContracts->where('status', 'cancelled')->count() }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Mobile Contract Cards (visible on small screens) -->
        <div class="d-md-none">
            @forelse($jobContracts as $jobContract)
                <div class="card mb-3 border-0 shadow-sm contract-row" data-status="{{ $jobContract->status }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">
                                    <a href="{{ route('client.job-applications.show', $jobContract->job_application_id) }}"
                                        class="text-decoration-none text-primary">
                                        {{ $jobContract->jobApplication->jobListing->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-0">{{ $jobContract->jobApplication->jobListing->category }}</p>
                            </div>

                            @php
                                $statusBadge = match ($jobContract->status) {
                                    'active' => 'success',
                                    'pending' => 'warning',
                                    'completed' => 'info',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };

                                $statusIcon = match ($jobContract->status) {
                                    'active' => 'check-circle',
                                    'pending' => 'hourglass-half',
                                    'completed' => 'check-double',
                                    'cancelled' => 'times-circle',
                                    default => 'circle'
                                };
                            @endphp

                            <span class="badge bg-{{ $statusBadge }} bg-opacity-10 text-{{ $statusBadge }} py-2 px-3">
                                <i class="fas fa-{{ $statusIcon }} me-1"></i>
                                {{ ucfirst($jobContract->status) }}
                            </span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-2"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-medium">{{ $jobContract->expert->name ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $jobContract->expert->email ?? '' }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt text-muted me-2"></i>
                            <div>
                                <div>{{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}</div>
                                <div class="text-muted small">
                                    to
                                    {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('client.job-contracts.show', $jobContract->id) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle w-100" type="button"
                                    data-bs-toggle="dropdown">
                                    More Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 w-100">
                                    <li>
                                        <a href="{{ route('client.job-contracts.edit', $jobContract->id) }}"
                                            class="dropdown-item py-2">
                                            <i class="fas fa-edit text-warning me-2"></i> Edit Contract
                                        </a>
                                    </li>
                                    @if($jobContract->status == 'pending')
                                        <li>
                                            <button type="button" class="dropdown-item py-2 text-success"
                                                onclick="approveContract('{{ $jobContract->id }}')">
                                                <i class="fas fa-check-circle me-2"></i> Approve Contract
                                            </button>
                                        </li>
                                    @endif
                                    @if($jobContract->status == 'active')
                                        <li>
                                            <button type="button" class="dropdown-item py-2 text-info"
                                                onclick="markAsComplete('{{ $jobContract->id }}')">
                                                <i class="fas fa-check-double me-2"></i> Mark as Complete
                                            </button>
                                        </li>
                                    @endif
                                    @if($jobContract->status != 'cancelled' && $jobContract->status != 'completed')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item py-2 text-danger"
                                                onclick="cancelContract('{{ $jobContract->id }}')">
                                                <i class="fas fa-times-circle me-2"></i> Cancel Contract
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                        <h5 class="font-weight-bold text-muted">No job contracts found</h5>
                        <p class="text-muted mb-3">Start by creating a new contract with an expert</p>
                        <a href="{{ route('client.job-contracts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Create Contract
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table (visible on medium screens and up) -->
        <div class="d-none d-md-block">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="contractsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Job Title</th>
                                    <th class="px-4 py-3">Expert</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Period</th>
                                    <th class="px-4 py-3 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobContracts as $jobContract)
                                                        <tr class="contract-row" data-status="{{ $jobContract->status }}">
                                                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                                            <td class="px-4 py-3">
                                                                <div class="fw-bold">
                                                                    <a href="{{ route('client.job-applications.show', $jobContract->job_application_id) }}"
                                                                        class="text-decoration-none text-primary">
                                                                        {{ $jobContract->jobApplication->jobListing->title }}
                                                                    </a>
                                                                </div>
                                                                <div class="text-muted small">
                                                                    {{ $jobContract->jobApplication->jobListing->category }}</div>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-2"
                                                                        style="width: 40px; height: 40px;">
                                                                        <i class="fas fa-user text-primary"></i>
                                                                    </div>
                                                                    <div>
                                                                        <div class="fw-medium">{{ $jobContract->expert->name ?? 'N/A' }}</div>
                                                                        <div class="text-muted small">{{ $jobContract->expert->email ?? '' }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                @php
                                                                    $statusBadge = match ($jobContract->status) {
                                                                        'active' => 'success',
                                                                        'pending' => 'warning',
                                                                        'completed' => 'info',
                                                                        'cancelled' => 'danger',
                                                                        default => 'secondary'
                                                                    };

                                                                    $statusIcon = match ($jobContract->status) {
                                                                        'active' => 'check-circle',
                                                                        'pending' => 'hourglass-half',
                                                                        'completed' => 'check-double',
                                                                        'cancelled' => 'times-circle',
                                                                        default => 'circle'
                                                                    };
                                                                @endphp

                                    <span
                                                                    class="badge bg-{{ $statusBadge }} bg-opacity-10 text-{{ $statusBadge }} py-2 px-3">
                                                                    <i class="fas fa-{{ $statusIcon }} me-1"></i>
                                                                    {{ ucfirst($jobContract->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="fas fa-calendar-alt text-muted me-2"></i>
                                                                    <div>
                                                                        <div>{{ \Carbon\Carbon::parse($jobContract->start_date)->format('M d, Y') }}
                                                                        </div>
                                                                        <div class="text-muted small">
                                                                            to
                                                                            {{ $jobContract->end_date ? \Carbon\Carbon::parse($jobContract->end_date)->format('M d, Y') : 'Ongoing' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end px-4 py-3">
                                                                <div class="d-inline-block">
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Actions
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                                            <li>
                                                                                <a href="{{ route('client.job-contracts.show', $jobContract->id) }}"
                                                                                    class="dropdown-item py-2">
                                                                                    <i class="fas fa-eye text-primary me-2"></i> View Details
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="{{ route('client.job-contracts.edit', $jobContract->id) }}"
                                                                                    class="dropdown-item py-2">
                                                                                    <i class="fas fa-edit text-warning me-2"></i> Edit Contract
                                                                                </a>
                                                                            </li>
                                                                            @if($jobContract->status == 'pending')
                                                                                <li>
                                                                                    <button type="button" class="dropdown-item py-2 text-success"
                                                                                        onclick="approveContract('{{ $jobContract->id }}')">
                                                                                        <i class="fas fa-check-circle me-2"></i> Approve Contract
                                                                                    </button>
                                                                                </li>
                                                                            @endif
                                                                            @if($jobContract->status == 'active')
                                                                                <li>
                                                                                    <button type="button" class="dropdown-item py-2 text-info"
                                                                                        onclick="markAsComplete('{{ $jobContract->id }}')">
                                                                                        <i class="fas fa-check-double me-2"></i> Mark as Complete
                                                                                    </button>
                                                                                </li>
                                                                            @endif
                                                                            @if($jobContract->status != 'cancelled' && $jobContract->status != 'completed')
                                                                                <li>
                                                                                    <hr class="dropdown-divider">
                                                                                </li>
                                                                                <li>
                                                                                    <button type="button" class="dropdown-item py-2 text-danger"
                                                                                        onclick="cancelContract('{{ $jobContract->id }}')">
                                                                                        <i class="fas fa-times-circle me-2"></i> Cancel Contract
                                                                                    </button>
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                                                <h5 class="font-weight-bold text-muted">No job contracts found</h5>
                                                <p class="text-muted mb-0">Start by creating a new contract with an expert</p>
                                                <a href="{{ route('client.job-contracts.create') }}"
                                                    class="btn btn-primary mt-3">
                                                    <i class="fas fa-plus me-1"></i> Create Contract
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for contract actions -->
    <form id="contract-action-form" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    @push('scripts')
        <script>
            // Search functionality
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('contractSearch');
                if (searchInput) {
                    searchInput.addEventListener('keyup', function () {
                        const searchValue = this.value.toLowerCase();
                        const rows = document.querySelectorAll('.contract-row');

                        rows.forEach(row => {
                            const text = row.textContent.toLowerCase();
                            if (text.includes(searchValue)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                }

                // Tab filtering
                const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
                tabButtons.forEach(tab => {
                    tab.addEventListener('click', function () {
                        const status = this.getAttribute('data-status');
                        const rows = document.querySelectorAll('.contract-row');

                        // Set active class
                        tabButtons.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');

                        rows.forEach(row => {
                            if (status === 'all' || row.getAttribute('data-status') === status) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                });
            });

            // Contract action functions
            function approveContract(id) {
                if (confirm('Are you sure you want to approve this contract?')) {
                    const form = document.getElementById('contract-action-form');
                    form.action = `/client/job-contracts/${id}/update-status`;

                    const statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'status';
                    statusInput.value = 'active';
                    form.appendChild(statusInput);

                    form.submit();
                }
            }

            function markAsComplete(id) {
                if (confirm('Are you sure you want to mark this contract as complete?')) {
                    const form = document.getElementById('contract-action-form');
                    form.action = `/client/job-contracts/${id}/update-status`;

                    const statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'status';
                    statusInput.value = 'completed';
                    form.appendChild(statusInput);

                    form.submit();
                }
            }

            function cancelContract(id) {
                if (confirm('Are you sure you want to cancel this contract? This action cannot be undone.')) {
                    const form = document.getElementById('contract-action-form');
                    form.action = `/client/job-contracts/${id}/update-status`;

                    const statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'status';
                    statusInput.value = 'cancelled';
                    form.appendChild(statusInput);

                    form.submit();
                }
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .table-responsive {
                overflow: visible !important;
            }
            .dropdown-menu {
                min-width: 200px;
                margin-top: 0;
            }
            td {
                position: relative;
            }
            .dropdown {
                position: relative;
            }
            .dropdown-menu.show {
                position: absolute;
                z-index: 1000;
                transform: none !important;
            }
            @media (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto !important;
                }
                .dropdown-menu {
                    position: fixed;
                    top: auto;
                    left: 50% !important;
                    right: auto !important;
                    bottom: 1rem;
                    transform: translateX(-50%) !important;
                    width: calc(100% - 2rem);
                    max-width: 300px;
                }
            }
        </style>
    @endpush

@endsection