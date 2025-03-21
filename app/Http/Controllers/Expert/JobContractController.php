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
        // Eager load related models
        $jobContract->load('jobApplication.jobListing');

        $jobApplication = $jobContract->jobApplication;
        $jobListing = $jobApplication->jobListing;

        // Batch update to minimize queries
        $jobContract->update(['status' => 'active']);
        $jobApplication->update(['status' => 'accepted']);

        // Update vacancies & job listing status
        if ($jobListing->vacancies > 0) {
            $jobListing->decrement('vacancies');
        }

        if ($jobListing->vacancies === 0) {
            $jobListing->update(['status' => 'closed']);
        }

        return back()->with('success', 'Contract accepted successfully');
    }

    public function decline(JobContract $jobContract)
    {
        // Eager load job application
        $jobContract->load('jobApplication');

        // Batch update
        $jobContract->update(['status' => 'cancelled']);
        $jobContract->jobApplication->update(['status' => 'cancelled']);

        return back()->with('success', 'Contract declined successfully');
    }

}
