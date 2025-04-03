@php
    $user = Auth::user();
    $expertises = $user->expertises;
@endphp

<div class="card">
    <div class="card-header">
        <h3>Expertise</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            @forelse ($expertises as $expertise)
                <li>
                    <strong>Field:</strong> {{ $expertise->name }}<br>
                    <strong>Description:</strong> {{ $expertise->description ?? 'N/A' }}<br>
                    <strong>Proficiency Level:</strong> {{ ucfirst($expertise->level) }}<br>
                    <strong>Years of Experience:</strong> {{ $expertise->years_of_experience }} years
                    <hr>
                </li>
            @empty
                <li class="text-center">
                    <div class="alert alert-info text-center" role="alert">
                        No expertise added yet.
                    </div>
                </li>
            @endforelse
        </ul>
        <!-- Button to Open Add Expertise Modal -->
        <button class="btn btn-warning d-block ms-auto" data-bs-toggle="modal" data-bs-target="#addExpertiseModal">
            Add Expertise
        </button>

        <!-- Modal: Add Expertise -->
        @include('expert.expertise._ui.modal-create-expertise')

    </div>
</div>