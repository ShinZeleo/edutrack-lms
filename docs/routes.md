# Routes Documentation

## Overview
Routes di EduTrack LMS menggunakan Laravel routing system. File utama: `routes/web.php` dan `routes/auth.php`.

---

## Route Groups

### 1. Public Routes (No Authentication)
Routes yang bisa diakses tanpa login.

#### Homepage & About
- `GET /` → `HomeController@index` - Homepage
- `GET /about` → `HomeController@about` - About page

#### Course Catalog
- `GET /courses` → `CourseController@publicIndex` - Catalog semua course aktif

#### Course Detail (Public)
- `GET /courses/{course}` → `CourseController@show` - Detail course (public view)

---

### 2. Authenticated Routes
Routes yang memerlukan login (`auth` middleware).

#### Dashboard
- `GET /dashboard` → `view('dashboard')` - General dashboard

#### Profile Management
- `GET /profile` → `ProfileController@edit` - Edit profile
- `PATCH /profile` → `ProfileController@update` - Update profile
- `DELETE /profile` → `ProfileController@destroy` - Delete account

---

### 3. Admin Routes
Routes khusus untuk admin (`auth` + `role:admin` middleware).

#### Admin Dashboard
- `GET /admin/dashboard` → `AdminController@dashboard` - Admin dashboard

#### User Management
- `GET /admin/users` → `UserController@index` - List users
- `GET /admin/users/create` → `UserController@create` - Create user form
- `POST /admin/users` → `UserController@store` - Store user (menggunakan UserStoreRequest)
- `GET /admin/users/{user}` → `UserController@show` - Show user (redirects to edit)
- `GET /admin/users/{user}/edit` → `UserController@edit` - Edit user form
- `PUT/PATCH /admin/users/{user}` → `UserController@update` - Update user (menggunakan UserUpdateRequest)
- `DELETE /admin/users/{user}` → `UserController@destroy` - Delete user

#### Course Management (Admin)
- `GET /admin/courses` → `CourseController@index` - List courses
- `GET /admin/courses/create` → `CourseController@create` - Create course form
- `POST /admin/courses` → `CourseController@store` - Store course (menggunakan CourseStoreRequest)
- `GET /admin/courses/{course}` → `CourseController@show` - Show course
- `GET /admin/courses/{course}/edit` → `CourseController@edit` - Edit course form
- `PUT/PATCH /admin/courses/{course}` → `CourseController@update` - Update course (menggunakan CourseUpdateRequest)
- `DELETE /admin/courses/{course}` → `CourseController@destroy` - Delete course

#### Category Management
- `GET /categories` → `CategoryController@index` - List categories
- `GET /categories/create` → `CategoryController@create` - Create category form
- `POST /categories` → `CategoryController@store` - Store category (menggunakan CategoryStoreRequest)
- `GET /categories/{category}/edit` → `CategoryController@edit` - Edit category form
- `PUT/PATCH /categories/{category}` → `CategoryController@update` - Update category (menggunakan CategoryUpdateRequest)
- `DELETE /categories/{category}` → `CategoryController@destroy` - Delete category

---

### 4. Teacher Routes
Routes khusus untuk teacher (`auth` + `role:teacher` middleware).

#### Teacher Dashboard
- `GET /teacher/dashboard` → `TeacherController@dashboard` - Teacher dashboard

#### Course Management (Teacher)
- `GET /teacher/courses` → `CourseController@index` - List teacher's courses
- `GET /teacher/courses/create` → `CourseController@create` - Create course form
- `POST /teacher/courses` → `CourseController@store` - Store course (menggunakan CourseStoreRequest)
- `GET /teacher/courses/{course}` → `CourseController@show` - Show course
- `GET /teacher/courses/{course}/edit` → `CourseController@edit` - Edit course form
- `PUT/PATCH /teacher/courses/{course}` → `CourseController@update` - Update course (menggunakan CourseUpdateRequest)
- `DELETE /teacher/courses/{course}` → `CourseController@destroy` - Delete course

#### Lesson Management
- `GET /teacher/courses/{course}/lessons` → `LessonController@index` - List lessons
- `GET /teacher/courses/{course}/lessons/create` → `LessonController@create` - Create lesson form
- `POST /teacher/courses/{course}/lessons` → `LessonController@store` - Store lesson (menggunakan LessonStoreRequest)
- `GET /teacher/courses/{course}/lessons/{lesson}` → `LessonController@show` - Show lesson
- `GET /teacher/courses/{course}/lessons/{lesson}/edit` → `LessonController@edit` - Edit lesson form
- `PUT/PATCH /teacher/courses/{course}/lessons/{lesson}` → `LessonController@update` - Update lesson (menggunakan LessonUpdateRequest)
- `DELETE /teacher/courses/{course}/lessons/{lesson}` → `LessonController@destroy` - Delete lesson

**Note:** Lesson routes menggunakan `shallow()` untuk menghindari nested route yang terlalu dalam.

---

### 5. Student Routes
Routes khusus untuk student (`auth` + `role:student` middleware).

#### Student Dashboard
- `GET /student/dashboard` → `StudentController@dashboard` - Student dashboard

#### Enrollment
- `POST /courses/{course}/enroll` → `EnrollmentController@enroll` - Enroll ke course

#### Lesson Progress
- `GET /courses/{course}/lessons/{lesson}` → `LessonController@show` - View lesson (student)
- `POST /lessons/{lesson}/mark-done` → `EnrollmentController@markAsDone` - Mark lesson as done (dengan transaction)
- `POST /lessons/{lesson}/mark-not-done` → `EnrollmentController@markAsNotDone` - Mark lesson as not done

#### Certificate
- `GET /courses/{course}/certificate` → `CertificateController@generate` - Generate certificate (dengan transaction)
- `GET /certificates/{certificate}/download` → `CertificateController@download` - Download certificate PDF (dengan error handling)
- `GET /certificates/{certificate}/view` → `CertificateController@view` - View certificate in browser (dengan error handling)

---

## Authentication Routes
**File:** `routes/auth.php`

### Login
- `GET /login` → `AuthenticatedSessionController@create` - Login form
- `POST /login` → `AuthenticatedSessionController@store` - Process login (menggunakan LoginRequest dengan rate limiting)
- `POST /logout` → `AuthenticatedSessionController@destroy` - Logout

### Registration
- `GET /register` → `RegisteredUserController@create` - Registration form
- `POST /register` → `RegisteredUserController@store` - Process registration

### Password Reset
- `GET /forgot-password` → `PasswordResetLinkController@create` - Request password reset
- `POST /forgot-password` → `PasswordResetLinkController@store` - Send reset link
- `GET /reset-password/{token}` → `NewPasswordController@create` - Reset password form
- `POST /reset-password` → `NewPasswordController@store` - Process password reset

### Email Verification
- `GET /verify-email` → `EmailVerificationPromptController@__invoke` - Email verification prompt
- `GET /verify-email/{id}/{hash}` → `VerifyEmailController@__invoke` - Verify email
- `POST /email/verification-notification` → `EmailVerificationNotificationController@store` - Resend verification email

### Password Confirmation
- `GET /confirm-password` → `ConfirmablePasswordController@show` - Confirm password form
- `POST /confirm-password` → `ConfirmablePasswordController@store` - Process password confirmation

---

## Route Naming Convention

### Resource Routes
Laravel resource routes menggunakan naming convention:
- `index` - List all
- `create` - Create form
- `store` - Store new
- `show` - Show single
- `edit` - Edit form
- `update` - Update existing
- `destroy` - Delete

### Custom Route Names
- `home` - Homepage
- `about` - About page
- `courses.catalog` - Course catalog
- `courses.public.show` - Public course detail
- `courses.enroll` - Enroll to course
- `lessons.show` - Show lesson
- `lessons.mark.done` - Mark lesson done
- `lessons.mark.not.done` - Mark lesson not done
- `courses.certificate` - Generate certificate
- `certificates.download` - Download certificate
- `certificates.view` - View certificate
- `admin.dashboard` - Admin dashboard
- `teacher.dashboard` - Teacher dashboard
- `student.dashboard` - Student dashboard

---

## Middleware

### Authentication Middleware
- `auth` - User must be logged in
- `verified` - Email must be verified

### Role Middleware
- `role:admin` - Only admin
- `role:teacher` - Only teacher
- `role:student` - Only student

**Custom Middleware:** `app/Http/Middleware/RoleMiddleware.php`

---

## Route Model Binding

Laravel automatically resolves model instances from route parameters:

```php
// Route definition
Route::get('/courses/{course}', [CourseController::class, 'show']);

// Controller method
public function show(Course $course) {
    // $course is automatically resolved from database
}
```

**Models with Route Binding:**
- `Course` - via `{course}`
- `Lesson` - via `{lesson}`
- `Category` - via `{category}`
- `User` - via `{user}`
- `Certificate` - via `{certificate}`

---

## Route Prefixes

- `/admin/*` - Admin routes
- `/teacher/*` - Teacher routes
- `/student/*` - Student routes (some routes)

---

## Route Parameters

### Required Parameters
- `{course}` - Course ID or slug
- `{lesson}` - Lesson ID
- `{category}` - Category ID
- `{user}` - User ID
- `{certificate}` - Certificate ID

### Optional Parameters
None currently used.

---

## Form Request Integration

Routes yang menggunakan Form Request untuk validasi:

### Course Routes
- `POST /admin/courses` → `CourseStoreRequest`
- `PUT/PATCH /admin/courses/{course}` → `CourseUpdateRequest`
- `POST /teacher/courses` → `CourseStoreRequest`
- `PUT/PATCH /teacher/courses/{course}` → `CourseUpdateRequest`

### Lesson Routes
- `POST /teacher/courses/{course}/lessons` → `LessonStoreRequest`
- `PUT/PATCH /teacher/courses/{course}/lessons/{lesson}` → `LessonUpdateRequest`

### Category Routes
- `POST /categories` → `CategoryStoreRequest`
- `PUT/PATCH /categories/{category}` → `CategoryUpdateRequest`

### User Routes
- `POST /admin/users` → `UserStoreRequest`
- `PUT/PATCH /admin/users/{user}` → `UserUpdateRequest`

### Auth Routes
- `POST /login` → `LoginRequest` (dengan rate limiting)

### Profile Routes
- `PATCH /profile` → `ProfileUpdateRequest`

---

## Best Practices

1. **Grouping:** Group routes by middleware untuk clarity
2. **Naming:** Use descriptive route names
3. **Resource Routes:** Use resource routes untuk CRUD operations
4. **Middleware:** Apply appropriate middleware untuk security
5. **Validation:** Use Form Request classes untuk validation
6. **Authorization:** Check authorization di controller, bukan hanya di middleware
7. **Route Model Binding:** Gunakan route model binding untuk cleaner code

---

## Route List Command

Untuk melihat semua routes:
```bash
php artisan route:list
```

Untuk filter routes:
```bash
php artisan route:list --name=admin
php artisan route:list --method=GET
php artisan route:list --middleware=auth
```

