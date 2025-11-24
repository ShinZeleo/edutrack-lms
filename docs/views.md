# Views Documentation

## Overview
Views di EduTrack LMS menggunakan Blade templating engine. Semua view files berada di `resources/views/`.

---

## View Structure

### Directory Structure
```
resources/views/
├── layouts/          # Layout templates
├── components/       # Reusable components
├── auth/            # Authentication views
├── admin/           # Admin views
├── categories/      # Category management
├── courses/         # Course views
│   ├── admin/       # Admin course management
│   ├── teacher/      # Teacher course management
│   ├── public/       # Public course views
│   └── catalog.blade.php
├── lessons/         # Lesson views
├── profile/         # Profile views
├── certificates/    # Certificate views
├── users/           # User management (admin)
├── teacher/         # Teacher dashboard
├── home.blade.php   # Homepage
├── about.blade.php  # About page
└── dashboard.blade.php # General dashboard
```

---

## Layouts

### 1. app.blade.php
**File:** `resources/views/layouts/app.blade.php`

**Purpose:** Main layout untuk authenticated users

**Features:**
- Navigation bar dengan user menu
- Sidebar (jika diperlukan)
- Flash messages (success/error)
- Favicon support
- Application name dari config

**Sections:**
- `@yield('title')` - Page title
- `@yield('content')` - Main content

**Components Used:**
- `@include('layouts.navigation')` - Navigation bar
- Alpine.js untuk dropdown dan interactivity

---

### 2. guest.blade.php
**File:** `resources/views/layouts/guest.blade.php`

**Purpose:** Layout untuk unauthenticated users (login, register)

**Features:**
- Simple layout tanpa navigation
- Favicon support
- Application name

**Sections:**
- `@yield('title')` - Page title
- `@yield('content')` - Main content

---

### 3. navigation.blade.php
**File:** `resources/views/layouts/navigation.blade.php`

**Purpose:** Navigation bar component

**Features:**
- Responsive navigation dengan Alpine.js
- Role-based menu items
- User dropdown menu
- Mobile hamburger menu

**Menu Items:**
- **Public:** Home, About, Courses
- **Student:** Dashboard, My Courses, Profile
- **Teacher:** Dashboard, My Courses, Profile
- **Admin:** Dashboard, Users, Courses, Categories, Profile

---

## Public Views

### 1. home.blade.php
**File:** `resources/views/home.blade.php`

**Purpose:** Homepage dengan course catalog

**Features:**
- Hero section dengan statistik
- Search functionality
- Category filter
- Top 5 popular courses
- Course cards dengan image variations
- Progress indicator untuk enrolled students

**Variables:**
- `$courses` - List of courses
- `$categories` - List of categories
- `$stats` - Statistics (courses, categories, teachers, students)

---

### 2. about.blade.php
**File:** `resources/views/about.blade.php`

**Purpose:** About page

**Features:**
- Information about EduTrack LMS
- Features list
- Contact information

---

### 3. courses/catalog.blade.php
**File:** `resources/views/courses/catalog.blade.php`

**Purpose:** Full course catalog page

**Features:**
- List semua course aktif
- Search dan filter
- Pagination
- Course cards dengan image variations

---

### 4. courses/public/show.blade.php
**File:** `resources/views/courses/public/show.blade.php`

**Purpose:** Public course detail page

**Features:**
- Course information
- Teacher information
- Lesson list
- Enroll button (untuk student)
- Certificate button (jika sudah selesai)
- Progress indicator (jika enrolled)

**Variables:**
- `$course` - Course model dengan relationships
- `$isEnrolled` - Boolean apakah student sudah enroll
- `$studentProgress` - Progress percentage (0-100)

---

## Admin Views

### 1. admin/dashboard.blade.php
**File:** `resources/views/admin/dashboard.blade.php`

**Purpose:** Admin dashboard

**Features:**
- Statistics cards (users, courses, categories, lessons, enrollments)
- Recent activities
- Quick actions

**Variables:**
- `$stats` - Statistics array

---

### 2. categories/index.blade.php
**File:** `resources/views/categories/index.blade.php`

**Purpose:** List semua categories

**Features:**
- Table dengan categories
- Create button
- Edit/Delete actions
- Search functionality

---

### 3. categories/create.blade.php & edit.blade.php
**Purpose:** Form create/edit category

**Fields:**
- Name
- Description
- Is Active (checkbox)

**Validation:**
- Menggunakan `CategoryStoreRequest` dan `CategoryUpdateRequest`
- Error messages ditampilkan otomatis oleh Laravel

---

### 4. courses/admin/index.blade.php
**File:** `resources/views/courses/admin/index.blade.php`

**Purpose:** List semua courses (admin view)

**Features:**
- Table dengan courses
- Teacher information
- Category information
- Active status
- Actions (edit, delete)

---

### 5. courses/admin/create.blade.php & edit.blade.php
**Purpose:** Form create/edit course (admin)

**Fields:**
- Name
- Description
- Start Date
- End Date
- Category (dropdown)
- Teacher (dropdown - admin only)
- Is Active (checkbox)

**Validation:**
- Menggunakan `CourseStoreRequest` dan `CourseUpdateRequest`
- Custom error messages dalam bahasa Indonesia

---

### 6. users/admin/index.blade.php
**File:** `resources/views/users/admin/index.blade.php`

**Purpose:** List semua users

**Features:**
- Table dengan users
- Role badges
- Active status
- Search dan filter
- Pagination
- Actions (edit, delete)

---

### 7. users/admin/create.blade.php & edit.blade.php
**Purpose:** Form create/edit user

**Fields:**
- Name
- Username
- Email
- Password (create only)
- Role (dropdown)
- Is Active (checkbox)

**Validation:**
- Menggunakan `UserStoreRequest` dan `UserUpdateRequest`
- Custom error messages dalam bahasa Indonesia

---

## Teacher Views

### 1. teacher/dashboard.blade.php
**File:** `resources/views/teacher/dashboard.blade.php`

**Purpose:** Teacher dashboard

**Features:**
- List courses milik teacher
- Statistics (total courses, students, lessons)
- Quick actions

**Variables:**
- `$courses` - Teacher's courses
- `$stats` - Statistics

---

### 2. courses/teacher/index.blade.php
**File:** `resources/views/courses/teacher/index.blade.php`

**Purpose:** List courses milik teacher

**Features:**
- Course cards dengan image variations
- Create course button
- Edit/Delete actions
- Student count

---

### 3. courses/teacher/create.blade.php & edit.blade.php
**Purpose:** Form create/edit course (teacher)

**Fields:**
- Name
- Description
- Start Date
- End Date
- Category (dropdown)
- Is Active (checkbox)

**Note:** Teacher tidak bisa pilih teacher lain (auto-assigned)

**Validation:**
- Menggunakan `CourseStoreRequest` dan `CourseUpdateRequest`

---

### 4. lessons/index.blade.php
**File:** `resources/views/lessons/index.blade.php`

**Purpose:** List lessons dalam course

**Features:**
- Table dengan lessons
- Order indicator
- Create lesson button
- Edit/Delete actions

**Variables:**
- `$course` - Course model
- `$lessons` - List of lessons

---

### 5. lessons/create.blade.php & edit.blade.php
**Purpose:** Form create/edit lesson

**Fields:**
- Title
- Content (textarea/rich text)
- Order

**Validation:**
- Menggunakan `LessonStoreRequest` dan `LessonUpdateRequest`
- Custom error messages dalam bahasa Indonesia

---

### 6. lessons/show.blade.php
**File:** `resources/views/lessons/show.blade.php`

**Purpose:** Lesson detail view

**Features:**
- Lesson content
- Navigation (previous/next lesson)
- Progress indicator (untuk student)
- Mark as done button (untuk student)

**Variables:**
- `$course` - Course model
- `$lesson` - Lesson model
- `$progress` - Student progress (jika student)
- `$isDone` - Boolean apakah lesson sudah selesai

---

## Student Views

### 1. dashboard.blade.php
**File:** `resources/views/dashboard.blade.php`

**Purpose:** General dashboard (redirects berdasarkan role)

---

### 2. profile/student.blade.php
**File:** `resources/views/profile/student.blade.php`

**Purpose:** Student profile dengan enrolled courses

**Features:**
- Enrolled courses list
- Progress per course
- Certificate download button (jika sudah selesai)
- Course cards dengan image variations

**Variables:**
- `$enrolledCourses` - Courses yang di-enroll
- Progress calculated per course

---

## Profile Views

### 1. profile/index.blade.php
**File:** `resources/views/profile/index.blade.php`

**Purpose:** Profile overview

**Features:**
- User information
- Role-specific content
- Links ke edit profile

---

### 2. profile/edit.blade.php
**File:** `resources/views/profile/edit.blade.php`

**Purpose:** Edit profile form

**Features:**
- Update profile information
- Update password
- Delete account

**Components:**
- `@include('profile.partials.update-profile-information-form')`
- `@include('profile.partials.update-password-form')`
- `@include('profile.partials.delete-user-form')`

**Validation:**
- Menggunakan `ProfileUpdateRequest` untuk update profile

---

## Authentication Views

### Directory: `resources/views/auth/`

**Files:**
- `login.blade.php` - Login form
- `register.blade.php` - Registration form
- `forgot-password.blade.php` - Password reset request
- `reset-password.blade.php` - Password reset form
- `verify-email.blade.php` - Email verification prompt
- `confirm-password.blade.php` - Password confirmation

**Features:**
- Form validation dengan error messages
- Success messages
- Links ke related pages

**Validation:**
- Login menggunakan `LoginRequest` dengan rate limiting

---

## Certificate Views

### 1. certificates/pdf.blade.php
**File:** `resources/views/certificates/pdf.blade.php`

**Purpose:** PDF template untuk certificate

**Features:**
- Professional certificate design
- A4 landscape format
- Decorative borders
- Student name
- Course title
- Issue date
- Instructor signature
- Certificate number

**Variables:**
- `$studentName` - Student name
- `$courseTitle` - Course name
- `$date` - Issue date (formatted)
- `$instructor` - Instructor name
- `$certificateNumber` - Certificate number

**Styling:**
- Custom CSS untuk PDF
- Print-optimized colors
- Professional typography

**Error Handling:**
- Jika PDF generation gagal, error ditangani di controller dan user mendapat error message

---

## Components

### Directory: `resources/views/components/`

**Reusable Components:**
- `auth-session-status.blade.php` - Session status message
- `danger-button.blade.php` - Danger button component
- `dropdown.blade.php` - Dropdown component
- `input-error.blade.php` - Input error message
- `input-label.blade.php` - Input label
- `modal.blade.php` - Modal component
- `primary-button.blade.php` - Primary button
- `secondary-button.blade.php` - Secondary button
- `text-input.blade.php` - Text input component

---

## Blade Directives

### Common Directives Used:

```blade
@auth
    // Content for authenticated users
@endauth

@guest
    // Content for guests
@endguest

@if(auth()->user()->isAdmin())
    // Admin only content
@endif

@foreach($items as $item)
    // Loop content
@endforeach

@include('partials.header')

@yield('content')

@section('title')
    Page Title
@endsection
```

---

## Alpine.js Integration

### Usage in Views:
```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```

**Common Patterns:**
- Dropdown menus
- Mobile navigation
- Modal dialogs
- Form interactions

---

## Image Variations

### Dynamic Image System:
```php
$courseImages = [
    'https://images.unsplash.com/photo-...',
    'https://images.unsplash.com/photo-...',
    // ... more images
];
```

**Usage:**
```blade
<img src="{{ $courseImages[$index % count($courseImages)] }}" />
```

**Purpose:** Menghindari gambar monoton dengan rotasi gambar.

---

## Form Validation Display

### Error Messages:
Laravel otomatis menampilkan error messages dari Form Request:

```blade
@error('name')
    <span class="text-red-500">{{ $message }}</span>
@enderror
```

**Custom Messages:**
Form Request classes memiliki custom error messages dalam bahasa Indonesia:
- `CourseStoreRequest` - Messages untuk course validation
- `LessonStoreRequest` - Messages untuk lesson validation
- `CategoryStoreRequest` - Messages untuk category validation
- `UserStoreRequest` - Messages untuk user validation

---

## Best Practices

1. **Layouts:** Gunakan layouts untuk consistency
2. **Components:** Extract reusable components
3. **Sections:** Gunakan `@yield` dan `@section` untuk flexibility
4. **Variables:** Pass only necessary variables ke views
5. **Eager Loading:** Load relationships di controller, bukan di view
6. **Security:** Escape output dengan `{{ }}` (auto-escaped)
7. **Raw Output:** Gunakan `{!! !!}` hanya untuk trusted HTML
8. **Conditional:** Gunakan `@if`, `@auth`, `@guest` untuk conditional rendering
9. **Error Handling:** Display user-friendly error messages
10. **Form Requests:** Views otomatis mendapat error messages dari Form Request

---

## View Caching

Laravel caches compiled Blade templates untuk performance.

**Clear View Cache:**
```bash
php artisan view:clear
```

**Cache Views:**
```bash
php artisan view:cache
```

