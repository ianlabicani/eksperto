<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="updateProfileModalLabel"><i class="fas fa-user-edit me-2"></i>Update Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('client.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="firstname" name="first_name"
                                    placeholder="First Name" value="{{ old('first_name', $profile->first_name) }}">
                                <label for="firstname">First Name</label>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="lastname" name="last_name"
                                    placeholder="Last Name" value="{{ old('last_name', $profile->last_name) }}">
                                <label for="lastname">Last Name</label>
                            </div>
                        </div>

                        <!-- Middle Name -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="middlename" name="middle_name"
                                    placeholder="Middle Name" value="{{ old('middle_name', $profile->middle_name) }}">
                                <label for="middlename">Middle Name</label>
                            </div>
                        </div>

                        <!-- Suffix -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix"
                                    value="{{ old('suffix', $profile->suffix) }}">
                                <label for="suffix">Suffix</label>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    placeholder="Date of Birth"
                                    value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}">
                                <label for="date_of_birth">Date of Birth</label>
                            </div>
                        </div>

                        <!-- Sex -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="sex" name="sex" aria-label="Select sex">
                                    <option value="male" {{ old('sex', $profile->sex) == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ old('sex', $profile->sex) == 'female' ? 'selected' : '' }}>
                                        Female</option>
                                    <option value="other" {{ old('sex', $profile->sex) == 'other' ? 'selected' : '' }}>
                                        Other</option>
                                </select>
                                <label for="sex">Sex</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>