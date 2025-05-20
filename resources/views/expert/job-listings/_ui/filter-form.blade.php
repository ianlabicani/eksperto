<form method="GET" action="{{ route('expert.job-listings.index') }}" class="filter-form">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <!-- Search -->
                <div class="col-lg-4 col-md-6">
                    <label for="search" class="form-label small text-muted">Search Jobs</label>
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-gray-100">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" id="search" name="search" class="form-control border-0 bg-gray-100 ps-2"
                            placeholder="Job title or category" value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <label for="status" class="form-label small text-muted">Job Status</label>
                    <select id="status" name="status" class="form-select border-0 bg-gray-100">
                        <option value="">All Statuses</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Date Range Filter -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label small text-muted">Date Range</label>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-gray-100">
                                <i class="fas fa-calendar-alt text-muted"></i>
                            </span>
                            <input type="date" name="start_date" class="form-control border-0 bg-gray-100"
                                value="{{ request('start_date') }}" aria-label="Start Date">
                        </div>
                        <span class="text-muted">→</span>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-gray-100">
                                <i class="fas fa-calendar-alt text-muted"></i>
                            </span>
                            <input type="date" name="end_date" class="form-control border-0 bg-gray-100"
                                value="{{ request('end_date') }}" aria-label="End Date">
                        </div>
                    </div>
                </div>

                <!-- Expertise Filter -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <label class="form-label small text-muted d-block">Expertise Match</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="preferred_only" id="preferred_only" class="form-check-input"
                            value="1" {{ request('preferred_only') == '1' ? 'checked' : '' }} data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Show only jobs matching your expertise">
                        <label class="form-check-label" for="preferred_only">
                            Match My Expertise
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <span class="text-muted small fst-italic">
                    <i class="fas fa-info-circle me-1"></i>
                    Filter to find jobs matching your criteria
                </span>
                <div class="d-flex gap-2">
                    <a href="{{ route('expert.job-listings.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('styles')
    <style>
        .filter-form .card {
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }

        .filter-form .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
        }

        .bg-gray-100 {
            background-color: #f3f4f6;
            border-radius: 0.5rem !important;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .input-group-text {
            color: #6b7280;
            border-radius: 0.5rem 0 0 0.5rem !important;
        }

        .form-control,
        .form-select {
            border-radius: 0 0.5rem 0.5rem 0 !important;
            height: 42px;
        }

        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .btn-outline-secondary {
            color: #6b7280;
            border-color: #d1d5db;
        }

        .btn-outline-secondary:hover {
            background-color: #f3f4f6;
            color: #374151;
        }

        @media (max-width: 767.98px) {
            .d-flex.align-items-center.gap-2 {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .d-flex.align-items-center.gap-2 .input-group {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-flex.align-items-center.gap-2 span.text-muted {
                display: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    boundary: document.body
                });
            });

            // Auto-hide tooltips after 3 seconds
            tooltipTriggerList.forEach(function (tooltip) {
                tooltip.addEventListener('shown.bs.tooltip', function () {
                    setTimeout(function () {
                        bootstrap.Tooltip.getInstance(tooltip).hide();
                    }, 3000);
                });
            });
        });
    </script>
@endpush