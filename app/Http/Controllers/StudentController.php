<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->courses()->with('teacher')->get();
        return view('profile.student', compact('user', 'enrolledCourses'));
    }

    public function courses()
    {
        return view('student.courses');
    }
}
