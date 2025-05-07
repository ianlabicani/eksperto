<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $client = $request->user();

        $jobApplications = $client->jobApplicants()
            ->with(['expert', 'jobListing'])
            ->get();

        // Group applications by status
        $pendingApplications = $jobApplications->where('status', 'pending');
        $acceptedApplications = $jobApplications->where('status', 'accepted');
        $rejectedApplications = $jobApplications->where('status', 'rejected');

        return view('client.job-applications.index', compact(
            'pendingApplications',
            'acceptedApplications',
            'rejectedApplications'
        ));
    }

    public function show(JobApplication $jobApplication)
    {
        $jobApplication->load(['jobListing', 'expert.workExperiences', 'jobContract']);

        return view('client.job-applications.show', [
            'jobApplication' => $jobApplication,
            'jobListing' => $jobApplication->jobListing,
            'expert' => $jobApplication->expert,
            'workExperiences' => $jobApplication->expert->workExperiences,
        ]);
    }

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

    public function accept(JobApplication $jobApplication)
    {
        $jobApplication->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'The application has been accepted successfully.');
    }

    public function reject(JobApplication $jobApplication)
    {
        $jobApplication->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'The application has been rejected.');
    }

}
