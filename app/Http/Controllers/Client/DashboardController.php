<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\JobContract;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Count active job listings
        $activeJobsCount = JobListing::where('client_id', $user->id)
            ->where('status', 'open')
            ->count();

        // Count all applications
        $applicationsCount = JobApplication::whereHas('jobListing', function ($query) use ($user) {
            $query->where('client_id', $user->id);
        })->count();

        // Count active contracts
        $activeContractsCount = JobContract::where('client_id', $user->id)
            ->where('status', 'active')
            ->count();

        // Count completed contracts (which may need review)
        // Removed the client_review check since that column doesn't exist
        $pendingReviewsCount = JobContract::where('client_id', $user->id)
            ->where('status', 'completed')
            ->count();

        return view('client.dashboard.index', compact(
            'activeJobsCount',
            'applicationsCount',
            'activeContractsCount',
            'pendingReviewsCount'
        ));
    }
}
