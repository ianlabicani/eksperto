@extends('expert.profile.shell')

@section('profile-content')
    <div class="card">
        <div class="card-header">
            <h3>Educational Background</h3>
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
                @forelse ($educations as $education)
                    <li>
                        <strong>Level:</strong> {{ $education->level }}<br>
                        <strong>University:</strong> {{ $education->university }}<br>
                        <strong>Course:</strong> {{ $education->course }}<br>
                        <strong>Year:</strong> {{ $education->year }}<br>
                        <strong>Award:</strong> {{ $education->award ?? 'N/A' }}
                        <hr>
                    </li>
                @empty
                    <li class="text-center">
                        <div class="alert alert-info text-center" role="alert">
                            No educational background added yet.
                        </div>
                    </li>
                @endforelse
            </ul>
            <!-- Button to Open Add Education Modal -->
            <button class="btn btn-warning d-block ms-auto" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                Add Education
            </button>

            <!-- Modal: Add Educational Background -->
            <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEducationModalLabel">Add Educational Background</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('expert.educational-background.store') }}">
                                @csrf
                                <!-- Level -->
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">Select Level</option>
                                        <option value="">Select Level </option>
                                        <option value="Grade I">Grade I</option>
                                        <option value="Grade II">Grade II</option>
                                        <option value="Grade III">Grade III</option>
                                        <option value="Grade IV">Grade IV</option>
                                        <option value="Grade V">Grade V</option>
                                        <option value="Grade VI">Grade VI</option>
                                        <option value="1st Year High School/Grade VII">1st Year High School/Grade VII (For K
                                            to 12)</option>
                                        <option value="2nd Year High School/Grade VIII">2nd Year High School/Grade VIII (For
                                            K to 12)</option>
                                        <option value="3rd Year High School/Grade IX">3rd Year High School/Grade IX (For K
                                            to 12)</option>
                                        <option value="4th Year High School/Grade X">4th Year High School/Grade X (For K to
                                            12)</option>
                                        <option value="Grade XI">Grade XI (For K to 12)</option>
                                        <option value="Grade XII">Grade XII (For K to 12)</option>
                                        <option value="High School Graduate">High School Graduate</option>
                                        <option value="Vocational Undergraduate">Vocational Undergraduate</option>
                                        <option value="Vocational Graduate">Vocational Graduate</option>
                                        <option value="1st Year College Level">1st Year College Level</option>
                                        <option value="2nd Year College Level">2nd Year College Level</option>
                                        <option value="3rd Year College Level">3rd Year College Level</option>
                                        <option value="4th Year College Level">4th Year College Level</option>
                                        <option value="5th Year College Level">5th Year College Level</option>
                                        <option value="College Graduate">College Graduate</option>
                                        <option value="Masteral/Post Graduate Level">Masteral/Post Graduate Level</option>
                                        <option value="Masteral/Post Graduate">Masteral/Post Graduate</option>
                                    </select>
                                </div>

                                <!-- University -->
                                <div class="mb-3">
                                    <label for="university" class="form-label">University</label>
                                    <input type="text" class="form-control" id="university" name="university" required>
                                </div>

                                <!-- Course -->
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <input type="text" class="form-control" id="course" name="course" required>
                                </div>

                                <!-- Year -->
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="text" class="form-control" id="year" name="year" required>
                                </div>

                                <!-- Award (Optional) -->
                                <div class="mb-3">
                                    <label for="award" class="form-label">Award (if any)</label>
                                    <input type="text" class="form-control" id="award" name="award">
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
        </div>
</div>@endsection