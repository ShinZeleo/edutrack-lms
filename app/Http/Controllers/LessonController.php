<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $routePrefix = $this->authorizeCourseAccess($course);

        $lessons = $course->lessons()->ordered()->get();
        return view('lessons.index', compact('course', 'lessons', 'routePrefix'));
    }

    public function create(Course $course)
    {
        $routePrefix = $this->authorizeCourseAccess($course);

        return view('lessons.create', compact('course', 'routePrefix'));
    }

    public function store(LessonStoreRequest $request, Course $course)
    {
        $routePrefix = $this->authorizeCourseAccess($course);

        $course->lessons()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route("{$routePrefix}.courses.lessons.index", $course)
                         ->with('success', 'Lesson created successfully.');
    }

    public function show(Course $course, Lesson $lesson)
    {
        $user = Auth::user();

        $isEnrolled = $course->students()->where('users.id', $user->id)->exists();
        if (!$isEnrolled) {
            return redirect()->route('courses.public.show', $course)
                             ->with('error', 'You must be enrolled to view this lesson.');
        }

        $lesson->load(['progress' => function ($progressQuery) use ($user) {
            $progressQuery->where('student_id', $user->id);
        }]);

        $course->load(['lessons' => function ($query) use ($user) {
            $query->ordered()->with(['progress' => function ($progressQuery) use ($user) {
                $progressQuery->where('student_id', $user->id);
            }]);
        }]);

        $lessons = $course->lessons;
        $currentLessonIndex = $lessons->search(fn($item) => $item->id === $lesson->id);
        $nextLesson = $lessons->get($currentLessonIndex + 1);
        $prevLesson = $lessons->get($currentLessonIndex - 1);

        $progress = $lesson->progress->first();
        $isDone = $progress && $progress->is_done;

        $courseProgress = $course->getProgressForUser($user);

        return view('lessons.show', compact('course', 'lesson', 'lessons', 'nextLesson', 'prevLesson', 'isDone', 'courseProgress'));
    }

    public function edit(Lesson $lesson)
    {
        $lesson->load('course');
        $course = $lesson->course;

        $routePrefix = $this->authorizeCourseAccess($course);

        return view('lessons.edit', compact('course', 'lesson', 'routePrefix'));
    }

    public function update(LessonUpdateRequest $request, Lesson $lesson)
    {
        $lesson->load('course');
        $course = $lesson->course;

        $routePrefix = $this->authorizeCourseAccess($course);

        $lesson->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route("{$routePrefix}.courses.lessons.index", $course)
                         ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->load('course');
        $course = $lesson->course;

        $routePrefix = $this->authorizeCourseAccess($course);

        $lesson->delete();

        return redirect()->route("{$routePrefix}.courses.lessons.index", $course)
                         ->with('success', 'Lesson deleted successfully.');
    }

    private function authorizeCourseAccess(Course $course): string
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return 'admin';
        }

        if ($user->isTeacher() && (string) $course->teacher_id === (string) $user->id) {
            return 'teacher';
        }

        abort(403, 'Unauthorized access to this course.');
    }
}
