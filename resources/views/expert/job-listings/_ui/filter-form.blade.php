<form method="GET" action="{{ route('expert.job-listings.index') }}" class="mb-3">
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
        <div class="col-md-5 d-flex align-items-center justify-content-between">
            <!-- Start Date -->
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">

            <!-- Arrow Icon -->
            <span class="mx-2">
                <i class="fas fa-arrow-right"></i>
            </span>

            <!-- End Date -->
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>


        <!-- Filter & Reset Buttons -->
        <div class="col-md-2 d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-1"><i class="fas fa-filter"></i>
                Filter</button>
            <a href="{{ route('expert.job-listings.index') }}" class="btn btn-secondary d-flex text-nowrap">Clear
                Filters</a>
        </div>
    </div>
</form>