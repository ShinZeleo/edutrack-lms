<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalUsers' => \App\Models\User::count(),
            'totalCourses' => \App\Models\Course::count(),
            'totalCategories' => \App\Models\Category::count(),
            'totalEnrollments' => \Illuminate\Support\Facades\DB::table('course_student')->count(),
        ];

        $recentUsers = \App\Models\User::latest()->take(5)->get();
        $recentCourses = \App\Models\Course::with(['teacher', 'category'])->withCount('students')->latest()->take(5)->get();
        $categories = \App\Models\Category::latest()->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentCourses', 'categories'));
    }
}
