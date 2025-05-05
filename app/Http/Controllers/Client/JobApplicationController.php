<?php

namespace App\Http\Controllers\Client;

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
        $client = $request->user();

        // Eager load jobListing and expert to prevent lazy loading in Blade
        $jobApplications = $client->jobApplicants()
            ->with(['jobListing', 'expert']) // 👈 eager loading both
            ->get();

        return view('client.job-applications.index', compact('jobApplications'));
    }



    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        $jobApplication->load(['jobListing', 'expert']); // ✅ Eager loading related models

        return view('client.job-applications.show', [
            'jobApplication' => $jobApplication,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        // Validate the request to ensure 'status' is provided and valid
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // Update the job application status
        $jobApplication->update([
            'status' => $request->status,
        ]);

        // Set a flash message for feedback
        $message = $request->status === 'accepted'
            ? 'The application has been accepted successfully.'
            : 'The application has been rejected.';

        return redirect()->back()->with('success', $message);
    }

}
