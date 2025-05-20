<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobContractController extends Controller
{

    public function index()
    {
        $jobContracts = JobContract::where('client_id', Auth::id())
            ->with([
                'jobApplication.jobListing',
                'expert',
            ])
            ->latest()
            ->get();

        return view('client.job-contracts.index', compact('jobContracts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'job_application_id' => 'required|exists:job_applications,id',
            'expert_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_terms' => 'required|string',
        ]);

        JobContract::create($validated);

        return redirect()->back()->with('success', 'Job contract created successfully.');
    }

    public function show(JobContract $jobContract)
    {
        $jobContract->load([
            'jobApplication.jobListing',
            'expert',
            'contractNegotiation'
        ]);

        return view('client.job-contracts.show', [
            'jobContract' => $jobContract,
            'jobListing' => $jobContract->jobApplication->jobListing,
            'expert' => $jobContract->expert,
        ]);
    }

    /**
     * Update the status of a job contract.
     *
     * @param Request $request
     * @param JobContract $jobContract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, JobContract $jobContract)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:active,pending,completed,cancelled',
        ]);



        try {
            // Check if user owns this contract
            if ($jobContract->client_id !== Auth::id()) {
                return redirect()->back()->with('error', 'You are not authorized to update this contract.');
            }

            // Update the contract status
            $jobContract->status = $validated['status'];

            // If marking as completed, set the completion date
            if ($validated['status'] === 'completed') {
                $jobContract->end_date = now();
            }

            $jobContract->save();

            // Generate appropriate success message
            $message = match ($validated['status']) {
                'active' => 'Contract has been activated successfully.',
                'pending' => 'Contract has been set as pending.',
                'completed' => 'Contract has been marked as completed.',
                'cancelled' => 'Contract has been cancelled.',
                default => 'Contract status has been updated.'
            };

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update contract status: ' . $e->getMessage());
        }
    }
}
