<div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="updateAddressModalLabel"><i class="fas fa-map-marked-alt me-2"></i>Update
                    Address</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('client.address.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- House Number -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="house_number" name="house_number"
                                    placeholder="House Number"
                                    value="{{ old('house_number', $address->house_number) }}">
                                <label for="house_number">House Number</label>
                            </div>
                        </div>

                        <!-- Street -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="street" name="street" placeholder="Street"
                                    value="{{ old('street', $address->street) }}">
                                <label for="street">Street</label>
                            </div>
                        </div>

                        <!-- Barangay -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="barangay" name="barangay"
                                    placeholder="Barangay" value="{{ old('barangay', $address->barangay) }}">
                                <label for="barangay">Barangay</label>
                            </div>
                        </div>

                        <!-- Municipality -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="municipality" name="municipality"
                                    placeholder="Municipality"
                                    value="{{ old('municipality', $address->municipality) }}">
                                <label for="municipality">Municipality</label>
                            </div>
                        </div>

                        <!-- Province -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="province" name="province"
                                    placeholder="Province" value="{{ old('province', $address->province) }}">
                                <label for="province">Province</label>
                            </div>
                        </div>

                        <!-- Zip Code -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    placeholder="Zip Code" value="{{ old('zip_code', $address->zip_code) }}">
                                <label for="zip_code">Zip Code</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>