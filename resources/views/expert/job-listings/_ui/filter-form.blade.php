<form method="GET" action="{{ route('expert.job-listings.index') }}">
    <div class="row g-3">
        <!-- Search -->
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text border-0 bg-gray-100">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control border-0 bg-gray-100 ps-2"
                    placeholder="Search jobs by title or category" value="{{ request('search') }}">
            </div>
        </div>

        <!-- Status Filter -->
        <div class="col-md-2">
            <select name="status" class="form-select border-0 bg-gray-100">
                <option value="">Job Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <!-- Date Range Filter -->
        <div class="col-md-4">
            <div class="d-flex align-items-center gap-2">
                <div class="input-group">
                    <span class="input-group-text border-0 bg-gray-100">
                        <i class="fas fa-calendar text-muted"></i>
                    </span>
                    <input type="date" name="start_date" class="form-control border-0 bg-gray-100"
                        value="{{ request('start_date') }}" placeholder="Start Date">
                </div>
                <span class="text-muted">to</span>
                <div class="input-group">
                    <input type="date" name="end_date" class="form-control border-0 bg-gray-100"
                        value="{{ request('end_date') }}" placeholder="End Date">
                </div>
            </div>
        </div>

        <!-- Expertise Filter -->
        <div class="col-md-2">
            <div class="form-check form-switch">
                <input type="checkbox" name="preferred_only" id="preferred_only" class="form-check-input" value="1" {{ request('preferred_only') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="preferred_only">
                    Match Expertise
                </label>
            </div>
        </div>
    </div>
</form>

@push('styles')
    <style>
        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .input-group-text {
            color: #6b7280;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize Bootstrap tooltip
        var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return window.bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush
