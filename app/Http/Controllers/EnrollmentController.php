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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is a student
        if (!$user->isStudent()) {
            abort(403, 'Only students can enroll in courses.');
        }

        // Check if course is active
        if (!$course->is_active) {
            abort(403, 'Cannot enroll in an inactive course.');
        }

        // Check if already enrolled
        $course->students()->syncWithoutDetaching([$user->id => ['enrolled_at' => now()]]);

        return redirect()->back()->with('success', 'Successfully enrolled in the course.');
    }

    public function markAsDone(Lesson $lesson)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is a student
        if (!$user->isStudent()) {
            abort(403, 'Only students can mark lessons as done.');
        }

        // Check if student is enrolled in the course (avoid N+1 query)
        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            abort(403, 'You must be enrolled in the course to mark lessons as done.');
        }

        // Create or update lesson progress
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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is a student
        if (!$user->isStudent()) {
            abort(403, 'Only students can update lesson progress.');
        }

        // Check if student is enrolled in the course (avoid N+1 query)
        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            abort(403, 'You must be enrolled in the course to update lesson progress.');
        }

        // Update lesson progress
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