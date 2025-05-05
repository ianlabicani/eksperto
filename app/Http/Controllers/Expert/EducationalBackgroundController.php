<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationalBackgroundController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user()->load([
            'educationalBackgrounds' => function ($query) {
                $query->orderBy('year', 'desc');
            }
        ]);

        $educations = $user->educationalBackgrounds()->orderBy('year', 'desc')->get();

        return view('expert.profile.educational-background.index', [
            "user" => $user,
            "educations" => $educations,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $educationalBackground = $user->educationalBackgrounds()->create([
            'level' => $request->input('level'),
            'university' => $request->input('university'),
            'course' => $request->input('course'),
            'year' => $request->input('year'),
            'award' => $request->input('award'),
        ]);
        return redirect()->route('expert.educational-background.index')->with('success', 'Educational background added successfully.');
    }
}
