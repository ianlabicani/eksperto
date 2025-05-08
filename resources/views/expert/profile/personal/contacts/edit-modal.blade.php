@if($user->contacts->count() > 0)
    <div class="row g-4 mb-4">
        @foreach($user->contacts as $contact)
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    @php
                        $icon = '';
                        if ($contact->type == 'email') {
                            $icon = 'fas fa-envelope text-primary';
                        } elseif ($contact->type == 'phone_number') {
                            $icon = 'fas fa-mobile-alt text-success';
                        } elseif ($contact->type == 'tel_number') {
                            $icon = 'fas fa-phone text-info';
                        } elseif ($contact->type == 'link') {
                            $icon = 'fas fa-link text-warning';
                        } else {
                            $icon = 'fas fa-address-card text-secondary';
                        }

                        $label = '';
                        if ($contact->type == 'email') {
                            $label = 'Email';
                        } elseif ($contact->type == 'phone_number') {
                            $label = 'Mobile Number';
                        } elseif ($contact->type == 'tel_number') {
                            $label = 'Telephone';
                        } elseif ($contact->type == 'link') {
                            $label = 'Website';
                        } else {
                            $label = 'Contact';
                        }
                    @endphp
                    <div class="me-3">
                        <i class="{{ $icon }} fa-fw fa-lg"></i>
                    </div>
                    <div>
                        <div class="small text-muted">{{ $label }}</div>
                        <div class="fw-medium">{{ $contact->value }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center">
        <i class="fas fa-address-book fs-4 me-3 text-warning"></i>
        <div>
            <strong>No contact information added.</strong>
            <p class="mb-0">Please add at least one contact method so others can reach you.</p>
        </div>
    </div>
@endif

<!-- Contact Modal -->
<div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="updateContactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('expert.contact.update') }}">
                @csrf
                @method('PATCH')
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="updateContactModalLabel">
                        <i class="fas fa-address-book me-2"></i>Manage Contact Information
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="contacts-container">
                        @forelse ($user->contacts as $index => $contact)
                            <div class="contact-group mb-3">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <label class="form-label small">Contact Type</label>
                                        <select name="contacts[{{ $index }}][type]" class="form-select" required>
                                            <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>Email
                                            </option>
                                            <option value="phone_number" {{ $contact->type == 'phone_number' ? 'selected' : '' }}>Phone Number</option>
                                            <option value="tel_number" {{ $contact->type == 'tel_number' ? 'selected' : '' }}>
                                                Telephone Number</option>
                                            <option value="link" {{ $contact->type == 'link' ? 'selected' : '' }}>Website Link
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small">Contact Details</label>
                                        <input type="text" name="contacts[{{ $index }}][value]" class="form-control"
                                            value="{{ $contact->value }}" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm rounded-circle remove-contact">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="contact-group mb-3">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <label class="form-label small">Contact Type</label>
                                        <select name="contacts[0][type]" class="form-select" required>
                                            <option value="email">Email</option>
                                            <option value="phone_number">Phone Number</option>
                                            <option value="tel_number">Telephone Number</option>
                                            <option value="link">Website Link</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small">Contact Details</label>
                                        <input type="text" name="contacts[0][value]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm rounded-circle remove-contact">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-success mt-2" id="add-contact">
                        <i class="fas fa-plus me-1"></i> Add Contact
                    </button>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Calculate the index based on the current count
            let contactCount = "{{ $user->contacts ? $user->contacts->count() : 1 }}";
            let contactIndex = parseInt(contactCount);

            // Add contact button functionality
            var addContactBtn = document.getElementById("add-contact");
            var contactsContainer = document.getElementById("contacts-container");

            if (addContactBtn && contactsContainer) {
                addContactBtn.addEventListener("click", function () {
                    var newContact = document.createElement("div");
                    newContact.classList.add("contact-group", "mb-3");
                    newContact.innerHTML =
                        '<div class="row g-2">' +
                        '    <div class="col-md-5">' +
                        '        <label class="form-label small">Contact Type</label>' +
                        '        <select name="contacts[' + contactIndex + '][type]" class="form-select" required>' +
                        '            <option value="email">Email</option>' +
                        '            <option value="phone_number">Phone Number</option>' +
                        '            <option value="tel_number">Telephone Number</option>' +
                        '            <option value="link">Website Link</option>' +
                        '        </select>' +
                        '    </div>' +
                        '    <div class="col-md-5">' +
                        '        <label class="form-label small">Contact Details</label>' +
                        '        <input type="text" name="contacts[' + contactIndex + '][value]" class="form-control" required>' +
                        '    </div>' +
                        '    <div class="col-md-2 d-flex align-items-end">' +
                        '        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle remove-contact">' +
                        '            <i class="fas fa-times"></i>' +
                        '        </button>' +
                        '    </div>' +
                        '</div>';

                    contactsContainer.appendChild(newContact);
                    contactIndex++;
                });

                // Use event delegation for dynamic elements
                contactsContainer.addEventListener("click", function (event) {
                    var removeButton = event.target.closest(".remove-contact");
                    if (removeButton) {
                        var contactGroup = removeButton.closest(".contact-group");
                        if (contactGroup) {
                            contactGroup.remove();
                        }
                    }
                });
            }
        });
    </script>
@endpush