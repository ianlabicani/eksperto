<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ExpertiseCategory;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    public function index(Request $request)
    {

        $expertiseCategories = ExpertiseCategory::orderBy('name')->get();

        $user = $request->user()->load([
            'expertises' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ]);

        $expertises = $user->expertises;

        return view('expert.profile.expertise.index', [
            "user" => $user,
            "expertises" => $expertises,
            "expertiseCategories" => $expertiseCategories,
        ]);
    }

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
}
