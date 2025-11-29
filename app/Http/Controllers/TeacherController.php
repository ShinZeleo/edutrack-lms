<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $courses = \App\Models\Course::where('teacher_id', Auth::id())
            ->with(['category', 'teacher'])
            ->withCount('students')
            ->latest()
            ->paginate(12);

        return view('teacher.dashboard', compact('courses'));
    }
}
