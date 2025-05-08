<div class="card no-hover border-0 shadow-sm rounded-3 mt-4">
    <div class="card-header bg-white py-3 border-0" id="contactInfo">
        <div class="d-flex align-items-center">
            <h3 class="mb-0 fw-bold fs-5 text-primary">Contact Information</h3>
            <button class="btn btn-sm btn-outline-primary ms-auto rounded-pill" data-bs-toggle="modal"
                data-bs-target="#updateContactModal">
                <i class="fas fa-phone-alt me-1"></i> Update Contact
            </button>
        </div>
    </div>
    <div class="card-body p-4">
        @php
            $hasValidContact = $user->email || $user->contacts->count() > 0;
        @endphp

        @if(!$hasValidContact)
            <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center">
                <i class="fas fa-phone-alt fs-4 me-3 text-warning"></i>
                <div>
                    <strong>Your contact information is incomplete.</strong>
                    <p class="mb-0">Please provide at least one contact method (email or phone number). This information is
                        required
                        for clients to reach you and to access all platform features.</p>
                </div>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <!-- Email -->
                <div class="mb-4">
                    <label class="form-label small text-muted">Email Address</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        {{ $user->email ?: 'Not provided' }}
                        @if($user->email_verified_at)
                            <span class="badge bg-success ms-2"><i class="fas fa-check-circle me-1"></i> Verified</span>
                        @else
                            <span class="badge bg-warning ms-2"><i class="fas fa-exclamation-circle me-1"></i>
                                Unverified</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Preferred Contact Method -->
                <div class="mb-4">
                    <label class="form-label small text-muted">Preferred Contact Method</label>
                    <div class="form-control-plaintext border-bottom pb-2 fw-medium">
                        @php
                            $preferredMethod = $user->contact_preference ?? 'email';
                            $icon = $preferredMethod == 'email' ? 'fa-envelope' : 'fa-phone-alt';
                            $text = ucfirst($preferredMethod);
                        @endphp
                        <i class="fas {{ $icon }} text-primary me-2"></i> {{ $text }}
                    </div>
                </div>
            </div>
        </div>

        @include('expert.profile.personal.contacts.edit-modal')
    </div>
</div>