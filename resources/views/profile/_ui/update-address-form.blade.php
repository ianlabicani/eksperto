<form method="POST" action="{{ route('address.update') }}">
    @csrf
    @method('PATCH')

    <h5 class="fw-bold mt-4">Address Information</h5>

    <div class="mb-3">
        <label for="house_number" class="form-label">House No.</label>
        <input type="text" class="form-control" id="house_number" name="house_number"
            value="{{ old('house_number', $address->house_number) }}">
    </div>

    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $address->street) }}">
    </div>

    <div class="mb-3">
        <label for="barangay" class="form-label">Barangay</label>
        <input type="text" class="form-control" id="barangay" name="barangay"
            value="{{ old('barangay', $address->barangay) }}">
    </div>

    <div class="mb-3">
        <label for="municipality" class="form-label">Municipality</label>
        <input type="text" class="form-control" id="municipality" name="municipality"
            value="{{ old('municipality', $address->municipality) }}">
    </div>

    <div class="mb-3">
        <label for="province" class="form-label">Province</label>
        <input type="text" class="form-control" id="province" name="province"
            value="{{ old('province', $address->province) }}">
    </div>

    <div class="mb-3">
        <label for="zip_code" class="form-label">Zip Code</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code"
            value="{{ old('zip_code', $address->zip_code) }}">
    </div>

    <button type="submit" class="btn btn-primary">Save Address</button>
</form>