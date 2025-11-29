# Controllers Documentation

## Overview
Controllers di EduTrack LMS menangani semua logika bisnis dan mengatur interaksi antara user dan sistem. Semua controller berada di `app/Http/Controllers/` dan mengikuti pola MVC (Model-View-Controller) dari Laravel.

**Arsitektur Controller:**
- Semua controller extends `App\Http\Controllers\Controller`
- Menggunakan Form Request untuk validasi
- Menggunakan Eloquent ORM untuk database operations
- Mengimplementasikan role-based authorization
- Error handling dengan try-catch dan logging

---

## Controller List

### 1. HomeController
**File:** `app/Http/Controllers/HomeController.php`

**Fungsi:** Menangani halaman publik (homepage dan about page)

**Methods:**

#### `index(Request $request)`
**Route:** `GET /` (name: `home`)

**Middleware:** None (public access)

**Fungsi:**
Menampilkan homepage dengan daftar course populer, statistik, dan filter.

**Alur Kerja:**
1. Menerima request dengan parameter `search` dan `category_id`
2. Query courses aktif dengan eager loading (`teacher`, `category`, `students`)
3. Filter berdasarkan search (jika ada)
4. Filter berdasarkan category (jika ada)
5. Order by jumlah students (descending)
6. Limit 5 courses terpopuler
7. Ambil semua categories aktif
8. Hitung statistik:
   - Active courses count
   - Active categories count
   - Active teachers count
   - Active students count
9. Jika user login dan student, tambahkan progress dan enrollment status
10. Return view dengan data

**Contoh Request:**
```
GET /?search=laravel&category_id=1
```

**Response Data:**
```php
[
    'courses' => Collection, // 5 courses terpopuler
    'categories' => Collection, // Semua categories aktif
    'stats' => [
        'activeCourses' => int,
        'activeCategories' => int,
        'activeTeachers' => int,
        'activeStudents' => int,
    ]
]
```

**View:** `resources/views/home.blade.php`

---

#### `about()`
**Route:** `GET /about` (name: `about`)

**Middleware:** None (public access)

**Fungsi:**
Menampilkan halaman about/tentang aplikasi.

**Alur Kerja:**
1. Return view about tanpa data tambahan

**View:** `resources/views/about.blade.php`

---

### 2. CourseController
**File:** `app/Http/Controllers/CourseController.php`

**Fungsi:** Mengelola course (CRUD operations) untuk admin dan teacher

**Authorization:**
- **Admin:** Bisa mengelola semua courses
- **Teacher:** Hanya bisa mengelola courses miliknya sendiri
- **Student:** Hanya bisa melihat courses (public)

**Methods:**

#### `publicIndex(Request $request)`
**Route:** `GET /courses` (name: `courses.catalog`)

**Middleware:** None (public access)

**Fungsi:**
Menampilkan catalog semua course aktif untuk public view dengan fitur pencarian dan filter.

**Alur Kerja:**
1. Menerima request dengan parameter `search`, `category_id`, dan `sort`
2. Query courses aktif dengan eager loading (`teacher`, `category`, `students`) dan menghitung jumlah students dan lessons
3. Filter berdasarkan search (jika ada)
4. Filter berdasarkan category (jika ada)
5. Jika user login dan student:
   - Tambahkan subquery untuk student progress
6. Sort berdasarkan parameter:
   - `latest` (default)
   - `popular` (berdasarkan student count)
   - `progress` (berdasarkan student progress)
7. Paginate results dengan query string
8. Ambil semua categories aktif
9. Return catalog view

**Contoh Request:**
```
GET /courses?search=laravel&category_id=1&sort=popular
```

**Response Data:**
```php
[
    'courses' => Collection, // courses dengan pagination
    'categories' => Collection, // Semua categories aktif
    'sort' => string, // tipe sorting
]
```

**View:** `resources/views/courses/catalog.blade.php`

---

#### `show(Course $course)`
**Route:** `GET /courses/{course}` (name: `courses.public.show`)

**Middleware:** None (public access)

**Fungsi:**
Menampilkan detail course untuk public view. Jika course tidak aktif, menampilkan 404 error.

**Alur Kerja:**
1. Check apakah course aktif (jika tidak, abort 404)
2. Load course dengan relationships:
   - category
   - teacher
   - students
   - lessons (dengan ordering dan progress untuk student jika login)
3. Hitung jumlah students
4. Jika user login dan student:
   - Check enrollment status
   - Hitung progress course untuk user
5. Return detail view

**Response Data:**
```php
[
    'course' => Course, // Course dengan relationships
    'isEnrolled' => boolean, // Apakah student sudah enroll
    'studentProgress' => float, // Progress percentage (0-100), null jika belum enroll
]
```

**View:** `resources/views/courses/public/show.blade.php`

---

#### `index()`
**Route:**
- `GET /admin/courses` (name: `admin.courses.index`) - Admin
- `GET /teacher/courses` (name: `teacher.courses.index`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
List courses untuk admin atau teacher.

**Alur Kerja:**
1. Check user role
2. **Jika Admin:**
   - Query semua courses dengan pagination
   - Load categories dan teachers untuk filter
3. **Jika Teacher:**
   - Query hanya courses milik teacher tersebut
4. Return index view sesuai role

**Views:**
- Admin: `resources/views/courses/admin/index.blade.php`
- Teacher: `resources/views/courses/teacher/index.blade.php`

---

#### `create()`
**Route:**
- `GET /admin/courses/create` (name: `admin.courses.create`) - Admin
- `GET /teacher/courses/create` (name: `teacher.courses.create`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Form create course baru.

**Alur Kerja:**
1. Check user role
2. Load categories (dan teachers jika admin)
3. Return create form

**Views:**
- Admin: `resources/views/courses/admin/create.blade.php`
- Teacher: `resources/views/courses/teacher/create.blade.php`

---

#### `store(CourseStoreRequest $request)`
**Route:**
- `POST /admin/courses` (name: `admin.courses.store`) - Admin
- `POST /teacher/courses` (name: `teacher.courses.store`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Validasi:** `CourseStoreRequest`

**Fungsi:**
Menyimpan course baru ke database.

**Alur Kerja:**
1. Validasi request (dilakukan oleh Form Request)
2. Tentukan teacher_id:
   - Admin: dari request input
   - Teacher: dari authenticated user
3. Create course dengan data dari request
4. Redirect ke index dengan success message

**Form Request Rules:**
```php
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'start_date' => 'required|date',
'end_date' => 'required|date|after_or_equal:start_date',
'category_id' => 'required|exists:categories,id',
'teacher_id' => 'required_if:role,admin|exists:users,id', // Hanya untuk admin
'is_active' => 'boolean',
```

---

#### `edit(Course $course)`
**Route:**
- `GET /admin/courses/{course}/edit` (name: `admin.courses.edit`) - Admin
- `GET /teacher/courses/{course}/edit` (name: `teacher.courses.edit`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Form edit course.

**Authorization:**
- Admin: bisa edit semua courses
- Teacher: hanya bisa edit courses miliknya

**Alur Kerja:**
1. Check authorization
2. Load course dengan relationships
3. Load categories (dan teachers jika admin)
4. Return edit form

---

#### `update(CourseUpdateRequest $request, Course $course)`
**Route:**
- `PUT/PATCH /admin/courses/{course}` (name: `admin.courses.update`) - Admin
- `PUT/PATCH /teacher/courses/{course}` (name: `teacher.courses.update`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Validasi:** `CourseUpdateRequest`

**Fungsi:**
Update course yang sudah ada.

**Authorization:**
- Admin: bisa update semua courses
- Teacher: hanya bisa update courses miliknya

**Alur Kerja:**
1. Check authorization
2. Validasi request
3. Update course dengan data baru
4. Redirect dengan success message

---

#### `destroy(Course $course)`
**Route:**
- `DELETE /admin/courses/{course}` (name: `admin.courses.destroy`) - Admin
- `DELETE /teacher/courses/{course}` (name: `teacher.courses.destroy`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Hapus course dari database.

**Authorization:**
- Admin: bisa hapus semua courses
- Teacher: hanya bisa hapus courses miliknya

**Cascade Delete:**
Karena foreign key constraints, saat course dihapus:
- Semua lessons terkait akan terhapus
- Semua enrollments terkait akan terhapus
- Semua certificates terkait akan terhapus

**Alur Kerja:**
1. Check authorization
2. Delete course (cascade akan otomatis)
3. Redirect dengan success message

---

### 3. CategoryController
**File:** `app/Http/Controllers/CategoryController.php`

**Fungsi:** Mengelola kategori course

**Authorization:** Hanya admin yang bisa mengelola categories

**Methods:**

#### `index()`
**Route:** `GET /categories` (name: `categories.index`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
List semua categories.

**View:** `resources/views/categories/index.blade.php`

---

#### `create()`
**Route:** `GET /categories/create` (name: `categories.create`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Form create category baru.

**View:** `resources/views/categories/create.blade.php`

---

#### `store(CategoryStoreRequest $request)`
**Route:** `POST /categories` (name: `categories.store`)

**Middleware:** `auth`, `role:admin`

**Validasi:** `CategoryStoreRequest`

**Fungsi:**
Menyimpan category baru.

**Form Request Rules:**
```php
'name' => 'required|string|max:255|unique:categories,name',
'description' => 'nullable|string',
'is_active' => 'boolean',
```

---

#### `edit(Category $category)`
**Route:** `GET /categories/{category}/edit` (name: `categories.edit`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Form edit category.

**View:** `resources/views/categories/edit.blade.php`

---

#### `update(CategoryUpdateRequest $request, Category $category)`
**Route:** `PUT/PATCH /categories/{category}` (name: `categories.update`)

**Middleware:** `auth`, `role:admin`

**Validasi:** `CategoryUpdateRequest`

**Fungsi:**
Update category.

**Form Request Rules:**
```php
'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
'description' => 'nullable|string',
'is_active' => 'boolean',
```

---

#### `destroy(Category $category)`
**Route:** `DELETE /categories/{category}` (name: `categories.destroy`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Hapus category.

**Note:** Category tidak bisa dihapus jika masih ada courses yang menggunakan category tersebut (foreign key constraint).

---

### 4. LessonController
**File:** `app/Http/Controllers/LessonController.php`

**Fungsi:** Mengelola lesson dalam course

**Authorization:**
- **Admin:** Bisa mengelola lessons di semua courses
- **Teacher:** Hanya bisa mengelola lessons di courses miliknya
- **Student:** Hanya bisa melihat lessons di courses yang sudah di-enroll

**Methods:**

#### `index(Course $course)`
**Route:**
- `GET /admin/courses/{course}/lessons` (name: `admin.courses.lessons.index`) - Admin
- `GET /teacher/courses/{course}/lessons` (name: `teacher.courses.lessons.index`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
List semua lessons dalam course.

**Authorization:**
- Admin: bisa akses lessons di semua courses
- Teacher: hanya bisa akses lessons di course miliknya

**Alur Kerja:**
1. Check apakah user adalah admin atau teacher pemilik course
2. Load lessons dengan order
3. Return index view sesuai role

**Views:**
- Admin: `resources/views/lessons/index.blade.php` (jika role:admin)
- Teacher: `resources/views/lessons/index.blade.php` (jika role:teacher)

---

#### `create(Course $course)`
**Route:**
- `GET /admin/courses/{course}/lessons/create` (name: `admin.courses.lessons.create`) - Admin
- `GET /teacher/courses/{course}/lessons/create` (name: `teacher.courses.lessons.create`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Form create lesson baru.

**Authorization:**
- Admin: bisa create lessons di semua courses
- Teacher: hanya bisa create lessons di course miliknya

**View:** `resources/views/lessons/create.blade.php`

---

#### `store(LessonStoreRequest $request, Course $course)`
**Route:**
- `POST /admin/courses/{course}/lessons` (name: `admin.courses.lessons.store`) - Admin
- `POST /teacher/courses/{course}/lessons` (name: `teacher.courses.lessons.store`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Validasi:** `LessonStoreRequest`

**Fungsi:**
Menyimpan lesson baru ke course.

**Authorization:**
- Admin: bisa store lessons di semua courses
- Teacher: hanya bisa store lessons di course miliknya

**Form Request Rules:**
```php
'title' => 'required|string|max:255',
'content' => 'required|string',
'order' => 'required|integer|min:1',
```

---

#### `show(Course $course, Lesson $lesson)`
**Route:** `GET /courses/{course}/lessons/{lesson}` (name: `lessons.show`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Menampilkan detail lesson untuk student.

**Authorization:**
- Hanya student yang sudah enroll di course yang bisa akses

**Alur Kerja:**
1. Check enrollment status
2. Load lesson dengan progress student
3. Load semua lessons dalam course dengan progress
4. Tentukan next dan previous lesson
5. Calculate course progress
6. Return lesson view

**View:** `resources/views/lessons/show.blade.php`

---

#### `edit(Lesson $lesson)`
**Route:**
- `GET /admin/courses/{course}/lessons/{lesson}/edit` (name: `admin.courses.lessons.edit`) - Admin
- `GET /teacher/courses/{course}/lessons/{lesson}/edit` (name: `teacher.courses.lessons.edit`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Form edit lesson.

**Authorization:**
- Admin: bisa edit lessons di semua courses
- Teacher: hanya bisa edit lessons di course miliknya

**View:** `resources/views/lessons/edit.blade.php`

---

#### `update(LessonUpdateRequest $request, Lesson $lesson)`
**Route:**
- `PUT/PATCH /admin/courses/{course}/lessons/{lesson}` (name: `admin.courses.lessons.update`) - Admin
- `PUT/PATCH /teacher/courses/{course}/lessons/{lesson}` (name: `teacher.courses.lessons.update`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Validasi:** `LessonUpdateRequest`

**Fungsi:**
Update lesson.

**Authorization:**
- Admin: bisa update lessons di semua courses
- Teacher: hanya bisa update lessons di course miliknya

---

#### `destroy(Lesson $lesson)`
**Route:**
- `DELETE /admin/courses/{course}/lessons/{lesson}` (name: `admin.courses.lessons.destroy`) - Admin
- `DELETE /teacher/courses/{course}/lessons/{lesson}` (name: `teacher.courses.lessons.destroy`) - Teacher

**Middleware:** `auth`, `role:admin` atau `role:teacher`

**Fungsi:**
Hapus lesson.

**Authorization:**
- Admin: bisa delete lessons di semua courses
- Teacher: hanya bisa delete lessons di course miliknya

**Cascade Delete:**
Saat lesson dihapus, semua lesson_progress terkait akan terhapus.

---

### 5. EnrollmentController
**File:** `app/Http/Controllers/EnrollmentController.php`

**Fungsi:** Menangani enrollment dan progress tracking

**Authorization:** Hanya student yang bisa enroll dan track progress

**Methods:**

#### `enroll(Course $course)`
**Route:** `POST /courses/{course}/enroll` (name: `courses.enroll`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Student mendaftar ke course.

**Alur Kerja:**
1. Check user adalah student
2. Check course aktif
3. Attach student ke course dengan `syncWithoutDetaching` (mencegah duplicate)
4. Set `enrolled_at` timestamp
5. Redirect dengan success message

**Database Operation:**
```php
$course->students()->syncWithoutDetaching([
    $user->id => ['enrolled_at' => now()]
]);
```

---

#### `markAsDone(Lesson $lesson)`
**Route:** `POST /lessons/{lesson}/mark-done` (name: `lessons.mark.done`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Tandai lesson sebagai selesai dan auto-generate certificate jika progress 100%.

**Alur Kerja:**
1. Check user adalah student
2. Check enrollment status
3. **Database Transaction:**
   - Update atau create lesson_progress dengan `is_done = true`
   - Calculate course progress
   - **Jika progress >= 100%:**
     - Auto-create certificate dengan `firstOrCreate`
     - Generate certificate number: `CERT-{UNIQUE_ID}`
4. Redirect dengan success message

**Error Handling:**
- Try-catch dengan logging
- Return error message jika terjadi exception

**Database Transaction:**
```php
DB::transaction(function () use ($lesson, $user) {
    // Update progress
    LessonProgress::updateOrCreate([...], ['is_done' => true]);

    // Check progress
    $progress = $course->getProgressForUser($user);

    // Auto-generate certificate
    if ($progress >= 100) {
        Certificate::firstOrCreate([...], [
            'certificate_number' => 'CERT-' . strtoupper(uniqid()),
            'issued_at' => now(),
        ]);
    }
});
```

---

#### `markAsNotDone(Lesson $lesson)`
**Route:** `POST /lessons/{lesson}/mark-not-done` (name: `lessons.mark.not.done`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Tandai lesson sebagai belum selesai.

**Alur Kerja:**
1. Check user adalah student
2. Check enrollment status
3. Update lesson_progress dengan `is_done = false`
4. Redirect dengan success message

**Note:** Certificate tidak dihapus otomatis saat progress < 100%. Certificate tetap ada di database.

---

### 6. CertificateController
**File:** `app/Http/Controllers/CertificateController.php`

**Fungsi:** Generate, download, dan view certificate

**Authorization:**
- **Student:** Hanya bisa akses certificate miliknya
- **Admin:** Bisa akses semua certificates
- **Teacher:** Bisa akses certificates dari courses miliknya

**Methods:**

#### `generate(Course $course)`
**Route:** `GET /courses/{course}/certificate` (name: `courses.certificate`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Generate certificate baru atau ambil yang sudah ada, lalu download.

**Alur Kerja:**
1. Check user adalah student
2. Check enrollment status
3. Check progress >= 100%
4. **Database Transaction:**
   - Create atau get certificate dengan `firstOrCreate`
   - Generate certificate number jika baru
5. Panggil method `download()` untuk download PDF

**Validasi:**
- Student harus enroll di course
- Progress harus 100%

**Error Handling:**
- Try-catch dengan logging detail
- Return error message jika terjadi exception

---

#### `download(Certificate $certificate)`
**Route:** `GET /certificates/{certificate}/download` (name: `certificates.download`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Download certificate sebagai PDF file.

**Authorization:**
- Student: hanya certificate miliknya
- Admin: semua certificates
- Teacher: certificates dari courses miliknya

**Alur Kerja:**
1. Check authorization
2. Load certificate dengan relationships (student, course, teacher)
3. Prepare data untuk PDF:
   - Student name
   - Course title
   - Issue date (formatted)
   - Instructor name
   - Certificate number
4. Generate PDF dari view `certificates.pdf`
5. **Sanitize filename:**
   - Replace invalid characters (`/`, `\`, `:`, `*`, `?`, `"`, `<`, `>`, `|`) dengan `-`
   - Format: `certificate-{courseName}-{studentName}.pdf`
6. Return PDF download response

**PDF Generation:**
```php
$pdf = Pdf::loadView('certificates.pdf', $data);
return $pdf->download($filename);
```

**Filename Sanitization:**
```php
$courseName = preg_replace('/[\/\\\\:*?"<>|]/', '-', $certificate->course->name);
$studentName = preg_replace('/[\/\\\\:*?"<>|]/', '-', $certificate->student->name);
$filename = 'certificate-' . $courseName . '-' . $studentName . '.pdf';
```

**Error Handling:**
- Try-catch dengan logging
- Return error message jika terjadi exception

---

#### `view(Certificate $certificate)`
**Route:** `GET /certificates/{certificate}/view` (name: `certificates.view`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
View certificate di browser (stream, tidak download).

**Authorization:**
- Student: hanya certificate miliknya
- Admin: semua certificates
- Teacher: certificates dari courses miliknya

**Alur Kerja:**
1. Check authorization
2. Load certificate dengan relationships
3. Prepare data untuk PDF
4. Generate PDF
5. Return PDF stream response

**PDF Stream:**
```php
return $pdf->stream('certificate-' . $certificate->certificate_number . '.pdf');
```

**Perbedaan dengan Download:**
- `download()`: File akan terdownload ke komputer user
- `stream()`: PDF ditampilkan langsung di browser

---

### 7. ProfileController
**File:** `app/Http/Controllers/ProfileController.php`

**Fungsi:** Mengelola profile user

**Authorization:** User hanya bisa mengelola profile sendiri

**Methods:**

#### `edit()`
**Route:** `GET /profile` (name: `profile.edit`)

**Middleware:** `auth`

**Fungsi:**
Form edit profile.

**View:** `resources/views/profile/edit.blade.php`

---

#### `update(ProfileUpdateRequest $request)`
**Route:** `PATCH /profile` (name: `profile.update`)

**Middleware:** `auth`

**Validasi:** `ProfileUpdateRequest`

**Fungsi:**
Update profile user.

**Form Request Rules:**
```php
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
'username' => 'nullable|string|max:255|unique:users,username,' . auth()->id(),
```

---

#### `destroy()`
**Route:** `DELETE /profile` (name: `profile.destroy`)

**Middleware:** `auth`

**Fungsi:**
Hapus akun user.

**Note:** Menggunakan soft delete atau hard delete tergantung implementasi.

---

### 8. AdminController
**File:** `app/Http/Controllers/AdminController.php`

**Fungsi:** Dashboard dan statistik untuk admin

**Authorization:** Hanya admin

**Methods:**

#### `dashboard()`
**Route:** `GET /admin/dashboard` (name: `admin.dashboard`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Menampilkan dashboard admin dengan statistik dan data terbaru.

**Data yang Ditampilkan:**
- Total users
- Total courses
- Total categories
- Total enrollments
- Recent users (5 terbaru)
- Recent courses (5 terbaru dengan student count)
- All categories

**View:** `resources/views/admin/dashboard.blade.php`

---

### 9. TeacherController
**File:** `app/Http/Controllers/TeacherController.php`

**Fungsi:** Dashboard untuk teacher

**Authorization:** Hanya teacher

**Methods:**

#### `dashboard()`
**Route:** `GET /teacher/dashboard` (name: `teacher.dashboard`)

**Middleware:** `auth`, `role:teacher`

**Fungsi:**
Menampilkan dashboard teacher dengan courses miliknya.

**Data yang Ditampilkan:**
- Courses milik teacher (paginated, 12 per page)
- Dengan category dan teacher info
- Student count per course

**View:** `resources/views/teacher/dashboard.blade.php`

---

### 10. StudentController
**File:** `app/Http/Controllers/StudentController.php`

**Fungsi:** Dashboard untuk student

**Authorization:** Hanya student

**Methods:**

#### `dashboard()`
**Route:** `GET /student/dashboard` (name: `student.dashboard`)

**Middleware:** `auth`, `role:student`

**Fungsi:**
Menampilkan dashboard student dengan enrolled courses dan progress.

**Data yang Ditampilkan:**
- User info
- Enrolled courses dengan:
  - Teacher info
  - Category info
  - Progress percentage per course

**View:** `resources/views/profile/student.blade.php`

---

### 11. Admin\UserController
**File:** `app/Http/Controllers/Admin/UserController.php`

**Fungsi:** User management untuk admin

**Authorization:** Hanya admin

**Methods:**

#### `index()`
**Route:** `GET /admin/users` (name: `admin.users.index`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
List semua users dengan pagination.

**View:** `resources/views/users/admin/index.blade.php`

---

#### `create()`
**Route:** `GET /admin/users/create` (name: `admin.users.create`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Form create user baru.

**View:** `resources/views/users/admin/create.blade.php`

---

#### `store(UserStoreRequest $request)`
**Route:** `POST /admin/users` (name: `admin.users.store`)

**Middleware:** `auth`, `role:admin`

**Validasi:** `UserStoreRequest`

**Fungsi:**
Menyimpan user baru.

**Form Request Rules:**
```php
'name' => 'required|string|max:255',
'username' => 'nullable|string|max:255|unique:users,username',
'email' => 'required|string|email|max:255|unique:users,email',
'password' => 'required|confirmed|min:8',
'role' => 'required|in:admin,teacher,student',
'is_active' => 'boolean',
```

**Password Hashing:**
```php
'password' => Hash::make($request->password),
```

---

#### `show(User $user)`
**Route:** `GET /admin/users/{user}` (name: `admin.users.show`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Show user detail (redirects to edit).

---

#### `edit(User $user)`
**Route:** `GET /admin/users/{user}/edit` (name: `admin.users.edit`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Form edit user.

**View:** `resources/views/users/admin/edit.blade.php`

---

#### `update(UserUpdateRequest $request, User $user)`
**Route:** `PUT/PATCH /admin/users/{user}` (name: `admin.users.update`)

**Middleware:** `auth`, `role:admin`

**Validasi:** `UserUpdateRequest`

**Fungsi:**
Update user.

**Form Request Rules:**
```php
'name' => 'required|string|max:255',
'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
'password' => 'nullable|confirmed|min:8', // Optional
'role' => 'required|in:admin,teacher,student',
'is_active' => 'boolean',
```

**Password Update:**
- Password hanya di-update jika diisi (nullable)

---

#### `destroy(User $user)`
**Route:** `DELETE /admin/users/{user}` (name: `admin.users.destroy`)

**Middleware:** `auth`, `role:admin`

**Fungsi:**
Hapus user.

**Cascade Delete:**
Saat user dihapus:
- Jika teacher: semua courses miliknya akan terhapus
- Jika student: semua enrollments, progress, dan certificates akan terhapus

---

## Request Flow Diagram

```
User Request
    ↓
Route (web.php / auth.php)
    ↓
Middleware (auth, role, verified)
    ↓
Controller Method
    ↓
Form Request Validation (jika ada)
    ↓
Business Logic
    ↓
Database Operation (Eloquent ORM)
    ↓
Response (View / Redirect / JSON)
```

---

## Error Handling Pattern

Semua controller menggunakan pattern error handling yang konsisten:

```php
try {
    // Business logic
    DB::transaction(function () {
        // Database operations
    });

    return redirect()->back()->with('success', 'Success message');
} catch (\Exception $e) {
    Log::error('Error description', [
        'user_id' => $user->id,
        'context' => 'additional data',
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);

    return redirect()->back()
        ->with('error', 'User-friendly error message');
}
```

---

## Authorization Pattern

Authorization dilakukan di beberapa level:

1. **Route Level:** Middleware `role:admin`, `role:teacher`, `role:student`, atau multiple roles seperti `role:admin,teacher`
2. **Controller Level:** Manual check dengan `abort(403)`
3. **Model Level:** Policy (jika ada)

**Contoh Authorization Check:**
```php
// Route level
Route::middleware(['auth', 'role:admin'])->group(...);
Route::middleware(['auth', 'role:admin,teacher'])->group(...); // Multiple roles

// Controller level
if (!$user->isAdmin()) {
    abort(403, 'Unauthorized access.');
}

// Resource ownership
if ($course->teacher_id !== $user->id) {
    abort(403, 'Unauthorized access to this course.');
}
```

**Multiple Roles Support:**
Role middleware sekarang mendukung multiple roles yang dipisahkan dengan koma. Contoh:
- `role:admin,teacher` - Akses diberikan ke admin atau teacher
- `role:admin,teacher,student` - Akses diberikan ke semua tiga role

---

## Form Request Validation

Semua input validation dilakukan melalui Form Request classes:

**Location:** `app/Http/Requests/`

**Form Requests:**
- `CategoryStoreRequest` / `CategoryUpdateRequest`
- `CourseStoreRequest` / `CourseUpdateRequest`
- `LessonStoreRequest` / `LessonUpdateRequest`
- `ProfileUpdateRequest`
- `UserStoreRequest` / `UserUpdateRequest`
- `Auth/LoginRequest`

**Benefits:**
- Separation of concerns
- Reusable validation rules
- Custom error messages
- Automatic validation before controller method execution

---

## Database Transactions

Beberapa operations menggunakan database transactions untuk atomicity:

1. **EnrollmentController::markAsDone()**
   - Update progress
   - Auto-generate certificate (jika progress 100%)

2. **CertificateController::generate()**
   - Create/get certificate

**Transaction Pattern:**
```php
DB::transaction(function () use ($data) {
    // Multiple database operations
    // All or nothing
});
```

---

## Logging

Semua error di-log dengan context yang detail:

```php
Log::error('Error description', [
    'user_id' => $user->id,
    'course_id' => $course->id,
    'error' => $e->getMessage(),
    'trace' => $e->getTraceAsString(),
]);
```

**Log Location:** `storage/logs/laravel.log`

---

## Best Practices

1. **Eager Loading:** Gunakan `with()` untuk menghindari N+1 query problem
2. **Pagination:** Gunakan `paginate()` untuk list data besar
3. **Form Request:** Validasi di Form Request, bukan di controller
4. **Error Handling:** Selalu gunakan try-catch untuk database operations
5. **Authorization:** Check authorization di awal method
6. **Transaction:** Gunakan transaction untuk multiple related operations
7. **Logging:** Log semua errors dengan context yang detail
8. **Response Messages:** Gunakan flash messages untuk user feedback
