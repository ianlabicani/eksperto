@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $profile = $user->profile;
    $address = $user->address;

@endphp


<div class="card mt-3 shadow-lg">
    <div class="card-header">
        <h3>Personal Information</h3>
    </div>
    <div class="card-body">
        <!-- First Name -->
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" placeholder="John"
                value="{{ old('first_name', $profile->first_name) }}" disabled>
        </div>

        <!-- Middle Name -->
        <div class="mb-3">
            <label for="middlename" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middlename" placeholder="Doe"
                value="{{ old('middle_name', $profile->middle_name) }}" disabled>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" placeholder="Smith"
                value="{{ old('last_name', $profile->last_name) }}" disabled>
        </div>

        <!-- Suffix -->
        <div class="mb-3">
            <label for="suffix" class="form-label">Suffix</label>
            <input type="text" class="form-control" id="suffix" placeholder="Jr."
                value="{{ old('suffix', $profile->suffix) }}" disabled>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" value="{{ old('date_of_birth', $profile->date_of_birth) }}"
                disabled>
        </div>

        <!-- Sex -->
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select class="form-control" id="sex" disabled>
                <option value="male" {{ old('sex', $profile->sex) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sex', $profile->sex) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('sex', $profile->sex) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <button class="btn btn-sm btn-warning  ms-auto d-block" data-bs-toggle="modal"
            data-bs-target="#updateProfileModal">
            UPDATE PROFILE
        </button>
        <!-- Modal -->
        @include('expert.profile._ui.modal-edit-personal')

    </div>
    <!-- address -->
    <div class="card-header">
        <h3>Address Information</h3>
    </div>
    <div class="card-body">
        <!-- House Number -->
        <div class="mb-3">
            <label for="house_number" class="form-label">House Number</label>
            <input type="text" class="form-control" id="house_number" placeholder="House Number"
                value="{{ old('house_number', $address->house_number) }}" disabled>
        </div>

        <!-- Street -->
        <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="text" class="form-control" id="street" placeholder="Street Name"
                value="{{ old('street', $address->street) }}" disabled>
        </div>

        <!-- Barangay -->
        <div class="mb-3">
            <label for="barangay" class="form-label">Barangay</label>
            <input type="text" class="form-control" id="barangay" placeholder="Barangay Name"
                value="{{ old('barangay', $address->barangay) }}" disabled>
        </div>

        <!-- Municipality -->
        <div class="mb-3">
            <label for="municipality" class="form-label">Municipality</label>
            <input type="text" class="form-control" id="municipality" placeholder="Municipality Name"
                value="{{ old('municipality', $address->municipality) }}" disabled>
        </div>

        <!-- Province -->
        <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <input type="text" class="form-control" id="province" placeholder="Province Name"
                value="{{ old('province', $address->province) }}" disabled>
        </div>

        <!-- Zip Code -->
        <div class="mb-3">
            <label for="zip_code" class="form-label">Zip Code</label>
            <input type="text" class="form-control" id="zip_code" placeholder="Zip Code"
                value="{{ old('zip_code', $address->zip_code) }}" disabled>
        </div>

        <!-- Update Address Button -->
        <button class="btn btn-sm btn-warning ms-auto d-block" data-bs-toggle="modal"
            data-bs-target="#updateAddressModal">
            UPDATE ADDRESS
        </button>

        @include('expert.profile._ui.modal-edit-address')
    </div>
</div>