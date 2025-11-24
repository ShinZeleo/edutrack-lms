<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
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

        if (!$user || !$user->isStudent()) {
            return redirect()->back()->with('error', 'Hanya siswa yang dapat menandai lesson sebagai selesai.');
        }

        if (!$lesson->relationLoaded('course')) {
            $lesson->load('course');
        }

        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            return redirect()->back()->with('error', 'Anda harus terdaftar di kursus ini untuk menandai lesson sebagai selesai.');
        }

        try {
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

            return redirect()->route('lessons.show', [$lesson->course, $lesson])
                            ->with('success', 'Lesson berhasil ditandai sebagai selesai.');
        } catch (\Exception $e) {
            \Log::error('Error marking lesson as done: ' . $e->getMessage());
            return redirect()->route('lessons.show', [$lesson->course, $lesson])
                            ->with('error', 'Terjadi kesalahan saat menandai lesson. Silakan coba lagi.');
        }
    }

    public function markAsNotDone(Lesson $lesson)
    {
        $user = Auth::user();

        if (!$user || !$user->isStudent()) {
            return redirect()->back()->with('error', 'Hanya siswa yang dapat mengubah status lesson.');
        }

        if (!$lesson->relationLoaded('course')) {
            $lesson->load('course');
        }

        $isEnrolled = $lesson->course->students()->where('users.id', $user->id)->exists();

        if (!$isEnrolled) {
            return redirect()->back()->with('error', 'Anda harus terdaftar di kursus ini untuk mengubah status lesson.');
        }

        try {
            $progress = \App\Models\LessonProgress::where('lesson_id', $lesson->id)
                                      ->where('student_id', $user->id)
                                      ->first();

            if ($progress) {
                $progress->update([
                    'is_done' => false,
                    'done_at' => null,
                ]);
            }

            return redirect()->route('lessons.show', [$lesson->course, $lesson])
                            ->with('success', 'Lesson berhasil ditandai sebagai belum selesai.');
        } catch (\Exception $e) {
            \Log::error('Error marking lesson as not done: ' . $e->getMessage());
            return redirect()->route('lessons.show', [$lesson->course, $lesson])
                            ->with('error', 'Terjadi kesalahan saat mengubah status lesson. Silakan coba lagi.');
        }
    }
}