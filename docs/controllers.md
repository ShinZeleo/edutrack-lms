# Controllers Documentation

## Overview
Controllers di EduTrack LMS menangani logika bisnis dan mengatur interaksi antara user dan sistem. Semua controller berada di `app/Http/Controllers/`.

---

## Main Controllers

### 1. HomeController
**File:** `app/Http/Controllers/HomeController.php`

**Fungsi:** Menangani halaman publik (homepage dan about page)

**Methods:**
- `index(Request $request)` - Menampilkan homepage dengan daftar course populer, statistik, dan filter
- `about()` - Menampilkan halaman about

**Fitur:**
- Search course berdasarkan nama
- Filter course berdasarkan kategori
- Menampilkan 5 course terpopuler (berdasarkan jumlah student)
- Statistik: active courses, categories, teachers, students
- Progress tracking untuk student yang login

---

### 2. CourseController
**File:** `app/Http/Controllers/CourseController.php`

**Fungsi:** Mengelola course (CRUD operations)

**Methods:**
- `publicIndex()` - Menampilkan catalog semua course aktif (public)
- `show(Course $course)` - Menampilkan detail course (public)
- `index()` - List course untuk admin/teacher
- `create()` - Form create course
- `store(CourseStoreRequest $request)` - Menyimpan course baru (menggunakan Form Request)
- `edit(Course $course)` - Form edit course
- `update(CourseUpdateRequest $request, Course $course)` - Update course (menggunakan Form Request)
- `destroy(Course $course)` - Hapus course

**Authorization:**
- Admin: Bisa mengelola semua course
- Teacher: Hanya bisa mengelola course miliknya sendiri

**Form Requests:**
- `CourseStoreRequest` - Validasi untuk create course
- `CourseUpdateRequest` - Validasi untuk update course

---

### 3. CategoryController
**File:** `app/Http/Controllers/CategoryController.php`

**Fungsi:** Mengelola kategori course

**Methods:**
- `index()` - List semua kategori
- `create()` - Form create kategori
- `store(CategoryStoreRequest $request)` - Menyimpan kategori baru (menggunakan Form Request)
- `edit(Category $category)` - Form edit kategori
- `update(CategoryUpdateRequest $request, Category $category)` - Update kategori (menggunakan Form Request)
- `destroy(Category $category)` - Hapus kategori

**Authorization:** Hanya admin yang bisa mengelola kategori

**Form Requests:**
- `CategoryStoreRequest` - Validasi untuk create category
- `CategoryUpdateRequest` - Validasi untuk update category

---

### 4. LessonController
**File:** `app/Http/Controllers/LessonController.php`

**Fungsi:** Mengelola lesson dalam course

**Methods:**
- `index(Course $course)` - List semua lesson dalam course
- `create(Course $course)` - Form create lesson
- `store(LessonStoreRequest $request, Course $course)` - Menyimpan lesson baru (menggunakan Form Request)
- `show(Course $course, Lesson $lesson)` - Menampilkan detail lesson
- `edit(Lesson $lesson)` - Form edit lesson
- `update(LessonUpdateRequest $request, Lesson $lesson)` - Update lesson (menggunakan Form Request)
- `destroy(Lesson $lesson)` - Hapus lesson

**Authorization:**
- Teacher: Hanya bisa mengelola lesson di course miliknya
- Student: Hanya bisa melihat lesson di course yang sudah di-enroll

**Form Requests:**
- `LessonStoreRequest` - Validasi untuk create lesson
- `LessonUpdateRequest` - Validasi untuk update lesson

---

### 5. EnrollmentController
**File:** `app/Http/Controllers/EnrollmentController.php`

**Fungsi:** Menangani enrollment dan progress tracking

**Methods:**
- `enroll(Course $course)` - Student mendaftar ke course
- `markAsDone(Lesson $lesson)` - Tandai lesson sebagai selesai
- `markAsNotDone(Lesson $lesson)` - Tandai lesson sebagai belum selesai

**Fitur Khusus:**
- **Auto-generate Certificate:** Ketika progress mencapai 100%, certificate otomatis dibuat
- **Database Transaction:** Menggunakan `DB::transaction()` untuk memastikan atomicity saat update progress dan create certificate
- **Error Handling:** Try-catch dengan logging yang detail
- **Logging:** Menggunakan `Log::error()` dengan context (user_id, lesson_id, error, trace)

**Authorization:** Hanya student yang bisa enroll dan track progress

**Error Handling:**
```php
try {
    return DB::transaction(function () use ($lesson, $user) {
        // Update progress + create certificate
    });
} catch (\Exception $e) {
    Log::error('Error marking lesson as done', [
        'user_id' => $user->id,
        'lesson_id' => $lesson->id,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);
    // Return error response
}
```

---

### 6. CertificateController
**File:** `app/Http/Controllers/CertificateController.php`

**Fungsi:** Mengelola certificate generation dan download

**Methods:**
- `generate(Course $course)` - Generate certificate baru (jika belum ada)
- `download(Certificate $certificate)` - Download certificate sebagai PDF
- `view(Certificate $certificate)` - View certificate di browser

**Fitur:**
- Validasi: Hanya bisa generate jika progress 100%
- PDF generation menggunakan `barryvdh/laravel-dompdf`
- Authorization check: Student hanya bisa akses certificate miliknya
- **Database Transaction:** Menggunakan `DB::transaction()` untuk create certificate
- **Error Handling:** Try-catch untuk semua method dengan logging detail

**Error Handling:**
```php
try {
    $certificate = DB::transaction(function () use ($user, $course) {
        return Certificate::firstOrCreate(...);
    });
    return $this->download($certificate);
} catch (\Exception $e) {
    Log::error('Error generating certificate', [
        'user_id' => $user->id,
        'course_id' => $course->id,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);
    // Return error response
}
```

---

### 7. ProfileController
**File:** `app/Http/Controllers/ProfileController.php`

**Fungsi:** Mengelola profile user

**Methods:**
- `edit()` - Form edit profile
- `update(ProfileUpdateRequest $request)` - Update profile (menggunakan Form Request)
- `destroy(Request $request)` - Hapus akun

**Authorization:** Semua user yang login bisa mengelola profile sendiri

**Form Requests:**
- `ProfileUpdateRequest` - Validasi untuk update profile

---

### 8. AdminController
**File:** `app/Http/Controllers/AdminController.php`

**Fungsi:** Dashboard dan statistik untuk admin

**Methods:**
- `dashboard()` - Menampilkan dashboard admin dengan statistik lengkap

**Statistik yang ditampilkan:**
- Total users (admin, teacher, student)
- Total courses (active, inactive)
- Total categories
- Total lessons
- Total enrollments

---

### 9. TeacherController
**File:** `app/Http/Controllers/TeacherController.php`

**Fungsi:** Dashboard untuk teacher

**Methods:**
- `dashboard()` - Menampilkan dashboard teacher dengan course miliknya

---

### 10. StudentController
**File:** `app/Http/Controllers/StudentController.php`

**Fungsi:** Dashboard untuk student

**Methods:**
- `dashboard()` - Menampilkan dashboard student dengan course yang di-enroll dan progress

---

### 11. UserController (Admin)
**File:** `app/Http/Controllers/Admin/UserController.php`

**Fungsi:** Mengelola user (hanya admin)

**Methods:**
- `index(Request $request)` - List semua user dengan filter dan search
- `create()` - Form create user
- `store(UserStoreRequest $request)` - Menyimpan user baru (menggunakan Form Request)
- `edit(User $user)` - Form edit user
- `update(UserUpdateRequest $request, User $user)` - Update user (menggunakan Form Request)
- `destroy(User $user)` - Hapus user

**Fitur:**
- Search berdasarkan name atau email
- Filter berdasarkan role
- Pagination (15 per page)
- Validasi: Admin tidak bisa hapus akun sendiri

**Form Requests:**
- `UserStoreRequest` - Validasi untuk create user
- `UserUpdateRequest` - Validasi untuk update user

---

## Auth Controllers

Semua controller authentication berada di `app/Http/Controllers/Auth/`:

- `AuthenticatedSessionController` - Login/logout
- `RegisteredUserController` - Registration
- `PasswordResetLinkController` - Request password reset
- `NewPasswordController` - Reset password
- `EmailVerificationPromptController` - Email verification prompt
- `VerifyEmailController` - Verify email
- `ConfirmablePasswordController` - Confirm password
- `PasswordController` - Update password

---

## Form Request Classes

Semua Form Request classes berada di `app/Http/Requests/`:

### Course Requests
- `CourseStoreRequest` - Validasi untuk create course
- `CourseUpdateRequest` - Validasi untuk update course

### Lesson Requests
- `LessonStoreRequest` - Validasi untuk create lesson
- `LessonUpdateRequest` - Validasi untuk update lesson

### Category Requests
- `CategoryStoreRequest` - Validasi untuk create category
- `CategoryUpdateRequest` - Validasi untuk update category

### User Requests
- `UserStoreRequest` - Validasi untuk create user
- `UserUpdateRequest` - Validasi untuk update user

### Auth Requests
- `LoginRequest` - Validasi untuk login (dengan rate limiting)

### Profile Requests
- `ProfileUpdateRequest` - Validasi untuk update profile

**Manfaat Form Request:**
- Validasi terpusat dan reusable
- Custom error messages dalam bahasa Indonesia
- Authorization logic bisa dipisah
- Code lebih clean dan maintainable

---

## Common Patterns

### 1. Authorization Check
```php
if (!$user->isStudent()) {
    abort(403, 'Only students can enroll in courses.');
}
```

### 2. Role-based Access
```php
if ($user->isAdmin() || ($user->isTeacher() && $course->teacher_id === $user->id)) {
    // Allow access
}
```

### 3. Database Transaction
```php
DB::transaction(function () {
    // Multiple database operations
    // All succeed or all fail
});
```

### 4. Error Handling dengan Logging
```php
try {
    // Operation
} catch (\Exception $e) {
    Log::error('Error message', [
        'user_id' => $user->id,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);
    return redirect()->back()->with('error', 'User-friendly message');
}
```

### 5. Form Request Usage
```php
public function store(CourseStoreRequest $request)
{
    // Validation sudah dilakukan di Form Request
    // Langsung gunakan $request->input()
}
```

### 6. Redirect with Message
```php
return redirect()->back()->with('success', 'Operation successful.');
```

---

## Middleware Usage

- `auth` - User harus login
- `verified` - Email harus terverifikasi
- `role:admin` - Hanya admin
- `role:teacher` - Hanya teacher
- `role:student` - Hanya student

---

## Best Practices

1. **Authorization:** Selalu cek authorization sebelum akses resource
2. **Validation:** Gunakan Form Request classes untuk validasi
3. **Error Handling:** Gunakan try-catch untuk operasi yang bisa gagal
4. **Transaction:** Gunakan transaction untuk multiple database operations
5. **Logging:** Log errors dengan context yang detail
6. **Eager Loading:** Gunakan `with()` untuk menghindari N+1 query problem
7. **Response:** Return appropriate HTTP status codes
8. **Code Organization:** Pisahkan logic ke Form Request dan Service classes jika perlu

