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
                                <option value="" disabled selected>Select a region</option>
                            </select>
                        </div>

                        <!-- Province -->
                        <div class="col-md-6">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-select" id="province" name="province">
                                <option value="" disabled selected>Select a province</option>
                            </select>
                        </div>

                        <!-- Municipality / City -->
                        <div class="col-md-6">
                            <label for="municipality" class="form-label">Municipality</label>
                            <select class="form-select" id="municipality" name="municipality">
                                <option value="" disabled selected>Select a municipality</option>
                            </select>
                        </div>

                        <!-- Barangay -->
                        <div class="col-md-6">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select class="form-select" id="barangay" name="barangay">
                                <option value="" disabled selected>Select a barangay</option>
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

            // Check if phil object exists before using it
            if (typeof phil !== 'undefined' && phil) {
                const { regions, getProvincesByRegion, getCityMunByProvince, getBarangayByMun } = phil;

                // Populate Region dropdown
                if (Array.isArray(regions)) {
                    regions.forEach(region => {
                        const option = document.createElement('option');
                        option.value = region.reg_code;
                        option.textContent = region.name;
                        regionSelect.appendChild(option);
                    });
                }

                // Safely set up event handlers only if functions exist
                if (typeof getProvincesByRegion === 'function') {
                    regionSelect.addEventListener('change', () => {
                        provinceSelect.innerHTML = '<option disabled selected>Select a province</option>';
                        cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                        barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                        const provinces = getProvincesByRegion(regionSelect.value);
                        if (Array.isArray(provinces)) {
                            provinces.forEach(province => {
                                const option = document.createElement('option');
                                option.value = province.prov_code;
                                option.textContent = province.name;
                                provinceSelect.appendChild(option);
                            });
                        }
                    });
                }

                if (typeof getCityMunByProvince === 'function') {
                    provinceSelect.addEventListener('change', () => {
                        cityMunSelect.innerHTML = '<option disabled selected>Select a municipality</option>';
                        barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                        const cities = getCityMunByProvince(provinceSelect.value);
                        if (Array.isArray(cities)) {
                            cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.mun_code;
                                option.textContent = city.name;
                                cityMunSelect.appendChild(option);
                            });
                        }
                    });
                }

                if (typeof getBarangayByMun === 'function') {
                    cityMunSelect.addEventListener('change', () => {
                        barangaySelect.innerHTML = '<option disabled selected>Select a barangay</option>';

                        const barangays = getBarangayByMun(cityMunSelect.value);
                        if (Array.isArray(barangays)) {
                            barangays.forEach(barangay => {
                                const option = document.createElement('option');
                                option.value = barangay.name;
                                option.textContent = barangay.name;
                                barangaySelect.appendChild(option);
                            });
                        }
                    });
                }
            } else {
                console.warn('Philippine location data not available. Please include the required library.');
            }
        });
    </script>
@endpush
