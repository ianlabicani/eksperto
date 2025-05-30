<!-- Modal: Update Address -->
<div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="{{ route('expert.address.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="updateAddressModalLabel"><i
                            class="fas fa-map-marker-alt me-2"></i>Update Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- House Number -->
                        <div class="col-md-6">
                            <label for="house_number" class="form-label">House Number</label>
                            <input type="text" class="form-control" id="house_number" name="house_number"
                                value="{{ old('house_number', $address->house_number) }}">
                        </div>

                        <!-- Street -->
                        <div class="col-md-6">
                            <label for="street" class="form-label">Street</label>
                            <input type="text" class="form-control" id="street" name="street"
                                value="{{ old('street', $address->street) }}">
                        </div>

                        <!-- Region -->
                        <div class="col-md-6">
                            <label for="region" class="form-label">Region</label>
                            <select class="form-select" id="region" name="region">
                                <option value="{{ old('region', $address->region) }}" selected>
                                    {{ old('region', $address->region) ?: 'Select a region' }}
                                </option>
                            </select>
                        </div>

                        <!-- Province -->
                        <div class="col-md-6">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-select" id="province" name="province" {{ !old('province', $address->province) ? 'disabled' : '' }}>
                                <option value="{{ old('province', $address->province) }}" selected>
                                    {{ old('province', $address->province) ?: 'Select a province' }}
                                </option>
                            </select>
                        </div>

                        <!-- Municipality / City -->
                        <div class="col-md-6">
                            <label for="municipality" class="form-label">Municipality</label>
                            <select class="form-select" id="municipality" name="municipality" {{ !old('municipality', $address->municipality) ? 'disabled' : '' }}>
                                <option value="{{ old('municipality', $address->municipality) }}" selected>
                                    {{ old('municipality', $address->municipality) ?: 'Select a municipality' }}
                                </option>
                            </select>
                        </div>

                        <!-- Barangay -->
                        <div class="col-md-6">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select class="form-select" id="barangay" name="barangay" {{ !old('barangay', $address->barangay) ? 'disabled' : '' }}>
                                <option value="{{ old('barangay', $address->barangay) }}" selected>
                                    {{ old('barangay', $address->barangay) ?: 'Select a barangay' }}
                                </option>
                            </select>
                        </div>

                        <!-- Zip Code -->
                        <div class="col-md-6">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                value="{{ old('zip_code', $address->zip_code) }}">
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Reference to select elements
            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const cityMunSelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');

            // Get current values (from the option values)
            const currentProvince = "{{ old('province', $address->province ?? '') }}";
            const currentMunicipality = "{{ old('municipality', $address->municipality ?? '') }}";
            const currentBarangay = "{{ old('barangay', $address->barangay ?? '') }}";
            const currentRegion = "{{ old('region', $address->region ?? '') }}";

            // Check if phil object exists before using it
            if (typeof phil !== 'undefined' && phil) {
                const { regions, getProvincesByRegion, getCityMunByProvince, getBarangayByMun } = phil;

                // Populate Region dropdown
                if (Array.isArray(regions)) {
                    let selectedRegionCode = null;

                    regions.forEach(region => {
                        const option = document.createElement('option');
                        option.value = region.name;
                        option.textContent = region.name;
                        option.dataset.code = region.reg_code;

                        // Check if this is our current region (by name)
                        if (currentRegion && region.name.toLowerCase() === currentRegion.toLowerCase()) {
                            option.selected = true;
                            selectedRegionCode = region.reg_code;
                        }

                        regionSelect.appendChild(option);
                    });

                    // If we have a region selected
                    if (selectedRegionCode) {
                        // Enable province select
                        provinceSelect.disabled = false;

                        // Clear default option
                        provinceSelect.innerHTML = '<option disabled>Select a province</option>';

                        // Populate provinces
                        const provinces = getProvincesByRegion(selectedRegionCode);
                        let selectedProvinceCode = null;

                        if (Array.isArray(provinces)) {
                            provinces.forEach(province => {
                                const option = document.createElement('option');
                                option.value = province.name;
                                option.textContent = province.name;
                                option.dataset.code = province.prov_code;

                                // Check if this is our current province
                                if (currentProvince && province.name.toLowerCase() === currentProvince.toLowerCase()) {
                                    option.selected = true;
                                    selectedProvinceCode = province.prov_code;
                                }

                                provinceSelect.appendChild(option);
                            });

                            // If we have a province selected
                            if (selectedProvinceCode) {
                                // Enable municipality select
                                cityMunSelect.disabled = false;

                                // Clear default option
                                cityMunSelect.innerHTML = '<option disabled>Select a municipality</option>';

                                // Populate municipalities
                                const municipalities = getCityMunByProvince(selectedProvinceCode);
                                let selectedMunicipalityCode = null;

                                if (Array.isArray(municipalities)) {
                                    municipalities.forEach(municipality => {
                                        const option = document.createElement('option');
                                        option.value = municipality.name;
                                        option.textContent = municipality.name;
                                        option.dataset.code = municipality.mun_code;

                                        // Check if this is our current municipality
                                        if (currentMunicipality && municipality.name.toLowerCase() === currentMunicipality.toLowerCase()) {
                                            option.selected = true;
                                            selectedMunicipalityCode = municipality.mun_code;
                                        }

                                        cityMunSelect.appendChild(option);
                                    });

                                    // If we have a municipality selected
                                    if (selectedMunicipalityCode) {
                                        // Enable barangay select
                                        barangaySelect.disabled = false;

                                        // Clear default option
                                        barangaySelect.innerHTML = '<option disabled>Select a barangay</option>';

                                        // Populate barangays
                                        const barangays = getBarangayByMun(selectedMunicipalityCode);

                                        if (Array.isArray(barangays)) {
                                            barangays.forEach(barangay => {
                                                const option = document.createElement('option');
                                                option.value = barangay.name;
                                                option.textContent = barangay.name;

                                                // Check if this is our current barangay
                                                if (currentBarangay && barangay.name.toLowerCase() === currentBarangay.toLowerCase()) {
                                                    option.selected = true;
                                                }

                                                barangaySelect.appendChild(option);
                                            });
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                // Event handler for region selection change
                regionSelect.addEventListener('change', () => {
                    // Clear and reset province dropdown
                    provinceSelect.innerHTML = '<option disabled selected>Select a province</option>';
                    provinceSelect.disabled = false;

                    // Clear and disable subsequent dropdowns
                    cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                    cityMunSelect.disabled = true;
                    barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';
                    barangaySelect.disabled = true;

                    // Get the region code from the selected option's data attribute
                    const selectedOption = regionSelect.options[regionSelect.selectedIndex];
                    const regionCode = selectedOption.dataset.code;

                    // Only populate if a valid region is selected
                    if (regionCode) {
                        const provinces = getProvincesByRegion(regionCode);
                        if (Array.isArray(provinces)) {
                            provinces.forEach(province => {
                                const option = document.createElement('option');
                                option.value = province.name;
                                option.textContent = province.name;
                                option.dataset.code = province.prov_code;
                                provinceSelect.appendChild(option);
                            });
                        }
                    } else {
                        provinceSelect.disabled = true;
                    }
                });

                // Event handler for province selection change
                provinceSelect.addEventListener('change', () => {
                    // Clear and reset municipality dropdown
                    cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                    cityMunSelect.disabled = false;

                    // Clear and disable barangay dropdown
                    barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';
                    barangaySelect.disabled = true;

                    // Get the province code from the selected option's data attribute
                    const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                    const provinceCode = selectedOption.dataset.code;

                    // Only populate if a valid province is selected
                    if (provinceCode) {
                        const cities = getCityMunByProvince(provinceCode);
                        if (Array.isArray(cities)) {
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.name;
                                option.textContent = city.name;
                                option.dataset.code = city.mun_code;
                                cityMunSelect.appendChild(option);
                            });
                        }
                    } else {
                        cityMunSelect.disabled = true;
                    }
                });

                // Event handler for municipality selection change
                cityMunSelect.addEventListener('change', () => {
                    // Clear and reset barangay dropdown
                    barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';
                    barangaySelect.disabled = false;

                    // Get the municipality code from the selected option's data attribute
                    const selectedOption = cityMunSelect.options[cityMunSelect.selectedIndex];
                    const municipalityCode = selectedOption.dataset.code;

                    // Only populate if a valid municipality is selected
                    if (municipalityCode) {
                        const barangays = getBarangayByMun(municipalityCode);
                        if (Array.isArray(barangays)) {
                            barangays.forEach(barangay => {
                                const option = document.createElement('option');
                                option.value = barangay.name;
                                option.textContent = barangay.name;
                                barangaySelect.appendChild(option);
                            });
                        }
                    } else {
                        barangaySelect.disabled = true;
                    }
                });
            } else {
                console.warn('Philippine location data not available. Please include the required library.');
            }
        });
    </script>
@endpush
