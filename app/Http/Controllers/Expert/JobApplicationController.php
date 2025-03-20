<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobApplications = JobApplication::where('expert_id', $request->user()->id)->get();

        return view('expert.job-applications.index', compact('jobApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
        ]);

        $jobListing = JobListing::findOrFail($validated['job_listing_id']);

        return view('expert.job-applications.create', compact('jobListing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'job_listing_id' => 'required|exists:job_listings,id',
            'cover_letter' => 'nullable|string|max:500',
        ]);

        $jobApplication = JobApplication::create([
            'expert_id' => $request->user()->id,
            'client_id' => $validated['client_id'],
            'job_listing_id' => $validated['job_listing_id'],
            'cover_letter' => $validated['cover_letter'],
        ]);

        // Redirect to the job application details page
        return redirect()->route('expert.job-applications.show', $jobApplication->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        return view('expert.job-applications.show', compact('jobApplication'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        throw new \Exception('Method not implemented');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {

        try {
            $validated = $request->validate([
                'status' => 'required|in:cancelled',
            ]);

            $jobApplication->update($validated);
            return redirect()->route('expert.job-applications.index');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update job application status');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        throw new \Exception('Method not implemented');
    }
}
