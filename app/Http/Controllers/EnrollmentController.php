<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        $user = Auth::user();

        if (!$user->isStudent()) {
            abort(403, 'Only students can enroll in courses.');
        }

        if (!$course->is_active) {
            abort(403, 'Cannot enroll in an inactive course.');
        }

        $course->students()->syncWithoutDetaching([$user->id => ['enrolled_at' => now()]]);

        return redirect()->back()->with('success', 'Successfully enrolled in the course.');
    }

    public function markAsDone(Lesson $lesson)
    {
        $user = Auth::user();

        if (!$user->isStudent()) {
            abort(403, 'Only students can mark lessons as done.');
        }

        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            abort(403, 'You must be enrolled in the course to mark lessons as done.');
        }

        \App\Models\LessonProgress::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'student_id' => $user->id,
            ],
            [
                'is_done' => true,
                'done_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Lesson marked as done.');
    }

    public function markAsNotDone(Lesson $lesson)
    {
        $user = Auth::user();

        if (!$user->isStudent()) {
            abort(403, 'Only students can update lesson progress.');
        }

        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            abort(403, 'You must be enrolled in the course to update lesson progress.');
        }

        $progress = \App\Models\LessonProgress::where('lesson_id', $lesson->id)
                                  ->where('student_id', $user->id)
                                  ->first();

        if ($progress) {
            $progress->update([
                'is_done' => false,
                'done_at' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Lesson marked as not done.');
    }
}