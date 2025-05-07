<div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="updateContactModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white border-0">
        <h5 class="modal-title" id="updateContactModalLabel"><i class="fas fa-address-card me-2"></i>Manage Contact
          Information</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form method="POST" action="{{ route('client.contact.update') }}">
          @csrf
          @method('PATCH')

          <div id="contacts-container">
            @forelse($user->contacts as $index => $contact)
        <div class="contact-group mb-3">
          <div class="row g-2">
          <div class="col-md-5">
            <div class="form-floating">
            <select name="contacts[{{ $index }}][type]" class="form-select" id="contact-type-{{ $index }}"
              required>
              <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>Email</option>
              <option value="phone_number" {{ $contact->type == 'phone_number' ? 'selected' : '' }}>Phone Number
              </option>
              <option value="tel_number" {{ $contact->type == 'tel_number' ? 'selected' : '' }}>Telephone Number
              </option>
              <option value="link" {{ $contact->type == 'link' ? 'selected' : '' }}>Link</option>
            </select>
            <label for="contact-type-{{ $index }}">Type</label>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-floating">
            <input type="text" name="contacts[{{ $index }}][value]" class="form-control"
              id="contact-value-{{ $index }}" value="{{ $contact->value }}" required
              placeholder="Contact value">
            <label for="contact-value-{{ $index }}">Value</label>
            </div>
          </div>
          <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-outline-danger rounded-circle remove-contact">
            <i class="fas fa-times"></i>
            </button>
          </div>
          </div>
        </div>
      @empty
        <div class="contact-group mb-3">
          <div class="row g-2">
          <div class="col-md-5">
            <div class="form-floating">
            <select name="contacts[0][type]" class="form-select" id="contact-type-0" required>
              <option value="email">Email</option>
              <option value="phone_number">Phone Number</option>
              <option value="tel_number">Telephone Number</option>
              <option value="link">Link</option>
            </select>
            <label for="contact-type-0">Type</label>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-floating">
            <input type="text" name="contacts[0][value]" class="form-control" id="contact-value-0" required
              placeholder="Contact value">
            <label for="contact-value-0">Value</label>
            </div>
          </div>
          <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-outline-danger rounded-circle remove-contact">
            <i class="fas fa-times"></i>
            </button>
          </div>
          </div>
        </div>
      @endforelse
          </div>

          <button type="button" class="btn btn-outline-success d-flex align-items-center gap-2 mt-3" id="add-contact">
            <i class="fas fa-plus"></i> <span>Add Contact</span>
          </button>

          <!-- Submit Button -->
          <div class="text-end mt-4">
            <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary px-4">
              <i class="fas fa-save me-2"></i>Save Contacts
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let contactIndex = "{{ $user->contacts->count() > 0 ? $user->contacts->count() : 1 }}";
    contactIndex = parseInt(contactIndex);

    document.getElementById("add-contact").addEventListener("click", function () {
      const container = document.getElementById("contacts-container");
      const newContact = document.createElement("div");
      newContact.classList.add("contact-group", "mb-3");
      newContact.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-5">
                        <div class="form-floating">
                            <select name="contacts[${contactIndex}][type]" class="form-select" id="contact-type-${contactIndex}" required>
                                <option value="email">Email</option>
                                <option value="phone_number">Phone Number</option>
                                <option value="tel_number">Telephone Number</option>
                                <option value="link">Link</option>
                            </select>
                            <label for="contact-type-${contactIndex}">Type</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" name="contacts[${contactIndex}][value]" class="form-control"
                                id="contact-value-${contactIndex}" required placeholder="Contact value">
                            <label for="contact-value-${contactIndex}">Value</label>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-outline-danger rounded-circle remove-contact">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
      container.appendChild(newContact);
      contactIndex++;
    });

    // Event delegation for removing contacts
    document.addEventListener("click", function (event) {
      if (event.target.closest(".remove-contact")) {
        const contactGroup = event.target.closest(".contact-group");
        // Don't remove if it's the last one
        const contactGroups = document.querySelectorAll(".contact-group");
        if (contactGroups.length > 1) {
          contactGroup.remove();
        } else {
          // If it's the last one, just clear the value
          const valueInput = contactGroup.querySelector("input[type='text']");
          if (valueInput) {
            valueInput.value = '';
          }
        }
      }
    });
  });
</script>