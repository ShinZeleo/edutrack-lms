<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses()
            ->with(['teacher', 'category'])
            ->get()
            ->map(function ($course) use ($user) {
                $course->progress_percent = $course->getProgressForUser($user);
                return $course;
            });
        return view('profile.student', compact('user', 'enrolledCourses'));
    }
}
