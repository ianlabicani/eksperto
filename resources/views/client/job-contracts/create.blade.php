@extends('client.shell')

@section('content')
    <div class="container my-4">
        <a href="{{ route('client.job-contracts.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Contracts</a>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-briefcase"></i> Job Application Details
            </div>
            <div class="card-body">
                <p><strong>Job Title:</strong> {{ $jobApplication->jobListing->title }}</p>
                <p><strong>Applicant:</strong> {{ $jobApplication->expert->name }}</p>
                <p><strong>Applied On:</strong> {{ $jobApplication->created_at->format('F d, Y') }}</p>
                <p><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($jobApplication->status) }}</span></p>
                <div class="border p-3 bg-light rounded w-75 me-auto">
                    {!! nl2br(e($jobApplication->cover_letter)) !!}
                </div>
            </div>
        </div>

        <h2 class="mb-4">Create Job Contract</h2>

        <form action="{{ route('client.job-contracts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="job_application_id" value="{{ $jobApplication->id }}">
            <input type="hidden" name="expert_id" value="{{ $jobApplication->expert->id }}">
            <input type="hidden" name="job_listing_id" value="{{ $jobApplication->jobListing->id }}">
            <!-- Start Date -->
            <div class="mb-3">
                <label for="start_date" class="form-label"><i class="fas fa-calendar-alt"></i> Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                    name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-3">
                <label for="end_date" class="form-label"><i class="fas fa-calendar-times"></i> End Date</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                    name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contract Terms -->
            <div class="mb-3">
                <label for="contract_terms" class="form-label"><i class="fas fa-file-alt"></i> Contract Terms</label>
                <textarea class="form-control @error('contract_terms') is-invalid @enderror" id="contract_terms"
                    name="contract_terms" rows="4">{{ old('contract_terms') }}</textarea>
                @error('contract_terms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary d-block ms-auto">
                <i class="fas fa-save"></i> Send Contract
            </button>
        </form>
    </div>
@endsection
