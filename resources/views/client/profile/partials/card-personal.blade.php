<div class="card mt-4 border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-0">
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
        @include('client.profile.partials.edit-personal-modal', ['user' => $user, 'profile' => $profile])
    </div>

    <!-- Address Information -->
    <div class="card-header bg-white py-3 border-top border-0">
        <div class="d-flex align-items-center">
            <h3 class="mb-0 fw-bold fs-5 text-primary">Address Information</h3>
            <button class="btn btn-sm btn-outline-primary ms-auto rounded-pill" data-bs-toggle="modal"
                data-bs-target="#updateAddressModal">
                <i class="fas fa-map-marker-alt me-1"></i> Update Address
            </button>
        </div>
    </div>
    <div class="card-body p-4">
        @if(!$address->house_number || !$address->street || !$address->barangay || !$address->municipality || !$address->province || !$address->zip_code)
            <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center">
                <i class="fas fa-home fs-4 me-3 text-warning"></i>
                <div>
                    <strong>Your address information is incomplete.</strong>
                    <p class="mb-0">Please provide your complete address details. A complete address is required to access
                        all features of the platform.</p>
                </div>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <!-- House Number -->
                <div class="mb-4">
                    <label for="house_number" class="form-label small text-muted">House Number</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->house_number ?: 'Not provided' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Street -->
                <div class="mb-4">
                    <label for="street" class="form-label small text-muted">Street</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->street ?: 'Not provided' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Barangay -->
                <div class="mb-4">
                    <label for="barangay" class="form-label small text-muted">Barangay</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->barangay ?: 'Not provided' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Municipality -->
                <div class="mb-4">
                    <label for="municipality" class="form-label small text-muted">Municipality</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->municipality ?: 'Not provided' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Province -->
                <div class="mb-4">
                    <label for="province" class="form-label small text-muted">Province</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->province ?: 'Not provided' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Zip Code -->
                <div class="mb-4">
                    <label for="zip_code" class="form-label small text-muted">Zip Code</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->zip_code ?: 'Not provided' }}
                    </div>
                </div>
            </div>
        </div>

        @include('client.profile.partials.edit-address-modal', ['user' => $user, 'address' => $address])
    </div>
</div>