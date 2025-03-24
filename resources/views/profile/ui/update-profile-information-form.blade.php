<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"
            required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="middle_name" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="middle_name" name="middle_name"
            value="{{ old('middle_name', $profile->middle_name) }}">
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name"
            value="{{ old('last_name', $profile->last_name) }}" required>
    </div>

    <div class="mb-3">
        <label for="suffix" class="form-label">Suffix</label>
        <input type="text" class="form-control" id="suffix" name="suffix" value="{{ old('suffix', $profile->suffix) }}">
    </div>

    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
            value="{{ old('date_of_birth', $profile->date_of_birth) }}">
    </div>

    <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" class="form-control" id="contact" name="contact"
            value="{{ old('contact', $profile->contact) }}" required>
    </div>

    <div class="mb-3">
        <label for="house_number" class="form-label">House No.</label>
        <input type="text" class="form-control" id="house_number" name="house_number"
            value="{{ old('house_number', $profile->house_number) }}">
    </div>

    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $profile->street) }}">
    </div>

    <div class="mb-3">
        <label for="barangay" class="form-label">Barangay</label>
        <input type="text" class="form-control" id="barangay" name="barangay"
            value="{{ old('barangay', $profile->barangay) }}">
    </div>

    <div class="mb-3">
        <label for="municipality" class="form-label">Municipality</label>
        <input type="text" class="form-control" id="municipality" name="municipality"
            value="{{ old('municipality', $profile->municipality) }}">
    </div>

    <div class="mb-3">
        <label for="province" class="form-label">Province</label>
        <input type="text" class="form-control" id="province" name="province"
            value="{{ old('province', $profile->province) }}">
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>