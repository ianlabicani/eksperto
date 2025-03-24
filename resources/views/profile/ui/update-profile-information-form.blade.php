<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <h5 class="fw-bold">Profile Information</h5>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"
            required>
    </div>

    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name"
            value="{{ old('first_name', $profile->first_name) }}" required>
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
        <label for="sex" class="form-label">Sex</label>
        <select class="form-select" id="sex" name="sex" required>
            <option value="" disabled {{ old('sex', $profile->sex) === null ? 'selected' : '' }}>Select your sex</option>
            <option value="male" {{ old('sex', $profile->sex) === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('sex', $profile->sex) === 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('sex', $profile->sex) === 'other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save Profile</button>
</form>