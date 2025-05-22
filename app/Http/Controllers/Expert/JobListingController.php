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

        // 🔥 Filter job listings by user's expertise categories
        $preferredCategories = $user->expertises()
            ->with('expertiseCategory') // assuming relationship `category()` in Expertise model
            ->get()
            ->pluck('expertiseCategory.name') // use `->pluck('category_id')` if matching by ID
            ->unique()
            ->toArray();

        // Check if the user wants to filter by preferred jobs only
        $filterPreferred = $request->query('preferred_only', false);

        $noExpertiseCategories = false;

        if ($filterPreferred == '1') {
            // Filter by preferred categories only

            if (empty($preferredCategories)) {
                $noExpertiseCategories = true;
            }

            $query->whereIn('category', $preferredCategories);
        }

        // Get filtered job listings with pagination
        $jobListings = $query
            ->with([
                'jobApplications' => function ($q) use ($user) {
                    $q->where('expert_id', $user->id);
                },
                'client'
            ])
            ->latest()
            ->paginate(10);

        // Get job IDs the user has applied to (in one query)
        $appliedJobIds = $user->jobApplications()
            ->whereIn('job_listing_id', $jobListings->pluck('id'))
            ->pluck('job_listing_id')
            ->toArray();

        // Append 'has_applied' to each job listing efficiently using map()
        $jobListings->transform(function ($jobListing) use ($appliedJobIds) {
            $jobListing->has_applied = in_array($jobListing->id, $appliedJobIds);
            return $jobListing;
        });

        return view('expert.job-listings.index', ['jobListings' => $jobListings, "noExpertiseCategories" => $noExpertiseCategories]);
    }


    private function applyJobFilters($query, $request)
    {
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
