<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $courses = \App\Models\Course::with(['category', 'teacher'])->latest()->paginate(10);
            $categories = \App\Models\Category::all();
            $teachers = \App\Models\User::where('role', 'teacher')->get();
            return view('courses.admin.index', compact('courses', 'categories', 'teachers'));
        } elseif ($user->isTeacher()) {
            $courses = \App\Models\Course::where('teacher_id', $user->id)
                            ->with(['category', 'teacher'])
                            ->latest()
                            ->paginate(10);
            return view('courses.teacher.index', compact('courses'));
        } else {
            abort(403);
        }
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $categories = \App\Models\Category::all();
            $teachers = \App\Models\User::where('role', 'teacher')->get();
            return view('courses.admin.create', compact('categories', 'teachers'));
        } elseif ($user->isTeacher()) {
            $categories = \App\Models\Category::all();
            return view('courses.teacher.create', compact('categories'));
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        $teacherId = $user->isAdmin() ? $request->input('teacher_id') : $user->id;

        \App\Models\Course::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'is_active' => $request->has('is_active'),
            'category_id' => $request->input('category_id'),
            'teacher_id' => $teacherId,
        ]);

        if ($user->isAdmin()) {
            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
        } else {
            return redirect()->route('teacher.courses.index')->with('success', 'Course created successfully.');
        }
    }

    public function edit(\App\Models\Course $course)
    {
        $user = Auth::user();

        if ($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id)) {
            if ($user->isAdmin()) {
                $categories = \App\Models\Category::all();
                $teachers = \App\Models\User::where('role', 'teacher')->get();
                return view('courses.admin.edit', compact('course', 'categories', 'teachers'));
            } elseif ($user->isTeacher()) {
                $categories = \App\Models\Category::all();
                return view('courses.teacher.edit', compact('course', 'categories'));
            }
        } else {
            abort(403);
        }
    }

    public function update(Request $request, \App\Models\Course $course)
    {
        $user = Auth::user();

        if (!($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id))) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        $course->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'is_active' => $request->has('is_active'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($user->isAdmin()) {
            $course->update([
                'teacher_id' => $request->input('teacher_id'),
            ]);
        }

        if ($user->isAdmin()) {
            return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
        } else {
            return redirect()->route('teacher.courses.index')->with('success', 'Course updated successfully.');
        }
    }

    public function destroy(Course $course)
    {
        $user = Auth::user();

        if (!($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id))) {
            abort(403);
        }

        $course->delete();

        if ($user->isAdmin()) {
            return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->route('teacher.courses.index')->with('success', 'Course deleted successfully.');
        }
    }

    public function publicIndex(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = \App\Models\Course::with(['teacher', 'category', 'students'])
                      ->where('is_active', true)
                      ->withCount(['students', 'lessons']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $user = Auth::user();
        if ($user && $user->isStudent()) {
            $progressSub = DB::table('lesson_progress')
                ->join('lessons', 'lesson_progress.lesson_id', '=', 'lessons.id')
                ->selectRaw('COALESCE(AVG(lesson_progress.is_done), 0)')
                ->where('lesson_progress.student_id', $user->id)
                ->whereColumn('lessons.course_id', 'courses.id');

            $query->addSelect(['student_progress' => $progressSub]);
        }

        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderByDesc('students_count');
                break;
            case 'progress':
                if ($user && $user->isStudent()) {
                    $query->orderByDesc('student_progress');
                } else {
                    $query->orderByDesc('lessons_count');
                }
                break;
            default:
                $query->latest();
        }

        $courses = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::where('is_active', true)->get();

        return view('courses.catalog', compact('courses', 'categories', 'sort'));
    }

    public function show(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $user = Auth::user();

        $course->load([
            'category',
            'teacher',
            'students',
            'lessons' => function ($query) use ($user) {
                $query->ordered();

                if ($user && $user->isStudent()) {
                    $query->with(['progress' => function ($progressQuery) use ($user) {
                        $progressQuery->where('student_id', $user->id);
                    }]);
                }
            },
        ])->loadCount('students');

        $isEnrolled = false;
        $studentProgress = null;

        if ($user && $user->isStudent()) {
            $isEnrolled = $course->students->contains($user);
            if ($isEnrolled) {
                $studentProgress = $course->getProgressForUser($user);
            }
        }

        return view('courses.public.show', compact('course', 'isEnrolled', 'studentProgress'));
    }
}