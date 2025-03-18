@extends('client.shell')

@section('content')
    <div class="container my-4">
        <a href="{{ route('client.job-listings.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Jobs</a>
        <h2 class="mb-4">Post a Job</h2>

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
                <label for="description" class="form-label">Job Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
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
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                    value="{{ old('salary') }}">
                @error('salary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                    name="location" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Employment Type -->
            <div class="mb-3">
                <label for="job_type" class="form-label">Employment Type</label>
                <select class="form-control @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                    <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship
                    </option>
                </select>
                @error('job_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Requirements -->
            <div class="mb-3">
                <label for="requirements" class="form-label">Requirements</label>
                <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements"
                    name="requirements" rows="3">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deadline -->
            <div class="mb-3">
                <label for="deadline" class="form-label">Application Deadline</label>
                <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline"
                    name="deadline" value="{{ old('deadline') }}" required>
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary d-block ms-auto">Post Job</button>
        </form>
    </div>
@endsection