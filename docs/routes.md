# Routes Documentation

## Overview
Routes di EduTrack LMS menggunakan Laravel routing system. File utama: `routes/web.php` dan `routes/auth.php`. Semua routes menggunakan named routes untuk kemudahan maintenance.

**Route Features:**
- Named routes untuk semua routes
- Middleware protection (auth, role-based)
- Route model binding untuk automatic model resolution
- Resource routes untuk CRUD operations
- Route grouping untuk organization

---

## Route Files

### 1. web.php
**File:** `routes/web.php`

**Fungsi:** Menangani semua web routes (non-authentication)

**Routes:**
- Public routes (homepage, about, catalog)
- Authenticated routes (dashboard, profile)
- Role-based routes (admin, teacher, student)

---

### 2. auth.php
**File:** `routes/auth.php`

**Fungsi:** Menangani authentication routes (login, register, password reset)

**Routes:**
- Login/Logout
- Registration
- Password reset (disabled - coming soon)
- Email verification
- Password confirmation

---

## Route Groups

### 1. Public Routes (No Authentication)

Routes yang bisa diakses tanpa login.

#### Homepage & About
```php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
```

**Routes:**
- `GET /` → `HomeController@index` (name: `home`)
- `GET /about` → `HomeController@about` (name: `about`)

**Middleware:** None

**Access:** Public

---

#### Course Catalog
```php
Route::get('/courses', [CourseController::class, 'publicIndex'])->name('courses.catalog');
```

**Route:**
- `GET /courses` → `CourseController@publicIndex` (name: `courses.catalog`)

**Middleware:** None

**Access:** Public

**Function:** Menampilkan catalog semua course aktif

---

#### Course Detail (Public)
```php
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.public.show');
```

**Route:**
- `GET /courses/{course}` → `CourseController@show` (name: `courses.public.show`)

**Middleware:** None

**Access:** Public

**Route Model Binding:** `{course}` automatically resolves to `Course` model

**Function:** Menampilkan detail course untuk public view

---

### 2. Authenticated Routes

Routes yang memerlukan login (`auth` middleware).

#### Dashboard
```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
```

**Route:**
- `GET /dashboard` → `view('dashboard')` (name: `dashboard`)

**Middleware:** `auth`, `verified`

**Access:** Authenticated users (all roles)

**Function:** General dashboard untuk semua user

---

#### Profile Management
```php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
```

**Routes:**
- `GET /profile` → `ProfileController@edit` (name: `profile.edit`)
- `PATCH /profile` → `ProfileController@update` (name: `profile.update`)
- `DELETE /profile` → `ProfileController@destroy` (name: `profile.destroy`)

**Middleware:** `auth`

**Access:** Authenticated users (all roles)

**Function:** User profile management

---

### 3. Student Routes

Routes khusus untuk student (`auth` + `role:student` middleware).

#### Lesson Viewing
```php
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])
         ->name('lessons.show');
});
```

**Route:**
- `GET /courses/{course}/lessons/{lesson}` → `LessonController@show` (name: `lessons.show`)

**Middleware:** `auth`, `role:student`

**Access:** Students only

**Route Model Binding:** `{course}` dan `{lesson}` automatically resolve

**Function:** Menampilkan detail lesson untuk student

---

#### Enrollment & Progress
```php
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/mark-done', [EnrollmentController::class, 'markAsDone'])->name('lessons.mark.done');
    Route::post('/lessons/{lesson}/mark-not-done', [EnrollmentController::class, 'markAsNotDone'])->name('lessons.mark.not.done');
});
```

**Routes:**
- `POST /courses/{course}/enroll` → `EnrollmentController@enroll` (name: `courses.enroll`)
- `POST /lessons/{lesson}/mark-done` → `EnrollmentController@markAsDone` (name: `lessons.mark.done`)
- `POST /lessons/{lesson}/mark-not-done` → `EnrollmentController@markAsNotDone` (name: `lessons.mark.not.done`)

**Middleware:** `auth`, `role:student`

**Access:** Students only

**Function:**
- Enroll ke course
- Mark lesson as done
- Mark lesson as not done

---

#### Certificate Management
```php
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/courses/{course}/certificate', [CertificateController::class, 'generate'])->name('courses.certificate');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
    Route::get('/certificates/{certificate}/view', [CertificateController::class, 'view'])->name('certificates.view');
});
```

**Routes:**
- `GET /courses/{course}/certificate` → `CertificateController@generate` (name: `courses.certificate`)
- `GET /certificates/{certificate}/download` → `CertificateController@download` (name: `certificates.download`)
- `GET /certificates/{certificate}/view` → `CertificateController@view` (name: `certificates.view`)

**Middleware:** `auth`, `role:student`

**Access:** Students only (dengan authorization check di controller)

**Function:**
- Generate certificate
- Download certificate PDF
- View certificate di browser

---

### 4. Admin Routes

Routes khusus untuk admin (`auth` + `role:admin` middleware).

#### Admin Dashboard
```php
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
```

**Route:**
- `GET /admin/dashboard` → `AdminController@dashboard` (name: `admin.dashboard`)

**Middleware:** `auth`, `role:admin`

**Access:** Admins only

**Function:** Admin dashboard dengan statistik

---

#### Course Management (Admin)
```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses', CourseController::class)->names('admin.courses');
});
```

**Routes (Resource):**
- `GET /admin/courses` → `CourseController@index` (name: `admin.courses.index`)
- `GET /admin/courses/create` → `CourseController@create` (name: `admin.courses.create`)
- `POST /admin/courses` → `CourseController@store` (name: `admin.courses.store`)
- `GET /admin/courses/{course}` → `CourseController@show` (name: `admin.courses.show`)
- `GET /admin/courses/{course}/edit` → `CourseController@edit` (name: `admin.courses.edit`)
- `PUT/PATCH /admin/courses/{course}` → `CourseController@update` (name: `admin.courses.update`)
- `DELETE /admin/courses/{course}` → `CourseController@destroy` (name: `admin.courses.destroy`)

**Middleware:** `auth`, `role:admin`

**Access:** Admins only

**Function:** Full CRUD operations untuk courses (admin bisa manage semua courses)

---

#### User Management
```php
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class)->names('admin.users');
});
```

**Routes (Resource):**
- `GET /admin/users` → `UserController@index` (name: `admin.users.index`)
- `GET /admin/users/create` → `UserController@create` (name: `admin.users.create`)
- `POST /admin/users` → `UserController@store` (name: `admin.users.store`)
- `GET /admin/users/{user}` → `UserController@show` (name: `admin.users.show`)
- `GET /admin/users/{user}/edit` → `UserController@edit` (name: `admin.users.edit`)
- `PUT/PATCH /admin/users/{user}` → `UserController@update` (name: `admin.users.update`)
- `DELETE /admin/users/{user}` → `UserController@destroy` (name: `admin.users.destroy`)

**Middleware:** `auth`, `role:admin`

**Access:** Admins only

**Function:** Full CRUD operations untuk users

---

#### Category Management
```php
Route::middleware(['role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});
```

**Routes (Resource):**
- `GET /categories` → `CategoryController@index` (name: `categories.index`)
- `GET /categories/create` → `CategoryController@create` (name: `categories.create`)
- `POST /categories` → `CategoryController@store` (name: `categories.store`)
- `GET /categories/{category}` → `CategoryController@show` (name: `categories.show`)
- `GET /categories/{category}/edit` → `CategoryController@edit` (name: `categories.edit`)
- `PUT/PATCH /categories/{category}` → `CategoryController@update` (name: `categories.update`)
- `DELETE /categories/{category}` → `CategoryController@destroy` (name: `categories.destroy`)

**Middleware:** `auth`, `role:admin`

**Access:** Admins only

**Function:** Full CRUD operations untuk categories

---

### 5. Teacher Routes

Routes khusus untuk teacher (`auth` + `role:teacher` middleware).

#### Teacher Dashboard
```php
Route::middleware(['role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
});
```

**Route:**
- `GET /teacher/dashboard` → `TeacherController@dashboard` (name: `teacher.dashboard`)

**Middleware:** `auth`, `role:teacher`

**Access:** Teachers only

**Function:** Teacher dashboard dengan courses miliknya

---

#### Course Management (Teacher)
```php
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::resource('courses', CourseController::class)->names('teacher.courses');
});
```

**Routes (Resource):**
- `GET /teacher/courses` → `CourseController@index` (name: `teacher.courses.index`)
- `GET /teacher/courses/create` → `CourseController@create` (name: `teacher.courses.create`)
- `POST /teacher/courses` → `CourseController@store` (name: `teacher.courses.store`)
- `GET /teacher/courses/{course}` → `CourseController@show` (name: `teacher.courses.show`)
- `GET /teacher/courses/{course}/edit` → `CourseController@edit` (name: `teacher.courses.edit`)
- `PUT/PATCH /teacher/courses/{course}` → `CourseController@update` (name: `teacher.courses.update`)
- `DELETE /teacher/courses/{course}` → `CourseController@destroy` (name: `teacher.courses.destroy`)

**Middleware:** `auth`, `role:teacher`

**Access:** Teachers only

**Function:** Full CRUD operations untuk courses (teacher hanya bisa manage courses miliknya)

**Authorization:** Check di controller untuk memastikan teacher hanya bisa manage courses miliknya

---

#### Lesson Management (Admin)
```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('courses.lessons', LessonController::class)->shallow()->names('admin.courses.lessons');
});
```

**Routes (Nested Resource):**
- `GET /admin/courses/{course}/lessons` → `LessonController@index` (name: `admin.courses.lessons.index`)
- `GET /admin/courses/{course}/lessons/create` → `LessonController@create` (name: `admin.courses.lessons.create`)
- `POST /admin/courses/{course}/lessons` → `LessonController@store` (name: `admin.courses.lessons.store`)
- `GET /admin/courses/{course}/lessons/{lesson}` → `LessonController@show` (name: `admin.courses.lessons.show`)
- `GET /admin/courses/{course}/lessons/{lesson}/edit` → `LessonController@edit` (name: `admin.courses.lessons.edit`)
- `PUT/PATCH /admin/courses/{course}/lessons/{lesson}` → `LessonController@update` (name: `admin.courses.lessons.update`)
- `DELETE /admin/courses/{course}/lessons/{lesson}` → `LessonController@destroy` (name: `admin.courses.lessons.destroy`)

**Middleware:** `auth`, `role:admin`

**Access:** Admins only

**Function:** Full CRUD operations untuk lessons dalam course

**Shallow Routing:** `shallow()` membuat route untuk show, edit, update, destroy tidak memerlukan `{course}` parameter

---

#### Lesson Management (Teacher)
```php
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::resource('courses.lessons', LessonController::class)->shallow()->names('teacher.courses.lessons');
});
```

**Routes (Nested Resource):**
- `GET /teacher/courses/{course}/lessons` → `LessonController@index` (name: `teacher.courses.lessons.index`)
- `GET /teacher/courses/{course}/lessons/create` → `LessonController@create` (name: `teacher.courses.lessons.create`)
- `POST /teacher/courses/{course}/lessons` → `LessonController@store` (name: `teacher.courses.lessons.store`)
- `GET /teacher/courses/{course}/lessons/{lesson}` → `LessonController@show` (name: `teacher.courses.lessons.show`)
- `GET /teacher/courses/{course}/lessons/{lesson}/edit` → `LessonController@edit` (name: `teacher.courses.lessons.edit`)
- `PUT/PATCH /teacher/courses/{course}/lessons/{lesson}` → `LessonController@update` (name: `teacher.courses.lessons.update`)
- `DELETE /teacher/courses/{course}/lessons/{lesson}` → `LessonController@destroy` (name: `teacher.courses.lessons.destroy`)

**Middleware:** `auth`, `role:teacher`

**Access:** Teachers only

**Function:** Full CRUD operations untuk lessons dalam course

**Shallow Routing:** `shallow()` membuat route untuk show, edit, update, destroy tidak memerlukan `{course}` parameter

---

### 6. Student Dashboard Route

```php
Route::middleware(['role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});
```

**Route:**
- `GET /student/dashboard` → `StudentController@dashboard` (name: `student.dashboard`)

**Middleware:** `auth`, `role:student`

**Access:** Students only

**Function:** Student dashboard dengan enrolled courses dan progress

---

## Authentication Routes

### Login Routes
```php
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
```

**Routes:**
- `GET /login` → `AuthenticatedSessionController@create` (name: `login`)
- `POST /login` → `AuthenticatedSessionController@store`

**Middleware:** `guest` (hanya bisa diakses jika belum login)

---

### Registration Routes
```php
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
```

**Routes:**
- `GET /register` → `RegisteredUserController@create` (name: `register`)
- `POST /register` → `RegisteredUserController@store`

**Middleware:** `guest`

---

### Password Reset Routes (Disabled - Coming Soon)
```php
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
```

**Routes:**
- `GET /forgot-password` → `PasswordResetLinkController@create` (name: `password.request`)
- `POST /forgot-password` → `PasswordResetLinkController@store` (name: `password.email`)
- `GET /reset-password/{token}` → `NewPasswordController@create` (name: `password.reset`)
- `POST /reset-password` → `NewPasswordController@store` (name: `password.store`)

**Middleware:** `guest`

**Status:** Disabled - menampilkan "Coming Soon" message

---

### Email Verification Routes
```php
Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');
Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
```

**Routes:**
- `GET /verify-email` → `EmailVerificationPromptController` (name: `verification.notice`)
- `GET /verify-email/{id}/{hash}` → `VerifyEmailController` (name: `verification.verify`)
- `POST /email/verification-notification` → `EmailVerificationNotificationController@store` (name: `verification.send`)

**Middleware:** `auth`, `signed`, `throttle:6,1`

---

### Password Confirmation Routes
```php
Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
```

**Routes:**
- `GET /confirm-password` → `ConfirmablePasswordController@show` (name: `password.confirm`)
- `POST /confirm-password` → `ConfirmablePasswordController@store`

**Middleware:** `auth`

---

### Password Update Route
```php
Route::put('password', [PasswordController::class, 'update'])->name('password.update');
```

**Route:**
- `PUT /password` → `PasswordController@update` (name: `password.update`)

**Middleware:** `auth`

---

### Logout Route
```php
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
```

**Route:**
- `POST /logout` → `AuthenticatedSessionController@destroy` (name: `logout`)

**Middleware:** `auth`

---

## Route Model Binding

Laravel automatically resolves route parameters ke model instances:

**Example:**
```php
Route::get('/courses/{course}', [CourseController::class, 'show']);

// Controller
public function show(Course $course) {
    // $course is automatically resolved from database
    // If not found, returns 404
}
```

**Benefits:**
- Automatic model resolution
- Automatic 404 if model not found
- Cleaner code

---

## Named Routes

Semua routes memiliki named routes untuk kemudahan maintenance:

**Usage:**
```php
// Generate URL
route('courses.catalog'); // /courses
route('courses.public.show', $course); // /courses/1

// Redirect
return redirect()->route('courses.catalog');

// In Blade
<a href="{{ route('courses.catalog') }}">Catalog</a>
```

---

## Middleware

### Authentication Middleware
- `auth` - User harus login
- `guest` - User harus belum login

### Role Middleware
- `role:admin` - User harus admin
- `role:teacher` - User harus teacher
- `role:student` - User harus student
- `role:admin,teacher` - User harus admin atau teacher
- `role:admin,teacher,student` - User harus salah satu dari ketiga role

**Multiple Roles Support:** Role middleware mendukung multiple roles yang dipisahkan dengan koma. User akan diberikan akses jika memiliki salah satu dari role yang ditentukan.

### Other Middleware
- `verified` - Email harus terverifikasi
- `signed` - URL harus signed (untuk email verification)
- `throttle:6,1` - Rate limiting (6 requests per minute)

---

## Route Caching

Untuk production, cache routes untuk performance:

```bash
php artisan route:cache
```

Clear cache:
```bash
php artisan route:clear
```

---

## Route List

Lihat semua routes:
```bash
php artisan route:list
```

Filter by name:
```bash
php artisan route:list --name=admin
```

---

## Best Practices

1. **Use named routes** untuk semua routes
2. **Group related routes** dengan middleware groups
3. **Use resource routes** untuk CRUD operations
4. **Use route model binding** untuk automatic model resolution
5. **Protect routes** dengan appropriate middleware
6. **Use shallow routing** untuk nested resources jika tidak perlu parent parameter
7. **Cache routes** di production untuk performance
