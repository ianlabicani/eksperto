@extends('client.shell')

@section('client-content')
    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('client.job-listings.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill me-3">
                <i class="fas fa-arrow-left me-1"></i> Back to Jobs
            </a>
            <h4 class="fw-bold m-0">Edit Job Listing</h4>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                <h5 class="mb-0 fw-bold text-light">
                    <i class="fas fa-edit me-2"></i>Update Job Details
                </h5>
                <p class="small mb-0 mt-1 text-light">You can only edit the job title, description, requirements,
                    and location.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('client.job-listings.update', $jobListing->id) }}" method="POST" id="jobEditForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Job Title -->
                        <div class="col-12">
                            <label for="title" class="form-label small fw-medium">Job Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-briefcase text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $jobListing->title) }}"
                                    placeholder="Enter job title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="col-12">
                            <label for="description" class="form-label small fw-medium">Job Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="4" placeholder="Describe the job responsibilities and expectations"
                                required>{{ old('description', $jobListing->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Requirements -->
                        <div class="col-12">
                            <label for="requirements" class="form-label small fw-medium">Requirements</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements"
                                name="requirements" rows="3"
                                placeholder="List the skills, qualifications, and experience required">{{ old('requirements', $jobListing->requirements) }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="col-12">
                            <label for="location" class="form-label small fw-medium">Job Location</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-map-marker-alt text-muted"></i></span>
                                <input type="text"
                                    class="form-control border-start-0 @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location', $jobListing->location) }}"
                                    placeholder="Enter work location or 'Remote'">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Hidden fields to preserve original values -->
                        <input type="hidden" name="category" value="{{ $jobListing->category }}">
                        <input type="hidden" name="job_type" value="{{ $jobListing->job_type }}">
                        <input type="hidden" name="salary" value="{{ $jobListing->salary }}">
                        <input type="hidden" name="rate" value="{{ $jobListing->rate }}">
                        <input type="hidden" name="vacancies" value="{{ $jobListing->vacancies }}">
                        <input type="hidden" name="deadline" value="{{ $jobListing->deadline }}">

                        <div class="col-12 mt-4">
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted small mb-0"><i class="fas fa-info-circle me-1"></i> Only the fields
                                    above can be edited. Other job details will remain unchanged.</p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('client.job-listings.show', $jobListing->id) }}"
                                        class="btn btn-light px-4 rounded-pill">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill" id="updateButton">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('jobEditForm');
                const submitButton = document.getElementById('updateButton');

                form.addEventListener('submit', function () {
                    // Disable the button
                    submitButton.disabled = true;

                    // Change button text to show loading state
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
                });
            });
        </script>
    @endpush
@endsection