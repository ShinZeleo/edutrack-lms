<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalUsers' => \App\Models\User::count(),
            'totalCourses' => \App\Models\Course::count(),
            'totalCategories' => \App\Models\Category::count(),
        ];

        $recentUsers = \App\Models\User::latest()->take(5)->get();
        $recentCourses = \App\Models\Course::with(['teacher', 'category'])->withCount('students')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentCourses'));
    }

    public function users()
    {
        return view('admin.users');
    }
}
