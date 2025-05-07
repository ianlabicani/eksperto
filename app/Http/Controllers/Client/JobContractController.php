<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobContract;
use Illuminate\Http\Request;

class JobContractController extends Controller
{

    public function index()
    {
        $jobContracts = JobContract::where('client_id', auth()->id())
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
}
