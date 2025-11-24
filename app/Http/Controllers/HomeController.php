<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = Course::with(['teacher', 'category', 'students'])
                      ->where('is_active', true)
                      ->withCount('students');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $courses = $query->orderByDesc('students_count')->limit(5)->get();
        $categories = Category::where('is_active', true)->get();

        $stats = [
            'activeCourses' => Course::where('is_active', true)->count(),
            'activeCategories' => Category::where('is_active', true)->count(),
            'activeTeachers' => User::role('teacher')->active()->count(),
            'activeStudents' => User::role('student')->active()->count(),
        ];

        if (auth()->check() && auth()->user()->isStudent()) {
            $user = auth()->user();
            foreach($courses as $course) {
                $course->progress = $course->getProgressForUser($user);
                $course->isEnrolled = $course->students->contains($user);
            }
        }

        return view('home', compact('courses', 'categories', 'stats'));
    }

    public function about()
    {
        return view('about');
    }
}
