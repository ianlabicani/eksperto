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

                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="category" class="form-label small fw-medium">Category</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-tag text-muted"></i></span>
                                <select class="form-select border-start-0 @error('category') is-invalid @enderror"
                                    id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ old('category', $jobListing->category) == $category ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="col-md-6">
                            <label for="job_type" class="form-label small fw-medium">Employment Type</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-user-tie text-muted"></i></span>
                                <select class="form-select border-start-0 @error('job_type') is-invalid @enderror"
                                    id="job_type" name="job_type" required>
                                    <option value="">Select Employment Type</option>
                                    <option value="full-time" {{ old('job_type', $jobListing->job_type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part-time" {{ old('job_type', $jobListing->job_type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="contract" {{ old('job_type', $jobListing->job_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="freelance" {{ old('job_type', $jobListing->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="internship" {{ old('job_type', $jobListing->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                                </select>
                                @error('job_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="col-md-6">
                            <label for="salary" class="form-label small fw-medium">Salary/Budget</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-peso-sign text-muted"></i></span>
                                <input type="number" min="0" step="0.01"
                                    class="form-control border-start-0 @error('salary') is-invalid @enderror" id="salary"
                                    name="salary" value="{{ old('salary', $jobListing->salary) }}"
                                    placeholder="Enter amount">
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rate Type -->
                        <div class="col-md-6">
                            <label for="rate" class="form-label small fw-medium">Payment Type</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-clock text-muted"></i></span>
                                <select class="form-select border-start-0 @error('rate') is-invalid @enderror" id="rate"
                                    name="rate" required>
                                    <option value="" disabled>Select payment type</option>
                                    <option value="hourly" {{ old('rate', $jobListing->rate) == 'hourly' ? 'selected' : '' }}>
                                        Hourly</option>
                                    <option value="daily" {{ old('rate', $jobListing->rate) == 'daily' ? 'selected' : '' }}>
                                        Daily</option>
                                    <option value="weekly" {{ old('rate', $jobListing->rate) == 'weekly' ? 'selected' : '' }}>
                                        Weekly</option>
                                    <option value="monthly" {{ old('rate', $jobListing->rate) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="project-based" {{ old('rate', $jobListing->rate) == 'project-based' ? 'selected' : '' }}>Project-Based</option>
                                    <option value="commission" {{ old('rate', $jobListing->rate) == 'commission' ? 'selected' : '' }}>Commission</option>
                                </select>
                                @error('rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
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

                        <!-- Vacancies -->
                        <div class="col-md-6">
                            <label for="vacancies" class="form-label small fw-medium">Number of Vacancies</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-users text-muted"></i></span>
                                <input type="number" min="1"
                                    class="form-control border-start-0 @error('vacancies') is-invalid @enderror"
                                    id="vacancies" name="vacancies" value="{{ old('vacancies', $jobListing->vacancies) }}"
                                    placeholder="Enter number of openings">
                                @error('vacancies')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div class="col-md-6">
                            <label for="deadline" class="form-label small fw-medium">Application Deadline</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-calendar-alt text-muted"></i></span>
                                <input type="date"
                                    class="form-control border-start-0 @error('deadline') is-invalid @enderror"
                                    id="deadline" name="deadline" value="{{ old('deadline', $jobListing->deadline) }}"
                                    required>
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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

                        <div class="col-12 mt-4">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('client.job-listings.index') }}" class="btn btn-light px-4 rounded-pill">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill" id="updateButton">
                                    <i class="fas fa-save me-2"></i>Update Job
                                </button>
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