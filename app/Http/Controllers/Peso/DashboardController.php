<?php

namespace App\Http\Controllers\Peso;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalJobListings = JobListing::count();
        $totalActiveJobs = JobListing::where('status', 'open')->count();
        $jobsToday = JobListing::whereDate('created_at', today())->count();


        return view('peso.dashboard', compact('totalJobListings', 'totalActiveJobs', 'jobsToday'));
    }
}
