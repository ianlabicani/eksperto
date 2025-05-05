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

                    <!-- Region -->
                    <div class="mb-3">
                        <label for="region" class="form-label">Region</label>
                        <select class="form-select" id="region" name="region">
                            <option value="" disabled selected>Select a region</option>
                        </select>
                    </div>

                    <!-- Province -->
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <select class="form-select" id="province" name="province">
                            <option value="" disabled selected>Select a province</option>
                        </select>
                    </div>

                    <!-- Municipality / City -->
                    <div class="mb-3">
                        <label for="municipality" class="form-label">Municipality</label>
                        <select class="form-select" id="municipality" name="municipality">
                            <option value="" disabled selected>Select a municipality</option>
                        </select>
                    </div>

                    <!-- Barangay -->
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <select class="form-select" id="barangay" name="barangay">
                            <option value="" disabled selected>Select a barangay</option>
                        </select>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const { regions, getProvincesByRegion, getCityMunByProvince, getBarangayByMun } = phil;

            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const cityMunSelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');

            // Populate Region dropdown
            regions.forEach(region => {
                const option = document.createElement('option');
                option.value = region.reg_code;
                option.textContent = region.name;
                regionSelect.appendChild(option);
            });

            // Province based on selected Region
            regionSelect.addEventListener('change', () => {
                provinceSelect.innerHTML = '<option disabled selected>Select a province</option>';
                cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                const provinces = getProvincesByRegion(regionSelect.value);
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.prov_code;
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });
            });

            // City/Municipality based on selected Province
            provinceSelect.addEventListener('change', () => {
                cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                const cities = getCityMunByProvince(provinceSelect.value);
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.mun_code;
                    option.textContent = city.name;
                    cityMunSelect.appendChild(option);
                });
            });

            // Barangays based on selected City/Municipality
            cityMunSelect.addEventListener('change', () => {
                barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                const barangays = getBarangayByMun(cityMunSelect.value);
                barangays.forEach(barangay => {
                    const option = document.createElement('option');
                    option.value = barangay.name;
                    option.textContent = barangay.name;
                    barangaySelect.appendChild(option);
                });
            });
        });
    </script>
@endpush