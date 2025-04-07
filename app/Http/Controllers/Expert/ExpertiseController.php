<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use App\Models\ExpertiseCategory;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $expertiseCategories = ExpertiseCategory::orderBy('name')->get();
        $experties = $expertises = $request->user()->expertises;


        return view('expert.expertise.index', compact('expertiseCategories', 'expertises'));
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

        $request->validate([
            'expertise_category_id' => 'required|exists:expertise_categories,id',
            'description' => 'nullable|string|max:1000',
            'level' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
        ]);

        $category = ExpertiseCategory::find($request->expertise_category_id);

        $expertise = $user->expertises()->create([
            'expertise_category_id' => $category->id,
            'name' => $category->name, // Auto-fill name from category
            'description' => $request->description,
            'level' => $request->level,
            'years_of_experience' => $request->years_of_experience,
        ]);

        return redirect()->route('expert.expertise.index')->with('success', 'Expertise created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expertise $expertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expertise $expertise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expertise $expertise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expertise $expertise)
    {
        //
    }
}
