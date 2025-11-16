<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public course routes (guest/student access)
Route::get('/courses', [CourseController::class, 'publicIndex'])->name('courses.public.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.public.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin course management routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses', CourseController::class);
});

// Teacher course management routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::resource('courses', CourseController::class);

    // Teacher lesson management routes (nested under courses)
    Route::resource('courses.lessons', LessonController::class)->shallow();
});

// Enrollment and progress routes for students
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/mark-done', [EnrollmentController::class, 'markAsDone'])->name('lessons.mark.done');
    Route::post('/lessons/{lesson}/mark-not-done', [EnrollmentController::class, 'markAsNotDone'])->name('lessons.mark.not.done');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        // other admin routes
    });

    // Categories routes - Admin only
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Teacher routes (non-course related)
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        // other teacher routes
    });

    // Student routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
        // other student routes
    });
});

require __DIR__.'/auth.php';
