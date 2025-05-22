<div class="modal fade" id="createContractModal" tabindex="-1" aria-labelledby="createContractModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header bg-primary text-white py-3 border-0">
                <h5 class="modal-title" id="createContractModalLabel">
                    <i class="fas fa-file-contract me-2"></i> Create Job Contract
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info rounded-3 border-0 mb-4">
                    <div class="d-flex">
                        <div class="me-3">
                            <i class="fas fa-info-circle fa-lg"></i>
                        </div>
                        <div>
                            <p class="mb-0">You're creating a contract for <strong>{{ $expert->name }}</strong> for the
                                job <strong>{{ $jobListing->title }}</strong>.
                                Once sent, the expert will need to accept the contract before work can begin.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('client.job-contracts.store') }}" method="POST" id="contractForm">
                    @csrf
                    <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">
                    <input type="hidden" name="job_application_id" value="{{ $jobApplication->id }}">
                    <input type="hidden" name="expert_id" value="{{ $expert->id }}">
                    <input type="hidden" name="client_id" value="{{ $jobListing->client->id }}">

                    <div class="row g-4">
                        <!-- Start Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label fw-medium">
                                    <i class="fas fa-calendar-alt text-primary me-1"></i> Start Date
                                </label>
                                <input type="date"
                                    class="form-control rounded-3 @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date"
                                    value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
                                <div class="form-text">When should the contract begin?</div>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label fw-medium">
                                    <i class="fas fa-calendar-times text-primary me-1"></i> End Date
                                </label>
                                <input type="date"
                                    class="form-control rounded-3 @error('end_date') is-invalid @enderror" id="end_date"
                                    name="end_date" value="{{ old('end_date') }}">
                                <div class="form-text">Leave blank for ongoing contracts</div>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contract Terms -->
                    <div class="mb-4">
                        <label for="contract_terms" class="form-label fw-medium">
                            <i class="fas fa-file-alt text-primary me-1"></i> Contract Terms
                        </label>
                        <textarea class="form-control rounded-3 @error('contract_terms') is-invalid @enderror"
                            id="contract_terms" name="contract_terms" rows="10"
                            placeholder="Specify payment terms, deliverables, confidentiality agreements, and other contract details here...">{{ old('contract_terms', "1. SCOPE OF WORK\n\n2. PAYMENT TERMS\n\n3. DELIVERABLES\n\n4. TIMEFRAME\n\n5. CONFIDENTIALITY\n\n6. INTELLECTUAL PROPERTY\n\n7. TERMINATION") }}</textarea>
                        @error('contract_terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" id="contractSubmitBtn">
                            <i class="fas fa-paper-plane me-1"></i> Send Contract
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set minimum date for start_date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start_date').setAttribute('min', today);

        // Set minimum date for end_date to start_date
        document.getElementById('start_date').addEventListener('change', function () {
            document.getElementById('end_date').setAttribute('min', this.value);
        });

        // Form validation
        const contractForm = document.getElementById('contractForm');
        const submitBtn = document.getElementById('contractSubmitBtn');

        contractForm.addEventListener('submit', function (e) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Sending...';
            submitBtn.disabled = true;
        });
    });
</script>