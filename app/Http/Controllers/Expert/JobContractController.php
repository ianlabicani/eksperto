<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\JobContract;
use Illuminate\Http\Request;

class JobContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobContracts = JobContract::where('expert_id', auth()->id())->get();
        return view('expert.job-contracts.index', compact('jobContracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Display the specified resource.
     */
    public function show(JobContract $jobContract)
    {
        return view('expert.job-contracts.show', compact('jobContract'));
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

    public function accept(JobContract $jobContract)
    {
        $jobContract->update(['status' => 'accepted']);
        return back()->with('success', 'Contract accepted successfully');
    }

    public function negotiate(Request $request, JobContract $jobContract)
    {
        // Validate the request
        $request->validate([
            'contract_terms' => 'required|string|min:10',
        ]);

        // Check if the authenticated expert is associated with the contract
        if ($jobContract->jobApplication->expert_id !== auth()->id()) {
            return redirect()->route('expert.job-contracts.show', $jobContract->id)
                ->with('error', 'You are not authorized to amend this contract.');
        }

        // Mark the contract as "pending amendment"
        $jobContract->update([
            'contract_terms' => $request->contract_terms,
            'status' => 'amend_requested', // Assuming you have a status column
        ]);

        return redirect()->route('expert.job-contracts.show', $jobContract->id)
            ->with('success', 'Amendment request sent successfully.');
    }
}
