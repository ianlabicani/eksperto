<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\EducationalBackground;
use Illuminate\Http\Request;

class EducationalBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $educationalBackgrounds = $request->user()->educationalBackgrounds()->get();
        return view('expert.educational-background.index', compact('educationalBackgrounds'));
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

    /**
     * Display the specified resource.
     */
    public function show(EducationalBackground $educationalBackground)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationalBackground $educationalBackground)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationalBackground $educationalBackground)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationalBackground $educationalBackground)
    {
        //
    }
}
