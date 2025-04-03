@php
    $user = Auth::user();
    $workExperiences = $user->workExperiences;
@endphp

<div class="card">
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

        <!-- Modal: Add Work Experience -->
        @include('expert.work-experiences._ui.modal-create-work-experience')

    </div>
</div>