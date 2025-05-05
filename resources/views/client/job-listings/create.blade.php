@extends('client.shell')

@section('client-content')
    <div class="container my-4">
        <a href="{{ route('client.job-listings.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Jobs</a>
        <h2 class="mb-4"><i class="fas fa-briefcase"></i> Post a Job</h2>

        <form action="{{ route('client.job-listings.store') }}" method="POST">
            @csrf
            <!-- Job Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Job Description -->
            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-align-left"></i> Job Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="form-label"><i class="fas fa-list"></i> Category</label>
                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Salary -->
            <div class="mb-3">
                <label for="salary" class="form-label"><i class="fas fa-money-bill-wave"></i> Salary</label>
                <input type="number" min="0" step="0.01" class="form-control @error('salary') is-invalid @enderror"
                    id="salary" name="salary" value="{{ old('salary') }}">
                @error('salary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rate -->
            <div class="mb-3">
                <label for="rate" class="form-label"><i class="fas fa-clock"></i> Rate</label>
                <select class="form-select @error('rate') is-invalid @enderror" id="rate" name="rate" required>
                    <option value="" disabled selected>Select a rate type</option>
                    <option value="hourly" {{ old('rate') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                    <option value="daily" {{ old('rate') == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ old('rate') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ old('rate') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="project-based" {{ old('rate') == 'project-based' ? 'selected' : '' }}>Project-Based
                    </option>
                    <option value="commission" {{ old('rate') == 'commission' ? 'selected' : '' }}>Commission</option>
                </select>
                @error('rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Vacancies -->
            <div class="mb-3">
                <label for="vacancies" class="form-label"><i class="fas fa-users"></i> Vacancies</label>
                <input type="number" class="form-control @error('vacancies') is-invalid @enderror" id="vacancies"
                    name="vacancies" value="{{ old('vacancies') }}">
                @error('vacancies')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                    name="location" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Employment Type -->
            <div class="mb-3">
                <label for="job_type" class="form-label"><i class="fas fa-briefcase"></i> Employment Type</label>
                <select class="form-control @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                    <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('job_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Requirements -->
            <div class="mb-3">
                <label for="requirements" class="form-label"><i class="fas fa-file-alt"></i> Requirements</label>
                <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements"
                    name="requirements" rows="3">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deadline -->
            <div class="mb-3">
                <label for="deadline" class="form-label"><i class="fas fa-calendar-alt"></i> Application Deadline</label>
                <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                    name="deadline" value="{{ old('deadline') }}" required>
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary d-block ms-auto">
                <i class="fas fa-paper-plane"></i> Post Job
            </button>
        </form>
    </div>
@endsection