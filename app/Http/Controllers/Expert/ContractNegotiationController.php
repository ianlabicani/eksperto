<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ContractNegotiation;
use App\Models\JobContract;
use Illuminate\Http\Request;

class ContractNegotiationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        throw new \Exception('Method not implemented');

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
        $validated = $request->validate([
            'job_contract_id' => 'required|exists:job_contracts,id',
            'negotiation_message' => 'required|string|max:500',
        ]);

        $jobContract = JobContract::findOrFail($validated['job_contract_id']);

        $jobContract->contractNegotiation()->create([
            'expert_id' => $request->user()->id,
            'negotiation_message' => $validated['negotiation_message'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Contract negotiation message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented');

    }
}
