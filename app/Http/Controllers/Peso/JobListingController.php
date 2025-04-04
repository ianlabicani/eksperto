<?php

namespace App\Http\Controllers\Peso;

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

        // Get filtered job listings with pagination
        $jobListings = $query->latest()->paginate(10);

        return view('peso.job-listings.index', compact('jobListings'));
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
