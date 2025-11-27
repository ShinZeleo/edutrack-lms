# Models Documentation

## Overview
Models di EduTrack LMS menggunakan Eloquent ORM untuk berinteraksi dengan database. Semua models berada di `app/Models/` dan mengikuti konvensi Laravel.

**Karakteristik Models:**
- Menggunakan `HasFactory` trait untuk factory support
- Menggunakan `$fillable` untuk mass assignment protection
- Menggunakan `$casts` untuk type casting
- Menggunakan Eloquent relationships untuk data relationships
- Menggunakan scopes untuk query filtering
- Menggunakan accessors dan mutators untuk data transformation

---

## Model List

### 1. User Model
**File:** `app/Models/User.php`

**Table:** `users`

**Extends:** `Illuminate\Foundation\Auth\User` (Authenticatable)

**Traits:**
- `HasFactory` - Factory support
- `Notifiable` - Notification support

#### Fillable Fields
```php
protected $fillable = [
    'name',           // Nama lengkap user
    'username',       // Username unik (nullable)
    'email',          // Email unik
    'password',       // Password (hashed)
    'role',           // Role: 'admin', 'teacher', atau 'student'
    'is_active',      // Status aktif (boolean)
];
```

#### Hidden Fields
```php
protected $hidden = [
    'password',        // Password tidak ditampilkan di JSON
    'remember_token', // Remember token tidak ditampilkan
];
```

#### Casts
```php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',  // Auto-cast ke Carbon instance
        'password' => 'hashed',            // Auto-hash saat set
        'is_active' => 'boolean',          // Auto-cast ke boolean
    ];
}
```

#### Relationships

##### `courses()`
**Type:** `hasMany`

**Related Model:** `Course`

**Foreign Key:** `teacher_id` di table `courses`

**Usage:**
```php
$teacher = User::find(1);
$teacherCourses = $teacher->courses; // Collection of Course models
```

**Description:**
Mengembalikan semua courses yang dibuat oleh user (jika user adalah teacher).

**Example:**
```php
$teacher = User::where('role', 'teacher')->first();
$courses = $teacher->courses()->with('category')->get();
```

---

##### `enrolledCourses()`
**Type:** `belongsToMany` (Many-to-Many)

**Related Model:** `Course`

**Pivot Table:** `course_student`

**Foreign Keys:**
- `student_id` → `users.id`
- `course_id` → `courses.id`

**Pivot Columns:**
- `enrolled_at` - Timestamp saat enrollment

**Usage:**
```php
$student = User::find(2);
$enrolledCourses = $student->enrolledCourses; // Collection of Course models
```

**With Pivot Data:**
```php
$student->enrolledCourses()->withPivot('enrolled_at')->get();
// Setiap course akan memiliki pivot data: enrolled_at
```

**Example:**
```php
$student = auth()->user();
$enrolledCourses = $student->enrolledCourses()
    ->with(['teacher', 'category'])
    ->get();
```

---

##### `lessonProgress()`
**Type:** `hasMany`

**Related Model:** `LessonProgress`

**Foreign Key:** `student_id` di table `lesson_progress`

**Usage:**
```php
$student = User::find(2);
$progress = $student->lessonProgress; // Collection of LessonProgress models
```

**Example:**
```php
$student = auth()->user();
$completedLessons = $student->lessonProgress()
    ->where('is_done', true)
    ->with('lesson')
    ->get();
```

---

##### `certificates()`
**Type:** `hasMany`

**Related Model:** `Certificate`

**Foreign Key:** `student_id` di table `certificates`

**Usage:**
```php
$student = User::find(2);
$certificates = $student->certificates; // Collection of Certificate models
```

**Example:**
```php
$student = auth()->user();
$certificates = $student->certificates()
    ->with('course')
    ->latest('issued_at')
    ->get();
```

---

#### Scopes

##### `scopeActive($query)`
**Fungsi:** Filter user yang aktif (`is_active = true`)

**Usage:**
```php
$activeUsers = User::active()->get();
```

**Example:**
```php
$activeTeachers = User::role('teacher')->active()->get();
```

---

##### `scopeRole($query, $role)`
**Fungsi:** Filter user berdasarkan role

**Parameters:**
- `$role` - Role yang dicari: 'admin', 'teacher', atau 'student'

**Usage:**
```php
$teachers = User::role('teacher')->get();
```

**Example:**
```php
$activeStudents = User::role('student')->active()->count();
```

---

#### Methods

##### `isAdmin(): bool`
**Fungsi:** Cek apakah user adalah admin

**Returns:** `true` jika role adalah 'admin', `false` jika tidak

**Usage:**
```php
if ($user->isAdmin()) {
    // Admin logic
}
```

---

##### `isTeacher(): bool`
**Fungsi:** Cek apakah user adalah teacher

**Returns:** `true` jika role adalah 'teacher', `false` jika tidak

**Usage:**
```php
if ($user->isTeacher()) {
    // Teacher logic
}
```

---

##### `isStudent(): bool`
**Fungsi:** Cek apakah user adalah student

**Returns:** `true` jika role adalah 'student', `false` jika tidak

**Usage:**
```php
if ($user->isStudent()) {
    // Student logic
}
```

---

##### `getRoleLabelAttribute()`
**Type:** Accessor

**Fungsi:** Get role label dengan format capitalized

**Usage:**
```php
$user->role_label; // "Admin", "Teacher", atau "Student"
```

**Example:**
```php
// Di view
{{ $user->role_label }} // Output: "Admin"
```

---

#### Example Usage

**Create User:**
```php
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'password123',
    'role' => 'student',
    'is_active' => true,
]);
```

**Get Teacher with Courses:**
```php
$teacher = User::where('role', 'teacher')
    ->with('courses.category')
    ->first();
```

**Get Student with Enrolled Courses and Progress:**
```php
$student = User::find(2);
$enrolledCourses = $student->enrolledCourses()
    ->with(['teacher', 'category'])
    ->get()
    ->map(function ($course) use ($student) {
        $course->progress = $course->getProgressForUser($student);
        return $course;
    });
```

---

### 2. Category Model
**File:** `app/Models/Category.php`

**Table:** `categories`

**Traits:**
- `HasFactory`

#### Fillable Fields
```php
protected $fillable = [
    'name',           // Nama kategori
    'description',    // Deskripsi kategori (nullable)
    'is_active',      // Status aktif (boolean)
];
```

#### Casts
```php
protected $casts = [
    'is_active' => 'boolean',
];
```

#### Relationships

##### `courses()`
**Type:** `hasMany`

**Related Model:** `Course`

**Foreign Key:** `category_id` di table `courses`

**Usage:**
```php
$category = Category::find(1);
$courses = $category->courses; // Collection of Course models
```

**Example:**
```php
$category = Category::find(1);
$activeCourses = $category->courses()
    ->where('is_active', true)
    ->with('teacher')
    ->get();
```

---

#### Scopes

##### `scopeActive($query)`
**Fungsi:** Filter categories yang aktif

**Usage:**
```php
$activeCategories = Category::active()->get();
```

**Example:**
```php
$categories = Category::active()
    ->withCount('courses')
    ->get();
```

---

#### Example Usage

**Create Category:**
```php
$category = Category::create([
    'name' => 'Web Development',
    'description' => 'Courses about web development',
    'is_active' => true,
]);
```

**Get Category with Courses:**
```php
$category = Category::with('courses.teacher')->find(1);
```

---

### 3. Course Model
**File:** `app/Models/Course.php`

**Table:** `courses`

**Traits:**
- `HasFactory`

#### Fillable Fields
```php
protected $fillable = [
    'name',           // Nama course
    'description',    // Deskripsi course (nullable)
    'start_date',     // Tanggal mulai (date)
    'end_date',       // Tanggal selesai (date)
    'is_active',      // Status aktif (boolean)
    'category_id',    // Foreign key ke categories
    'teacher_id',     // Foreign key ke users (teacher)
];
```

#### Casts
```php
protected $casts = [
    'start_date' => 'date',    // Auto-cast ke Carbon date
    'end_date' => 'date',      // Auto-cast ke Carbon date
    'is_active' => 'boolean',   // Auto-cast ke boolean
];
```

#### Relationships

##### `category()`
**Type:** `belongsTo`

**Related Model:** `Category`

**Foreign Key:** `category_id`

**Usage:**
```php
$course = Course::find(1);
$category = $course->category; // Category model
```

---

##### `teacher()`
**Type:** `belongsTo`

**Related Model:** `User`

**Foreign Key:** `teacher_id`

**Usage:**
```php
$course = Course::find(1);
$teacher = $course->teacher; // User model (teacher)
```

---

##### `students()`
**Type:** `belongsToMany` (Many-to-Many)

**Related Model:** `User`

**Pivot Table:** `course_student`

**Foreign Keys:**
- `course_id` → `courses.id`
- `student_id` → `users.id`

**Pivot Columns:**
- `enrolled_at` - Timestamp saat enrollment

**Usage:**
```php
$course = Course::find(1);
$students = $course->students; // Collection of User models (students)
```

**With Pivot Data:**
```php
$course->students()->withPivot('enrolled_at')->get();
```

**Example:**
```php
$course = Course::find(1);
$enrolledStudents = $course->students()
    ->where('is_active', true)
    ->get();
```

---

##### `lessons()`
**Type:** `hasMany`

**Related Model:** `Lesson`

**Foreign Key:** `course_id` di table `lessons`

**Usage:**
```php
$course = Course::find(1);
$lessons = $course->lessons; // Collection of Lesson models
```

**Ordered:**
```php
$lessons = $course->lessons()->ordered()->get();
```

---

##### `certificates()`
**Type:** `hasMany`

**Related Model:** `Certificate`

**Foreign Key:** `course_id` di table `certificates`

**Usage:**
```php
$course = Course::find(1);
$certificates = $course->certificates; // Collection of Certificate models
```

---

#### Scopes

##### `scopeActive($query)`
**Fungsi:** Filter courses yang aktif

**Usage:**
```php
$activeCourses = Course::active()->get();
```

---

##### `scopeByCategory($query, $categoryId)`
**Fungsi:** Filter courses berdasarkan category

**Parameters:**
- `$categoryId` - ID category

**Usage:**
```php
$courses = Course::byCategory(1)->get();
```

---

#### Methods

##### `getProgressForUser($user): float`
**Fungsi:** Hitung progress course untuk user tertentu

**Parameters:**
- `$user` - User model (student)

**Returns:** Progress percentage (0-100)

**Alur Kerja:**
1. Hitung total lessons dalam course
2. Jika tidak ada lessons, return 0
3. Hitung lessons yang sudah selesai (is_done = true) untuk user
4. Hitung percentage: (done lessons / total lessons) * 100
5. Return rounded percentage (2 decimal places)

**Usage:**
```php
$course = Course::find(1);
$student = User::find(2);
$progress = $course->getProgressForUser($student); // 75.50
```

**Example:**
```php
$student = auth()->user();
$enrolledCourses = $student->enrolledCourses()
    ->get()
    ->map(function ($course) use ($student) {
        $course->progress = $course->getProgressForUser($student);
        return $course;
    });
```

---

#### Example Usage

**Create Course:**
```php
$course = Course::create([
    'name' => 'Laravel Fundamentals',
    'description' => 'Learn Laravel from scratch',
    'start_date' => '2025-01-01',
    'end_date' => '2025-12-31',
    'is_active' => true,
    'category_id' => 1,
    'teacher_id' => 2,
]);
```

**Get Course with All Relationships:**
```php
$course = Course::with([
    'category',
    'teacher',
    'students',
    'lessons',
    'certificates'
])->find(1);
```

**Get Active Courses with Student Count:**
```php
$courses = Course::active()
    ->withCount('students')
    ->orderByDesc('students_count')
    ->get();
```

---

### 4. Lesson Model
**File:** `app/Models/Lesson.php`

**Table:** `lessons`

**Traits:**
- `HasFactory`

#### Fillable Fields
```php
protected $fillable = [
    'course_id',      // Foreign key ke courses
    'title',          // Judul lesson
    'content',        // Konten lesson (text/html)
    'order',          // Urutan lesson (integer)
];
```

#### Relationships

##### `course()`
**Type:** `belongsTo`

**Related Model:** `Course`

**Foreign Key:** `course_id`

**Usage:**
```php
$lesson = Lesson::find(1);
$course = $lesson->course; // Course model
```

---

##### `progress()`
**Type:** `hasMany`

**Related Model:** `LessonProgress`

**Foreign Key:** `lesson_id` di table `lesson_progress`

**Usage:**
```php
$lesson = Lesson::find(1);
$progress = $lesson->progress; // Collection of LessonProgress models
```

**For Specific Student:**
```php
$lesson->load(['progress' => function ($query) use ($user) {
    $query->where('student_id', $user->id);
}]);
```

---

#### Scopes

##### `scopeOrdered($query)`
**Fungsi:** Order lessons berdasarkan `order` field (ascending)

**Usage:**
```php
$lessons = Lesson::ordered()->get();
```

**Example:**
```php
$course = Course::find(1);
$lessons = $course->lessons()->ordered()->get();
```

---

#### Example Usage

**Create Lesson:**
```php
$course = Course::find(1);
$lesson = $course->lessons()->create([
    'title' => 'Introduction to Laravel',
    'content' => '<p>Laravel is a PHP framework...</p>',
    'order' => 1,
]);
```

**Get Lesson with Progress:**
```php
$lesson = Lesson::with(['course', 'progress.student'])->find(1);
```

**Get Next/Previous Lesson:**
```php
$course = Course::find(1);
$lessons = $course->lessons()->ordered()->get();
$currentIndex = $lessons->search(fn($item) => $item->id === $lesson->id);
$nextLesson = $lessons->get($currentIndex + 1);
$prevLesson = $lessons->get($currentIndex - 1);
```

---

### 5. LessonProgress Model
**File:** `app/Models/LessonProgress.php`

**Table:** `lesson_progress`

**Traits:**
- `HasFactory`

#### Fillable Fields
```php
protected $fillable = [
    'lesson_id',      // Foreign key ke lessons
    'student_id',     // Foreign key ke users (student)
    'is_done',        // Status selesai (boolean)
    'done_at',        // Timestamp saat selesai (nullable)
];
```

#### Casts
```php
protected $casts = [
    'is_done' => 'boolean',      // Auto-cast ke boolean
    'done_at' => 'datetime',     // Auto-cast ke Carbon datetime
];
```

#### Relationships

##### `lesson()`
**Type:** `belongsTo`

**Related Model:** `Lesson`

**Foreign Key:** `lesson_id`

**Usage:**
```php
$progress = LessonProgress::find(1);
$lesson = $progress->lesson; // Lesson model
```

---

##### `student()`
**Type:** `belongsTo`

**Related Model:** `User`

**Foreign Key:** `student_id`

**Usage:**
```php
$progress = LessonProgress::find(1);
$student = $progress->student; // User model (student)
```

---

#### Example Usage

**Create/Update Progress:**
```php
LessonProgress::updateOrCreate(
    [
        'lesson_id' => 1,
        'student_id' => 2,
    ],
    [
        'is_done' => true,
        'done_at' => now(),
    ]
);
```

**Get Completed Lessons for Student:**
```php
$student = User::find(2);
$completedLessons = LessonProgress::where('student_id', $student->id)
    ->where('is_done', true)
    ->with('lesson.course')
    ->get();
```

**Check if Lesson is Done:**
```php
$progress = LessonProgress::where('lesson_id', 1)
    ->where('student_id', 2)
    ->first();

$isDone = $progress && $progress->is_done;
```

---

### 6. Certificate Model
**File:** `app/Models/Certificate.php`

**Table:** `certificates`

**Traits:**
- `HasFactory`

#### Fillable Fields
```php
protected $fillable = [
    'student_id',           // Foreign key ke users (student)
    'course_id',            // Foreign key ke courses
    'certificate_number',   // Nomor sertifikat (unique)
    'issued_at',            // Tanggal dikeluarkan (date)
];
```

#### Casts
```php
protected $casts = [
    'issued_at' => 'date',  // Auto-cast ke Carbon date
];
```

#### Relationships

##### `student()`
**Type:** `belongsTo`

**Related Model:** `User`

**Foreign Key:** `student_id`

**Usage:**
```php
$certificate = Certificate::find(1);
$student = $certificate->student; // User model (student)
```

---

##### `course()`
**Type:** `belongsTo`

**Related Model:** `Course`

**Foreign Key:** `course_id`

**Usage:**
```php
$certificate = Certificate::find(1);
$course = $certificate->course; // Course model
```

**With Teacher:**
```php
$certificate->load('course.teacher');
```

---

#### Example Usage

**Create Certificate:**
```php
$certificate = Certificate::firstOrCreate(
    [
        'student_id' => 2,
        'course_id' => 1,
    ],
    [
        'certificate_number' => 'CERT-' . strtoupper(uniqid()),
        'issued_at' => now(),
    ]
);
```

**Get Certificate with All Data:**
```php
$certificate = Certificate::with([
    'student',
    'course',
    'course.teacher'
])->find(1);
```

**Get All Certificates for Student:**
```php
$student = User::find(2);
$certificates = $student->certificates()
    ->with('course.teacher')
    ->latest('issued_at')
    ->get();
```

---

## Relationship Diagram

```
User (Teacher)
  │
  └─── hasMany ───> Course
        │
        ├─── belongsTo ───> Category
        │
        ├─── belongsTo ───> User (Teacher)
        │
        ├─── belongsToMany ───> User (Student) [pivot: course_student]
        │
        ├─── hasMany ───> Lesson
        │      │
        │      └─── hasMany ───> LessonProgress
        │             │
        │             └─── belongsTo ───> User (Student)
        │
        └─── hasMany ───> Certificate
               │
               ├─── belongsTo ───> User (Student)
               │
               └─── belongsTo ───> Course
```

---

## Query Optimization

### Eager Loading
Gunakan `with()` untuk menghindari N+1 query problem:

**❌ Bad:**
```php
$courses = Course::all();
foreach ($courses as $course) {
    echo $course->teacher->name; // N+1 query
}
```

**✅ Good:**
```php
$courses = Course::with('teacher')->get();
foreach ($courses as $course) {
    echo $course->teacher->name; // No additional query
}
```

### Eager Loading Multiple Relationships
```php
$courses = Course::with(['teacher', 'category', 'students'])->get();
```

### Nested Eager Loading
```php
$courses = Course::with('lessons.progress')->get();
```

### Constrained Eager Loading
```php
$course->load(['lessons' => function ($query) {
    $query->ordered();
}]);
```

---

## Mass Assignment Protection

Semua models menggunakan `$fillable` untuk mass assignment protection:

**✅ Allowed:**
```php
User::create([
    'name' => 'John',
    'email' => 'john@example.com',
    // Only fillable fields can be mass assigned
]);
```

**❌ Not Allowed:**
```php
User::create([
    'id' => 999, // Not in $fillable, will be ignored
    'is_admin' => true, // Not in $fillable, will be ignored
]);
```

---

## Type Casting

Models menggunakan `$casts` untuk automatic type casting:

**Benefits:**
- Automatic conversion saat retrieve dari database
- Type safety
- Carbon date instances untuk dates

**Example:**
```php
$course = Course::find(1);
$startDate = $course->start_date; // Carbon instance, not string
$isActive = $course->is_active; // boolean, not integer
```

---

## Best Practices

1. **Always use relationships** instead of manual joins
2. **Use eager loading** (`with()`) to avoid N+1 queries
3. **Use scopes** for reusable query logic
4. **Use accessors** for computed attributes
5. **Use casts** for type safety
6. **Use `$fillable`** for mass assignment protection
7. **Use `firstOrCreate()`** for unique records
8. **Use `updateOrCreate()`** for upsert operations
