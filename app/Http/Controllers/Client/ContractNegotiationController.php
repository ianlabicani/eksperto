<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ContractNegotiation;
use Illuminate\Http\Request;

class ContractNegotiationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractNegotiation $contractNegotiation)
    {
        throw new \Exception('Method not implemented.');
    }

    public function accept($id)
    {
        $negotiation = ContractNegotiation::with([
            'jobContract.jobApplication.jobListing'
        ])->findOrFail($id);

        $jobContract = $negotiation->jobContract;
        $jobApplication = $jobContract->jobApplication;
        $jobListing = $jobApplication->jobListing;

        // Batch update to minimize queries
        $negotiation->update(['status' => 'accepted']);
        $jobContract->update(['status' => 'active']);
        $jobApplication->update(['status' => 'accepted']);

        // Atomic decrement with conditional status update
        if ($jobListing->vacancies > 0) {
            $jobListing->decrement('vacancies');

            if ($jobListing->fresh()->vacancies == 0) {
                // Use `fresh()` to ensure the updated value is retrieved
                $jobListing->update(['status' => 'closed']);
            }
        }

        return redirect()->back()->with('success', 'Negotiation accepted successfully.');
    }

    public function reject($id)
    {
        $negotiation = ContractNegotiation::with(['jobContract.jobApplication'])->findOrFail($id);

        $jobContract = $negotiation->jobContract;
        $jobApplication = $jobContract->jobApplication;

        // Batch update to reduce queries
        $negotiation->update(['status' => 'rejected']);
        $jobContract->update(['status' => 'cancelled']);
        $jobApplication->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Negotiation rejected.');
    }

}
