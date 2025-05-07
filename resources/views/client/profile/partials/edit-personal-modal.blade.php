<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('client.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="first_name"
                            value="{{ old('first_name', $profile->first_name) }}">
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middle_name"
                            value="{{ old('middle_name', $profile->middle_name) }}">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="last_name"
                            value="{{ old('last_name', $profile->last_name) }}">
                    </div>

                    <!-- Suffix -->
                    <div class="mb-3">
                        <label for="suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control" id="suffix" name="suffix"
                            value="{{ old('suffix', $profile->suffix) }}">
                    </div>

                    <!-- Sex -->
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="male" {{ old('sex', $profile->sex) == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('sex', $profile->sex) == 'female' ? 'selected' : '' }}>
                                Female
                            </option>
                            <option value="other" {{ old('sex', $profile->sex) == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                            value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>