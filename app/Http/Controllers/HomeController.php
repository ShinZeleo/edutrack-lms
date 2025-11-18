<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = \App\Models\Course::with(['teacher', 'category'])
                      ->where('is_active', true)
                      ->withCount('students');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $courses = $query->orderByDesc('students_count')->limit(5)->get();
        $categories = \App\Models\Category::where('is_active', true)->get();

        return view('home', compact('courses', 'categories'));
    }
}
