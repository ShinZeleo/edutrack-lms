# Models Documentation

## Overview
Models di EduTrack LMS menggunakan Eloquent ORM untuk berinteraksi dengan database. Semua models berada di `app/Models/`.

---

## Main Models

### 1. User
**File:** `app/Models/User.php`

**Table:** `users`

**Fillable Fields:**
- `name` - Nama user
- `username` - Username unik
- `email` - Email unik
- `password` - Password (hashed)
- `role` - Role: admin, teacher, atau student
- `is_active` - Status aktif/nonaktif

**Relationships:**
- `courses()` - hasMany: Course yang dibuat (jika teacher)
- `enrolledCourses()` - belongsToMany: Course yang di-enroll (jika student)
- `lessonProgress()` - hasMany: Progress lesson
- `certificates()` - hasMany: Certificate yang dimiliki

**Scopes:**
- `active()` - Filter user yang aktif
- `role($role)` - Filter berdasarkan role

**Methods:**
- `isAdmin()` - Cek apakah admin
- `isTeacher()` - Cek apakah teacher
- `isStudent()` - Cek apakah student
- `getRoleLabelAttribute()` - Get role label (capitalized)

**Casts:**
- `email_verified_at` - datetime
- `password` - hashed
- `is_active` - boolean

---

### 2. Category
**File:** `app/Models/Category.php`

**Table:** `categories`

**Fillable Fields:**
- `name` - Nama kategori
- `description` - Deskripsi kategori
- `is_active` - Status aktif/nonaktif

**Relationships:**
- `courses()` - hasMany: Course dalam kategori ini

**Scopes:**
- `active()` - Filter kategori yang aktif

**Casts:**
- `is_active` - boolean

---

### 3. Course
**File:** `app/Models/Course.php`

**Table:** `courses`

**Fillable Fields:**
- `name` - Nama course
- `description` - Deskripsi course
- `start_date` - Tanggal mulai
- `end_date` - Tanggal selesai
- `is_active` - Status aktif/nonaktif
- `category_id` - Foreign key ke categories
- `teacher_id` - Foreign key ke users (teacher)

**Relationships:**
- `category()` - belongsTo: Kategori course
- `teacher()` - belongsTo: Teacher yang membuat course
- `students()` - belongsToMany: Student yang enroll
- `lessons()` - hasMany: Lesson dalam course
- `certificates()` - hasMany: Certificate yang dikeluarkan

**Scopes:**
- `active()` - Filter course yang aktif
- `byCategory($categoryId)` - Filter berdasarkan kategori

**Methods:**
- `getProgressForUser($user)` - Hitung progress student dalam course (0-100%)

**Casts:**
- `start_date` - date
- `end_date` - date
- `is_active` - boolean

---

### 4. Lesson
**File:** `app/Models/Lesson.php`

**Table:** `lessons`

**Fillable Fields:**
- `course_id` - Foreign key ke courses
- `title` - Judul lesson
- `content` - Konten lesson (HTML/text)
- `order` - Urutan lesson

**Relationships:**
- `course()` - belongsTo: Course yang memiliki lesson ini
- `progress()` - hasMany: Progress student untuk lesson ini

**Scopes:**
- `ordered()` - Order by `order` field

---

### 5. LessonProgress
**File:** `app/Models/LessonProgress.php`

**Table:** `lesson_progress`

**Fillable Fields:**
- `lesson_id` - Foreign key ke lessons
- `student_id` - Foreign key ke users (student)
- `is_done` - Status selesai/belum
- `done_at` - Waktu selesai

**Relationships:**
- `lesson()` - belongsTo: Lesson
- `student()` - belongsTo: Student

**Casts:**
- `is_done` - boolean
- `done_at` - datetime

**Unique Constraint:**
- `lesson_id` + `student_id` (satu student hanya punya satu progress per lesson)

---

### 6. Certificate
**File:** `app/Models/Certificate.php`

**Table:** `certificates`

**Fillable Fields:**
- `student_id` - Foreign key ke users (student)
- `course_id` - Foreign key ke courses
- `certificate_number` - Nomor sertifikat (unique)
- `issued_at` - Waktu dikeluarkan

**Relationships:**
- `student()` - belongsTo: Student pemilik certificate
- `course()` - belongsTo: Course yang diselesaikan

**Casts:**
- `issued_at` - date

**Unique Constraints:**
- `certificate_number` - Unique
- `student_id` + `course_id` - Satu student hanya punya satu certificate per course

---

## Pivot Tables

### course_student
**Table:** `course_student`

**Fields:**
- `course_id` - Foreign key ke courses
- `student_id` - Foreign key ke users
- `enrolled_at` - Waktu enroll
- `created_at`, `updated_at` - Timestamps

**Purpose:** Many-to-many relationship antara Course dan Student (enrollment)

---

## Relationship Summary

```
User (Teacher)
  └── hasMany → Course
      ├── belongsTo → Category
      ├── belongsTo → User (Teacher)
      ├── belongsToMany → User (Student) [via course_student]
      ├── hasMany → Lesson
      └── hasMany → Certificate

User (Student)
  ├── belongsToMany → Course [via course_student]
  ├── hasMany → LessonProgress
  └── hasMany → Certificate

Category
  └── hasMany → Course

Lesson
  ├── belongsTo → Course
  └── hasMany → LessonProgress

LessonProgress
  ├── belongsTo → Lesson
  └── belongsTo → User (Student)

Certificate
  ├── belongsTo → User (Student)
  └── belongsTo → Course
```

---

## Common Patterns

### 1. Eager Loading
```php
Course::with(['teacher', 'category', 'students'])->get();
```

### 2. Query Scopes
```php
Course::active()->byCategory($categoryId)->get();
```

### 3. Accessor
```php
$user->role_label; // Returns "Admin", "Teacher", or "Student"
```

### 4. Relationship Access
```php
$course->students; // Get all enrolled students
$user->enrolledCourses; // Get all courses user enrolled in
```

### 5. Custom Methods
```php
$progress = $course->getProgressForUser($user); // Returns 0-100
```

### 6. Mass Assignment Protection
```php
// Only fillable fields can be mass assigned
User::create($request->only(['name', 'email', 'password']));
```

---

## Best Practices

1. **Fillable:** Hanya field yang bisa di-mass assign yang ada di `$fillable`
2. **Hidden:** Field sensitive (password, tokens) harus di `$hidden`
3. **Casts:** Gunakan casts untuk type conversion otomatis
4. **Relationships:** Define relationships untuk kemudahan query
5. **Scopes:** Gunakan scopes untuk query yang sering digunakan
6. **Validation:** Validasi di Form Request, bukan di model
7. **Eager Loading:** Gunakan `with()` untuk menghindari N+1 queries
8. **Accessors/Mutators:** Gunakan untuk transform data saat get/set

---

## Database Constraints

### Foreign Keys
- `courses.category_id` → `categories.id` (CASCADE on delete)
- `courses.teacher_id` → `users.id` (CASCADE on delete)
- `lessons.course_id` → `courses.id` (CASCADE on delete)
- `lesson_progress.lesson_id` → `lessons.id` (CASCADE on delete)
- `lesson_progress.student_id` → `users.id` (CASCADE on delete)
- `certificates.student_id` → `users.id` (CASCADE on delete)
- `certificates.course_id` → `courses.id` (CASCADE on delete)

### Unique Constraints
- `users.email` - Unique
- `users.username` - Unique
- `certificates.certificate_number` - Unique
- `certificates.student_id + course_id` - Unique (composite)
- `lesson_progress.lesson_id + student_id` - Unique (composite)

