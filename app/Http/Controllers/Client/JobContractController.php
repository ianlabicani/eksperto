<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ContractNegotiation;
use App\Models\JobApplication;
use App\Models\JobContract;
use Illuminate\Http\Request;

class JobContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobContracts = JobContract::where('client_id', auth()->id())->latest()->get();

        return view('client.job-contracts.index', compact('jobContracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jobApplication = JobApplication::findOrFail($request->query('jobApplication'));

        return view('client.job-contracts.create', compact('jobApplication'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'expert_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'contract_terms' => 'required|string',
        ]);

        // Create the contract
        JobContract::create([
            'job_application_id' => $request->job_application_id,
            'client_id' => $request->user()->id,
            'expert_id' => $request->expert_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'contract_terms' => $request->contract_terms,
        ]);

        // Redirect with success message
        return redirect()->route('client.job-contracts.index')
            ->with('success', 'Job contract created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(JobContract $jobContract)
    {
        return view('client.job-contracts.show', compact('jobContract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobContract $jobContract)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobContract $jobContract)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobContract $jobContract)
    {
        throw new \Exception('Method not implemented');
    }
}
