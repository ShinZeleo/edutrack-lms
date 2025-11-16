<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this course.');
        }

        $lessons = $course->lessons()->ordered()->get();
        return view('lessons.index', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this course.');
        }

        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this course.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        $course->lessons()->create([
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order,
        ]);

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson created successfully.');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        // Ensure teacher owns the course and lesson belongs to the course
        if ($course->teacher_id !== Auth::id() || $lesson->course_id !== $course->id) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        return view('lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        // Ensure teacher owns the course and lesson belongs to the course
        if ($course->teacher_id !== Auth::id() || $lesson->course_id !== $course->id) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        $lesson->update([
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order,
        ]);

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        // Ensure teacher owns the course and lesson belongs to the course
        if ($course->teacher_id !== Auth::id() || $lesson->course_id !== $course->id) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        $lesson->delete();

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson deleted successfully.');
    }
}
