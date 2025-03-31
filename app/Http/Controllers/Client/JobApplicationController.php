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
        // Get the authenticated expert
        $client = $request->user();

        // Retrieve all job applications of the client
        $jobApplications = $client->jobApplicants()->get();

        return view('client.job-applications.index', compact('jobApplications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        return view('client.job-applications.show', compact('jobApplication'));
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
