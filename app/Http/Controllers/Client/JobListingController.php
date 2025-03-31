<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{

    private $categories = [
        'Web Development',
        'Mobile Development',
        'Desktop Development',
        'Game Development',
        'DevOps & Sysadmin',
        'Engineering & Product',
        'Design & Creative',
        'Writing',
        'Translation',
        'Legal',
        'Admin Support',
        'Customer Service',
        'Sales & Marketing',
        'Accounting & Consulting',
        'Data Science & Analytics',
        'IT & Networking',
        'Other'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobListings = JobListing::where('client_id', $request->user()->id)->latest()->get();
        return view('client.job-listings.index')->with('jobListings', $jobListings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.job-listings.create')->with('categories', $this->categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string',
                'salary' => 'required|numeric',
                'location' => 'required|string',
                'job_type' => 'required|string',
                'requirements' => 'required|string',
                'deadline' => 'required|date',
                'vacancies' => 'required|numeric',
                'rate' => 'required|string'
            ]);



            $jobListing = JobListing::create([
                'client_id' => $request->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'salary' => $validated['salary'],
                'location' => $validated['location'],
                'job_type' => $validated['job_type'],
                'requirements' => $validated['requirements'],
                'status' => 'open',
                'deadline' => $validated['deadline'],
                'vacancies' => $validated['vacancies'],
                'rate' => $validated['rate']
            ]);

            // Redirect back with success message
            return redirect()->route('client.job-listings.index')->with('success', 'Job listing created successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {

        return view('client.job-listings.edit', [
            'jobListing' => $jobListing,
            'categories' => $this->categories
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {

        $jobListing->delete();
        return redirect()->route('client.job-listings.index')->with('success', 'Job listing deleted successfully!');
    }

    public function showWithApplications(JobListing $jobListing)
    {
        $jobApplications = $jobListing->jobApplications()->get();
        $pendingApplications = $jobApplications->where('status', 'pending');
        $acceptedApplications = $jobApplications->where('status', 'accepted');
        $rejectedApplications = $jobApplications->where('status', 'rejected');
        return view('client.job-applications.show', compact('jobListing', 'pendingApplications', 'acceptedApplications', 'rejectedApplications'));
    }
}
