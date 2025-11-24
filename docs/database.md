# Database Documentation

## Overview
Database schema EduTrack LMS menggunakan Laravel Migrations. Semua migration files berada di `database/migrations/`.

---

## Database Tables

### 1. users
**Migration:** `0001_01_01_000000_create_users_table.php` + `2025_11_16_105229_add_username_role_and_is_active_to_users_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `name` - Nama user (string)
- `username` - Username unik (string, unique)
- `email` - Email unik (string, unique)
- `email_verified_at` - Waktu verifikasi email (timestamp, nullable)
- `password` - Password hashed (string)
- `role` - Role: admin, teacher, student (string)
- `is_active` - Status aktif (boolean, default: true)
- `remember_token` - Remember token (string, nullable)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`
- Unique: `email`, `username`

---

### 2. categories
**Migration:** `2025_11_16_112054_create_categories_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `name` - Nama kategori (string)
- `description` - Deskripsi (text, nullable)
- `is_active` - Status aktif (boolean, default: true)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`

---

### 3. courses
**Migration:** `2025_11_16_113059_create_courses_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `name` - Nama course (string)
- `description` - Deskripsi course (text, nullable)
- `start_date` - Tanggal mulai (date)
- `end_date` - Tanggal selesai (date)
- `is_active` - Status aktif (boolean, default: true)
- `category_id` - Foreign key ke categories (bigint)
- `teacher_id` - Foreign key ke users (bigint)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`
- Foreign key: `category_id` → `categories.id` (CASCADE on delete)
- Foreign key: `teacher_id` → `users.id` (CASCADE on delete)

**Constraints:**
- `end_date` harus >= `start_date` (validated di Form Request)

---

### 4. lessons
**Migration:** `2025_11_16_113811_create_lessons_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `course_id` - Foreign key ke courses (bigint)
- `title` - Judul lesson (string)
- `content` - Konten lesson (text)
- `order` - Urutan lesson (integer)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`
- Foreign key: `course_id` → `courses.id` (CASCADE on delete)

---

### 5. course_student (Pivot Table)
**Migration:** `2025_11_16_114659_create_course_student_table.php`

**Fields:**
- `course_id` - Foreign key ke courses (bigint)
- `student_id` - Foreign key ke users (bigint)
- `enrolled_at` - Waktu enroll (timestamp)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: composite (`course_id`, `student_id`)
- Foreign key: `course_id` → `courses.id` (CASCADE on delete)
- Foreign key: `student_id` → `users.id` (CASCADE on delete)

**Purpose:** Many-to-many relationship untuk enrollment

---

### 6. lesson_progress
**Migration:** `2025_11_16_114708_create_lesson_progress_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `lesson_id` - Foreign key ke lessons (bigint)
- `student_id` - Foreign key ke users (bigint)
- `is_done` - Status selesai (boolean, default: false)
- `done_at` - Waktu selesai (timestamp, nullable)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`
- Unique: composite (`lesson_id`, `student_id`)
- Foreign key: `lesson_id` → `lessons.id` (CASCADE on delete)
- Foreign key: `student_id` → `users.id` (CASCADE on delete)

**Purpose:** Track progress student per lesson

---

### 7. certificates
**Migration:** `2025_11_24_114718_create_certificates_table.php`

**Fields:**
- `id` - Primary key (bigint)
- `student_id` - Foreign key ke users (bigint)
- `course_id` - Foreign key ke courses (bigint)
- `certificate_number` - Nomor sertifikat (string, unique)
- `issued_at` - Waktu dikeluarkan (timestamp)
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- Primary key: `id`
- Unique: `certificate_number`
- Unique: composite (`student_id`, `course_id`)
- Foreign key: `student_id` → `users.id` (CASCADE on delete)
- Foreign key: `course_id` → `courses.id` (CASCADE on delete)

**Purpose:** Menyimpan certificate yang dikeluarkan untuk student yang menyelesaikan course

---

## System Tables (Laravel Default)

### cache
**Migration:** `0001_01_01_000001_create_cache_table.php`

**Purpose:** Laravel cache storage

---

### jobs
**Migration:** `0001_01_01_000002_create_jobs_table.php`

**Purpose:** Laravel queue jobs

---

## Database Relationships

### Entity Relationship Diagram (Simplified)

```
users (Teacher)
  │
  └─── courses
        │
        ├─── categories
        │
        ├─── lessons
        │      │
        │      └─── lesson_progress
        │             │
        │             └─── users (Student)
        │
        ├─── course_student (pivot)
        │      │
        │      └─── users (Student)
        │
        └─── certificates
               │
               └─── users (Student)
```

---

## Foreign Key Constraints

### CASCADE on Delete
Semua foreign keys menggunakan `onDelete('cascade')`, artinya:
- Jika parent dihapus, child juga terhapus
- Contoh: Jika course dihapus, semua lessons, enrollments, dan certificates terkait juga terhapus

### Foreign Keys:
1. `courses.category_id` → `categories.id`
2. `courses.teacher_id` → `users.id`
3. `lessons.course_id` → `courses.id`
4. `course_student.course_id` → `courses.id`
5. `course_student.student_id` → `users.id`
6. `lesson_progress.lesson_id` → `lessons.id`
7. `lesson_progress.student_id` → `users.id`
8. `certificates.student_id` → `users.id`
9. `certificates.course_id` → `courses.id`

---

## Unique Constraints

1. **users.email** - Email harus unik
2. **users.username** - Username harus unik
3. **certificates.certificate_number** - Nomor sertifikat harus unik
4. **certificates (student_id, course_id)** - Satu student hanya bisa punya satu certificate per course
5. **lesson_progress (lesson_id, student_id)** - Satu student hanya punya satu progress per lesson
6. **course_student (course_id, student_id)** - Satu student hanya bisa enroll sekali per course

---

## Indexes

### Primary Keys
Semua tabel memiliki `id` sebagai primary key (bigint, auto increment)

### Foreign Key Indexes
Semua foreign key fields otomatis ter-index untuk performa query

### Composite Indexes
- `course_student`: (`course_id`, `student_id`)
- `lesson_progress`: (`lesson_id`, `student_id`)
- `certificates`: (`student_id`, `course_id`)

---

## Data Types

### Common Types:
- **bigint** - ID dan foreign keys
- **string** - Nama, email, username (max 255 chars)
- **text** - Deskripsi, konten (unlimited)
- **boolean** - Status flags (is_active, is_done)
- **date** - Tanggal (start_date, end_date)
- **timestamp** - Waktu (created_at, updated_at, enrolled_at, done_at, issued_at)
- **integer** - Urutan (order)

---

## Database Transactions

### Usage in Controllers

**EnrollmentController::markAsDone()**
```php
DB::transaction(function () use ($lesson, $user) {
    // Update lesson progress
    // Create certificate if progress 100%
});
```

**CertificateController::generate()**
```php
DB::transaction(function () use ($user, $course) {
    // Create certificate
});
```

**Manfaat:**
- Atomicity: Semua operasi berhasil atau semua gagal
- Data consistency: Mencegah data tidak konsisten
- Error handling: Rollback otomatis jika ada error

---

## Migration Best Practices

1. **Naming:** Format: `YYYY_MM_DD_HHMMSS_description.php`
2. **Up/Down:** Selalu implement `up()` dan `down()` methods
3. **Foreign Keys:** Gunakan `constrained()` untuk foreign keys
4. **Cascade:** Pertimbangkan `onDelete('cascade')` untuk data integrity
5. **Indexes:** Tambahkan indexes untuk fields yang sering di-query
6. **Defaults:** Set default values untuk fields yang perlu
7. **Unique Constraints:** Tambahkan unique constraints untuk data integrity

---

## Seeding

**Seeder:** `database/seeders/DemoSeeder.php`

**Data yang di-seed:**
- 1 Admin user
- Multiple Teacher users
- Multiple Student users
- Multiple Categories
- Multiple Courses dengan Lessons
- Sample Enrollments
- Sample Lesson Progress

**Command:**
```bash
php artisan db:seed
```

---

## Database Configuration

**File:** `config/database.php`

**Default Connection:** SQLite (development)
**Production:** MySQL/MariaDB (configure di `.env`)

**Environment Variables:**
- `DB_CONNECTION` - Database driver (sqlite, mysql, etc.)
- `DB_DATABASE` - Database name
- `DB_HOST` - Database host
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password

---

## Query Optimization

### Eager Loading
```php
// Good: Eager load relationships
Course::with(['teacher', 'category', 'students'])->get();

// Bad: N+1 query problem
$courses = Course::all();
foreach ($courses as $course) {
    $course->teacher; // Query executed for each course
}
```

### Query Scopes
```php
// Use scopes for common queries
Course::active()->byCategory($categoryId)->get();
```

### Indexes
- Foreign keys sudah ter-index otomatis
- Composite indexes untuk unique constraints
- Consider adding indexes untuk frequently queried fields

