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
        $jobApplications = JobApplication::select('id', 'job_listing_id', 'status', 'created_at')
            ->where('expert_id', $request->user()->id)
            ->with([
                'jobListing:id,title,client_id',
                'jobListing.client:id,name'
            ])
            ->get();

        return view('expert.job-applications.index', compact('jobApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Since we're now using POST, explicitly validate the input
        $validated = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
        ]);

        $jobListing = JobListing::with('client')->findOrFail($request->input('job_listing_id'));

        // Check if user has already applied
        if ($jobListing->jobApplications()->where('expert_id', $request->user()->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Check if job is still open
        if ($jobListing->status === 'closed') {
            return redirect()->back()->with('error', 'This job is no longer accepting applications.');
        }

        return view('expert.job-applications.create', compact('jobListing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_listing_id' => 'required|exists:job_listings,id',
            'cover_letter' => 'nullable|string|max:500',
        ]);

        // Check if user has already applied
        if (
            JobListing::find($validated['job_listing_id'])
                ->jobApplications()
                ->where('expert_id', $request->user()->id)
                ->exists()
        ) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        $jobApplication = JobApplication::create([
            'expert_id' => $request->user()->id,
            'client_id' => JobListing::find($validated['job_listing_id'])->client_id,
            'job_listing_id' => $validated['job_listing_id'],
            'cover_letter' => $validated['cover_letter'],
        ]);

        return redirect()->route('expert.job-applications.show', $jobApplication->id)
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        // Eager load relationships to avoid lazy loading issues
        $jobApplication->load(['jobListing', 'jobListing.client']);

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
