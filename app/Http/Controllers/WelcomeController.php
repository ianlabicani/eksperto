<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(Request $request): View
    {
        // Fetch job listings from the database
        $jobListings = JobListing::where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();


        return view('welcome', compact('jobListings'));
    }
}
