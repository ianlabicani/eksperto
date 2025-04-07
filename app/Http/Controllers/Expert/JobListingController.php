<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobListing::query();
        // Filter by status (if provided)
        if ($request->query('status')) {
            $query->where('status', $request->status);
        }

        // Search by title or category
        if ($request->query('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by date range
        if ($request->query('start_date') && $request->query('end_date')) {
            $endDate = date('Y-m-d', strtotime($request->end_date . ' +1 day'));
            $query->whereBetween('created_at', [$request->start_date, $endDate]);
        }

        $user = $request->user();

        // Get filtered job listings with pagination
        $jobListings = $query->latest()->paginate(10);

        // Get job IDs the user has applied to (in one query)
        $appliedJobIds = $user->jobApplications()
            ->whereIn('job_listing_id', $jobListings->pluck('id'))
            ->pluck('job_listing_id')
            ->toArray();

        // Append 'has_applied' to each job listing efficiently
        $jobListings->getCollection()->transform(function ($jobListing) use ($appliedJobIds) {
            $jobListing->has_applied = in_array($jobListing->id, $appliedJobIds);
            return $jobListing;
        });

        return view('expert.job-listings.index', compact('jobListings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $jobListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        //
    }
}
