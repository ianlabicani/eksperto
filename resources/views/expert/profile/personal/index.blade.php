@extends('expert.profile.shell')

@section('profile-content')
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Profile;
        use App\Models\Address;

        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $address = $user->address ?? new Address();
    @endphp

    <div class="card no-hover border-0 shadow-md rounded-3 mt-4">
        <div class="card-header bg-white py-3 border-0" id="personalInfo">
            <div class="d-flex align-items-center">
                <h3 class="mb-0 fw-bold fs-5 text-primary">Personal Information</h3>
                <button class="btn btn-sm btn-outline-primary ms-auto rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#updateProfileModal">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </button>
            </div>
        </div>
        <div class="card-body p-4">
            @if(!$profile->first_name || !$profile->last_name || !$profile->date_of_birth || !$profile->sex)
                <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center">
                    <i class="fas fa-user-edit fs-4 me-3 text-warning"></i>
                    <div>
                        <strong>Your personal information is incomplete.</strong>
                        <p class="mb-0">Please complete your personal details to ensure your profile is complete. This
                            information is required to access all features.</p>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-md-6">
                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="firstname" class="form-label small text-muted">First Name</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            {{ $profile->first_name ?: 'Not provided' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="lastname" class="form-label small text-muted">Last Name</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            {{ $profile->last_name ?: 'Not provided' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label for="middlename" class="form-label small text-muted">Middle Name</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            {{ $profile->middle_name ?: 'Not provided' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Suffix -->
                    <div class="mb-4">
                        <label for="suffix" class="form-label small text-muted">Suffix</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            {{ $profile->suffix ?: 'None' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="dob" class="form-label small text-muted">Date of Birth</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            {{ $profile->date_of_birth ?? 'Not provided' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Sex -->
                    <div class="mb-4">
                        <label for="sex" class="form-label small text-muted">Sex</label>
                        <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                            @if($profile->sex == 'male')
                                <i class="fas fa-mars text-primary me-1"></i> Male
                            @elseif($profile->sex == 'female')
                                <i class="fas fa-venus text-danger me-1"></i> Female
                            @elseif($profile->sex == 'other')
                                <i class="fas fa-transgender text-info me-1"></i> Other
                            @else
                                Not provided
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            @include('expert.profile.personal.edit-modal')
        </div>
    </div>

    @include('expert.profile.personal.addresses.index-card')
    @include('expert.profile.personal.contacts.index-card')
@endsection