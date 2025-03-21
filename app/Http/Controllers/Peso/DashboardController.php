<?php

namespace App\Http\Controllers\Peso;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Jobs
        $totalJobListings = JobListing::count();
        $totalActiveJobs = JobListing::where('status', 'open')->count();
        $totalClosedJobs = JobListing::where('status', 'closed')->count();
        $jobsToday = JobListing::whereDate('created_at', today())->count();

        // Job Trends
        $jobsThisWeek = JobListing::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $jobsThisMonth = JobListing::whereMonth('created_at', Carbon::now()->month)->count();

        // Job Listings by Category
        $jobsByCategory = JobListing::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // Most Popular Job Listings (by applications)
        $popularJobs = JobListing::withCount('jobApplications')
            ->orderByDesc('job_applications_count')
            ->take(5)
            ->get();

        // Total Applications
        $totalApplications = JobApplication::count();
        $applicationsToday = JobApplication::whereDate('created_at', today())->count();
        $applicationsThisMonth = JobApplication::whereMonth('created_at', Carbon::now()->month)->count();

        // Active Employers
        $totalEmployers = User::whereHas('jobListings')->count();

        // Unique Applicants This Month
        $uniqueApplicantsThisMonth = JobApplication::whereMonth('created_at', Carbon::now()->month)
            ->distinct('expert_id')
            ->count();

        return view('peso.dashboard', compact(
            'totalJobListings',
            'totalActiveJobs',
            'totalClosedJobs',
            'jobsToday',
            'jobsThisWeek',
            'jobsThisMonth',
            'jobsByCategory',
            'popularJobs',
            'totalApplications',
            'applicationsToday',
            'applicationsThisMonth',
            'totalEmployers',
            'uniqueApplicantsThisMonth'
        ));
    }
}
