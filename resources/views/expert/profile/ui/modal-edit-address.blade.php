<!-- Modal: Update Address -->
<div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAddressModalLabel">Update Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('expert.address.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- House Number -->
                    <div class="mb-3">
                        <label for="house_number" class="form-label">House Number</label>
                        <input type="text" class="form-control" id="house_number" name="house_number"
                            value="{{ old('house_number', $address->house_number) }}">
                    </div>

                    <!-- Street -->
                    <div class="mb-3">
                        <label for="street" class="form-label">Street</label>
                        <input type="text" class="form-control" id="street" name="street"
                            value="{{ old('street', $address->street) }}">
                    </div>

                    <!-- Barangay -->
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay"
                            value="{{ old('barangay', $address->barangay) }}">
                    </div>

                    <!-- Municipality -->
                    <div class="mb-3">
                        <label for="municipality" class="form-label">Municipality</label>
                        <input type="text" class="form-control" id="municipality" name="municipality"
                            value="{{ old('municipality', $address->municipality) }}">
                    </div>

                    <!-- Province -->
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" name="province"
                            value="{{ old('province', $address->province) }}">
                    </div>

                    <!-- Zip Code -->
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                            value="{{ old('zip_code', $address->zip_code) }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>