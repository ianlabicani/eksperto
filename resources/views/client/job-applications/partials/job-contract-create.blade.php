<div class="modal fade" id="createContractModal" tabindex="-1" aria-labelledby="createContractModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createContractModalLabel"><i class="fas fa-file-contract"></i> Create Job
                    Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('client.job-contracts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="job_listing_id" value="{{ $jobListing->id }}">
                    <input type="hidden" name="job_application_id" value="{{ $jobApplication->id }}">
                    <input type="hidden" name="expert_id" value="{{ $expert->id }}">
                    <input type="hidden" name="client_id" value="{{ $jobListing->client->id }}">

                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="start_date" class="form-label"><i class="fas fa-calendar-alt"></i> Start
                            Date</label>
                        <input type="date" class="form-control  is-invalid" id="start_date" name="start_date"
                            value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="end_date" class="form-label"><i class="fas fa-calendar-times"></i> End Date</label>
                        <input type="date" class="form-control is-invali" id="end_date" name="end_date"
                            value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contract Terms -->
                    <div class="mb-3">
                        <label for="contract_terms" class="form-label"><i class="fas fa-file-alt"></i> Contract
                            Terms</label>
                        <textarea class="form-control is-invalid" id="contract_terms" name="contract_terms"
                            rows="10">{{ old('contract_terms') }}</textarea>
                        @error('contract_terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Send Contract
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
