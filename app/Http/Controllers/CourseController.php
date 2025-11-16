<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $courses = Course::with(['category', 'teacher'])->latest()->paginate(10);
            $categories = Category::all();
            $teachers = User::where('role', 'teacher')->get();
            return view('courses.admin.index', compact('courses', 'categories', 'teachers'));
        } elseif ($user->isTeacher()) {
            $courses = Course::where('teacher_id', $user->id)
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
            $categories = Category::all();
            $teachers = User::where('role', 'teacher')->get();
            return view('courses.admin.create', compact('categories', 'teachers'));
        } elseif ($user->isTeacher()) {
            $categories = Category::all();
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

        // For teacher, automatically assign their own ID as teacher_id
        // For admin, allow selection of teacher
        $teacherId = $user->isAdmin() ? $request->teacher_id : $user->id;

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,
            'teacher_id' => $teacherId,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $user = Auth::user();

        // Check if user is authorized to edit this course
        if ($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id)) {
            if ($user->isAdmin()) {
                $categories = Category::all();
                $teachers = User::where('role', 'teacher')->get();
                return view('courses.admin.edit', compact('course', 'categories', 'teachers'));
            } elseif ($user->isTeacher()) {
                $categories = Category::all();
                return view('courses.teacher.edit', compact('course', 'categories'));
            }
        } else {
            abort(403);
        }
    }

    public function update(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check if user is authorized to update this course
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
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,
        ]);

        // Only admin can change the teacher
        if ($user->isAdmin()) {
            $course->update([
                'teacher_id' => $request->teacher_id,
            ]);
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $user = Auth::user();

        // Check if user is authorized to delete this course
        if (!($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id))) {
            abort(403);
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    // Public method for guests and students to view courses
    public function publicIndex()
    {
        $courses = Course::where('is_active', true)
                        ->with(['category', 'teacher'])
                        ->latest()
                        ->paginate(10);
        $categories = Category::where('is_active', true)->get();
        return view('courses.public.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        // Check if course is active
        if (!$course->is_active) {
            abort(404);
        }

        $course->load(['category', 'teacher']);
        return view('courses.public.show', compact('course'));
    }
}
