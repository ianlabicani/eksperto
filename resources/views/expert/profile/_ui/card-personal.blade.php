@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Profile;
    use App\Models\Address;

    $user = Auth::user();
    $profile = $user->profile ?? new Profile();
    $address = $user->address ?? new Address();

@endphp


<div class="card mt-3 shadow-lg">
    <div class="card-header">
        <h3>Personal Information</h3>
    </div>
    <div class="card-body">
        <!-- First Name -->
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" value="{{ old('first_name', $profile->first_name) }}"
                disabled>
        </div>

        <!-- Middle Name -->
        <div class="mb-3">
            <label for="middlename" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middlename"
                value="{{ old('middle_name', $profile->middle_name) }}" disabled>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" value="{{ old('last_name', $profile->last_name) }}"
                disabled>
        </div>

        <!-- Suffix -->
        <div class="mb-3">
            <label for="suffix" class="form-label">Suffix</label>
            <input type="text" class="form-control" id="suffix""
                value=" {{ old('suffix', $profile->suffix) }}" disabled>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="date_of_birth"
                value="{{ old('date_of_birth', $profile->date_of_birth) }}" disabled>
        </div>

        <!-- Sex -->
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select class="form-control" id="sex" disabled>
                <option value="other" {{ old('sex', $profile->sex) == 'other' ? 'selected' : '' }}>Other</option>
                <option value="male" {{ old('sex', $profile->sex) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sex', $profile->sex) == 'female' ? 'selected' : '' }}>Female</option>
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
            <label class="form-label">House Number</label>
            <input type="text" class="form-control" value="{{ old('house_number', $address->house_number) }}" disabled>
        </div>

        <!-- Province -->
        <div class="mb-3">
            <label class="form-label">Province</label>
            <input type="text" class="form-control" value="{{ old('province', $address->province) }}" disabled>
        </div>

        <!-- Municipality -->
        <div class="mb-3">
            <label class="form-label">Municipality</label>
            <input type="text" class="form-control" value="{{ old('municipality', $address->municipality) }}" disabled>
        </div>

        <!-- Barangay -->
        <div class="mb-3">
            <label class="form-label">Barangay</label>
            <input type="text" class="form-control" value="{{ old('barangay', $address->barangay) }}" disabled>
        </div>

        <!-- Street -->
        <div class="mb-3">
            <label class="form-label">Street</label>
            <input type="text" class="form-control" value="{{ old('street', $address->street) }}" disabled>
        </div>

        <!-- Zip Code -->
        <div class="mb-3">
            <label class="form-label">Zip Code</label>
            <input type="text" class="form-control" value="{{ old('zip_code', $address->zip_code) }}" disabled>
        </div>

        <!-- Update Address Button -->
        <button class="btn btn-sm btn-warning ms-auto d-block" data-bs-toggle="modal"
            data-bs-target="#updateAddressModal">
            UPDATE ADDRESS
        </button>

        @include('expert.profile._ui.modal-edit-address')
    </div>

    <!-- address -->
    <div class="card-header">
        <h3>Contact Information</h3>
    </div>

    <div class="card-body">
        <!-- Zip Code -->
        @include('expert.profile._ui.contact.index')
    </div>
</div>

@push('scripts')
    <script>
        import phil from 'philippine-location-json-for-geer';

        document.addEventListener('DOMContentLoaded', () => {
            const provinces = phil.getProvinces();
            const provinceInput = document.getElementById('province');

            // Populate provinces dropdown
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.name;
                option.textContent = province.name;
                provinceInput.appendChild(option);
            });
        });
    </script>
@endpush