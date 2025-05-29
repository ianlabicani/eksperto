@extends('expert.profile.shell')

@section('title')
    Expert - Work Experience
@endsection

@section('profile-content')

    <div class="card-header">
        <h3>Work Experience</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            @forelse ($workExperiences as $work)
                <li>
                    <strong>Job Title:</strong> {{ $work->job_title }}<br>
                    <strong>Company:</strong> {{ $work->company_name }}<br>
                    <strong>Duration:</strong> {{ $work->start_date }} - {{ $work->end_date ?? 'Present' }}<br>
                    <strong>Description:</strong> {{ $work->description ?? 'N/A' }}
                    <hr>
                </li>
            @empty
                <li class="text-center">
                    <div class="alert alert-info text-center" role="alert">
                        No work experience added yet.
                    </div>
                </li>
            @endforelse
        </ul>
        <!-- Button to Open Add Work Experience Modal -->
        <button class="btn btn-warning d-block ms-auto" data-bs-toggle="modal" data-bs-target="#addWorkExperienceModal">
            Add Work Experience
        </button>

        <div class="modal fade" id="addWorkExperienceModal" tabindex="-1" aria-labelledby="addWorkExperienceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWorkExperienceModalLabel">Add Work Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('expert.work-experience.store') }}">
                            @csrf

                            <!-- Position -->
                            <div class="mb-3">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" required>
                            </div>

                            <!-- Company -->
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" required>
                            </div>

                            <!-- Start Date -->
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>

                            <!-- End Date (Optional) -->
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date (Leave empty if currently working)</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Job Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection