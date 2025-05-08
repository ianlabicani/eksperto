<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('expert.profile.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="updateProfileModalLabel"><i class="fas fa-user-edit me-2"></i>Update
                        Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="first_name"
                                value="{{ old('first_name', $profile->first_name) }}">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="last_name"
                                value="{{ old('last_name', $profile->last_name) }}">
                        </div>

                        <!-- Middle Name -->
                        <div class="col-md-6">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middle_name"
                                value="{{ old('middle_name', $profile->middle_name) }}">
                        </div>

                        <!-- Suffix -->
                        <div class="col-md-6">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix"
                                value="{{ old('suffix', $profile->suffix) }}">
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth', $profile->date_of_birth) }}">
                        </div>

                        <!-- Sex -->
                        <div class="col-md-6">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex">
                                <option value="male" {{ old('sex', $profile->sex) == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ old('sex', $profile->sex) == 'female' ? 'selected' : '' }}>
                                    Female</option>
                                <option value="other" {{ old('sex', $profile->sex) == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                    </div>
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