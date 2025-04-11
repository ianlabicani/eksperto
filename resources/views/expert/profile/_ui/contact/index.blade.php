<form method="POST" action="{{ route('expert.contact.update') }}">
    @csrf
    @method('PATCH')
    <div id="contacts-container">
        @forelse ($user->contacts as $index => $contact)
            <div class="contact-group">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">Type</label>
                        <select name="contacts[{{ $index }}][type]" class="form-control" required>
                            <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="phone_number" {{ $contact->type == 'phone_number' ? 'selected' : '' }}>Phone Number
                            </option>
                            <option value="tel_number" {{ $contact->type == 'tel_number' ? 'selected' : '' }}>Telephone Number
                            </option>
                            <option value="link" {{ $contact->type == 'link' ? 'selected' : '' }}>Link</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Value</label>
                        <input type="text" name="contacts[{{ $index }}][value]" class="form-control"
                            value="{{ $contact->value }}" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-contact">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="contact-group">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">Type</label>
                        <select name="contacts[0][type]" class="form-control" required>
                            <option value="email">Email</option>
                            <option value="phone_number">Phone Number</option>
                            <option value="tel_number">Telephone Number</option>
                            <option value="link">Link</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Value</label>
                        <input type="text" name="contacts[0][value]" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-contact">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <button type="button" class="btn btn-success mt-2" id="add-contact">
        <i class="fas fa-plus"></i> Add Contact
    </button>

    <br><br>
    <button type="submit" class="btn btn-warning btn-sm d-block ms-auto">UPDATE CONTACT</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let contactIndex = {{ $user->contacts->count() ?? 1 }}; // Start from existing count

        document.getElementById("add-contact").addEventListener("click", function () {
            const container = document.getElementById("contacts-container");
            const newContact = document.createElement("div");
            newContact.classList.add("contact-group");
            newContact.innerHTML = `
            <div class="row mt-2">
                <div class="col-md-5">
                    <label class="form-label">Type</label>
                    <select name="contacts[${contactIndex}][type]" class="form-control" required>
                        <option value="email">Email</option>
                        <option value="phone_number">Phone Number</option>
                        <option value="tel_number">Telephone Number</option>
                        <option value="link">Link</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Value</label>
                    <input type="text" name="contacts[${contactIndex}][value]" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-contact">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
            container.appendChild(newContact);
            contactIndex++;
        });

        document.getElementById("contacts-container").addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-contact")) {
                event.target.closest(".contact-group").remove();
            }
        });
    });
</script>