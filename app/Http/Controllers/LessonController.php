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
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson created successfully.');
    }

    public function show(Course $course, Lesson $lesson)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // The route middleware already checks for enrollment, but an explicit check is good practice.
        $isEnrolled = $course->students()->where('users.id', $user->id)->exists();
        if (!$isEnrolled) {
            return redirect()->route('courses.public.show', $course)
                             ->with('error', 'You must be enrolled to view this lesson.');
        }

        // Eager load all lessons for the course and their progress for the current user to prevent N+1 issues.
        $course->load(['lessons' => function ($query) use ($user) {
            $query->ordered()->with(['progress' => function ($progressQuery) use ($user) {
                $progressQuery->where('student_id', $user->id);
            }]);
        }]);

        $lessons = $course->lessons;
        $currentLessonIndex = $lessons->search(fn($item) => $item->id === $lesson->id);
        $nextLesson = $lessons->get($currentLessonIndex + 1);
        $prevLesson = $lessons->get($currentLessonIndex - 1);

        // Get progress for the current lesson from the already loaded relationship.
        $progress = $lesson->progress->first();
        $isDone = $progress && $progress->is_done;

        $courseProgress = $course->getProgressForUser($user);

        return view('lessons.show', compact('course', 'lesson', 'lessons', 'nextLesson', 'prevLesson', 'isDone', 'courseProgress'));
    }

    public function edit(Lesson $lesson)
    {
        // Eager load course to avoid extra query
        $lesson->load('course');
        $course = $lesson->course;

        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        return view('lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        // Eager load course to avoid extra query
        $lesson->load('course');
        $course = $lesson->course;

        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        $lesson->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        // Eager load course to avoid extra query
        $lesson->load('course');
        $course = $lesson->course;

        // Ensure teacher owns the course
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this lesson.');
        }

        $lesson->delete();

        return redirect()->route('teacher.courses.lessons.index', $course)
                         ->with('success', 'Lesson deleted successfully.');
    }
}
