<div class="modal fade" id="addExpertiseModal" tabindex="-1" aria-labelledby="addExpertiseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpertiseModalLabel">Add Expertise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('expert.expertise.store') }}">
                    @csrf

                    <!-- Expertise Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Field of Expertise</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Proficiency Level -->
                    <div class="mb-3">
                        <label for="level" class="form-label">Proficiency Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="">Select Level</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>

                    <!-- Years of Experience -->
                    <div class="mb-3">
                        <label for="years_of_experience" class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" id="years_of_experience" name="years_of_experience"
                            min="0" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>