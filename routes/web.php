<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/courses', [CourseController::class, 'publicIndex'])->name('courses.catalog');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])
         ->name('lessons.show');
});

Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.public.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses', CourseController::class)->names('admin.courses');
    Route::resource('courses.lessons', LessonController::class)->shallow()->names('admin.courses.lessons');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::resource('courses', CourseController::class)->names('teacher.courses');

    Route::resource('courses.lessons', LessonController::class)->shallow()->names('teacher.courses.lessons');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/mark-done', [EnrollmentController::class, 'markAsDone'])->name('lessons.mark.done');
    Route::post('/lessons/{lesson}/mark-not-done', [EnrollmentController::class, 'markAsNotDone'])->name('lessons.mark.not.done');
    Route::get('/courses/{course}/certificate', [CertificateController::class, 'generate'])->name('courses.certificate');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
    Route::get('/certificates/{certificate}/view', [CertificateController::class, 'view'])->name('certificates.view');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('users', UserController::class)->names('admin.users');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    });

    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    });
});

require __DIR__.'/auth.php';
