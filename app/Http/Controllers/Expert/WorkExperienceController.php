<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load([
            'workExperiences' => function ($query) {
                $query->orderBy('end_date', 'desc');
            }
        ]);

        $workExperiences = $user->workExperiences;

        return view('expert.profile.work-experience.index', [
            "user" => $user,
            "workExperiences" => $workExperiences,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string|max:1000',
        ]);

        $user = $request->user();

        $workExperience = $user->workExperiences()->create([
            'company_name' => $request->input('company_name'),
            'job_title' => $request->input('job_title'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('expert.work-experience.index')->with('success', 'Work experience added successfully.');
    }
}
