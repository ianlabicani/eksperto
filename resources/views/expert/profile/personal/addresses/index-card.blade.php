<div class="card no-hover border-0 shadow-sm rounded-3 mt-4">
    <div class="card-header bg-white py-3 border-0" id="addressInfo">
        <div class="d-flex align-items-center">
            <h3 class="mb-0 fw-bold fs-5 text-primary">Address Information</h3>
            <button class="btn btn-sm btn-outline-primary ms-auto rounded-pill" data-bs-toggle="modal"
                data-bs-target="#updateAddressModal">
                <i class="fas fa-map-marker-alt me-1"></i> Update Address
            </button>
        </div>
    </div>
    <div class="card-body p-4">
        @if(!$address->house_number || !$address->street || !$address->barangay || !$address->municipality || !$address->province || !$address->region || !$address->zip_code)
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
                <!-- Region -->
                <div class="mb-4">
                    <label for="region" class="form-label small text-muted">Region</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->region ?: 'Not provided' }}
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
                <!-- Municipality -->
                <div class="mb-4">
                    <label for="municipality" class="form-label small text-muted">Municipality</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->municipality ?: 'Not provided' }}
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
                <!-- Zip Code -->
                <div class="mb-4">
                    <label for="zip_code" class="form-label small text-muted">Zip Code</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $address->zip_code ?: 'Not provided' }}
                    </div>
                </div>
            </div>
        </div>

        @include('expert.profile.personal.addresses.edit-modal')
    </div>
</div>