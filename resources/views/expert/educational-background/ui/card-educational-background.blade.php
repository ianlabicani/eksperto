@php
    $user = Auth::user();
    $educations = $user->educationalBackgrounds()->orderBy('year', 'desc')->get();
@endphp

<div class="card">
    <div class="card-header">
        <h3>Educational Background</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            @forelse ($educations as $education)
                <li>
                    <strong>Level:</strong> {{ $education->level }}<br>
                    <strong>University:</strong> {{ $education->university }}<br>
                    <strong>Course:</strong> {{ $education->course }}<br>
                    <strong>Year:</strong> {{ $education->year }}<br>
                    <strong>Award:</strong> {{ $education->award ?? 'N/A' }}
                    <hr>
                </li>
            @empty
                <li class="text-center">
                    <div class="alert alert-info text-center" role="alert">
                        No educational background added yet.
                    </div>
                </li>
            @endforelse
        </ul>
        <!-- Button to Open Add Education Modal -->
        <button class="btn btn-warning d-block ms-auto" data-bs-toggle="modal" data-bs-target="#addEducationModal">
            Add Education
        </button>

        <!-- Modal: Add Educational Background -->
        @include('expert.educational-background.ui.modal-create-educational-background')

    </div>
</div>