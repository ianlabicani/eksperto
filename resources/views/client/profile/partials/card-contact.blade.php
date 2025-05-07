<div class="card mt-4 border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 border-0">
        <div class="d-flex align-items-center">
            <h3 class="mb-0 fw-bold fs-5 text-primary">Contact Information</h3>
            <button class="btn btn-sm btn-outline-primary ms-auto rounded-pill" data-bs-toggle="modal"
                data-bs-target="#updateContactModal">
                <i class="fas fa-phone-alt me-1"></i> Manage Contacts
            </button>
        </div>
    </div>
    <div class="card-body p-4">
        @if($user->contacts->isEmpty())
            <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center">
                <i class="fas fa-address-card fs-4 me-3 text-warning"></i>
                <div>
                    <strong>Contact information is missing.</strong>
                    <p class="mb-0">Please add at least one contact method (phone, email, etc.). This information is
                        required to complete your profile and allow clients to reach you.</p>
                </div>
            </div>
        @elseif(!$user->contacts->where('type', 'phone_number')->count() && !$user->contacts->where('type', 'tel_number')->count())
            <div class="alert alert-info border-0 rounded-3 mb-4 d-flex align-items-center">
                <i class="fas fa-info-circle fs-4 me-3 text-info"></i>
                <div>
                    <strong>Phone number recommended.</strong>
                    <p class="mb-0">Consider adding a phone number to your contacts. This makes it easier for clients to
                        reach you promptly.</p>
                </div>
            </div>
        @endif

        @if(!$user->contacts->isEmpty())
            <div class="row">
                @foreach($user->contacts as $contact)
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center">
                            @if($contact->type == 'email')
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Email</div>
                                    <div class="fw-medium">{{ $contact->value }}</div>
                                </div>
                            @elseif($contact->type == 'phone_number')
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-mobile-alt text-success"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Phone</div>
                                    <div class="fw-medium">{{ $contact->value }}</div>
                                </div>
                            @elseif($contact->type == 'tel_number')
                                <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-phone text-info"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Telephone</div>
                                    <div class="fw-medium">{{ $contact->value }}</div>
                                </div>
                            @elseif($contact->type == 'link')
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-link text-warning"></i>
                                </div>
                                <div>
                                    <div class="small text-muted">Website/Social Link</div>
                                    <div class="fw-medium">
                                        <a href="{{ $contact->value }}" target="_blank"
                                            class="text-decoration-none">{{ $contact->value }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @include('client.profile.partials.edit-contact-modal', ['user' => $user])
    </div>
</div>