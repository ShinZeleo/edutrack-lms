# Database Documentation

## Overview
Database schema EduTrack LMS menggunakan Laravel Migrations. Semua migration files berada di `database/migrations/`. Database menggunakan MySQL dengan InnoDB engine untuk foreign key constraints dan transactions.

**Database Features:**
- Foreign key constraints dengan CASCADE on delete
- Unique constraints untuk data integrity
- Indexes untuk query optimization
- Timestamps untuk audit trail
- Soft deletes (jika diperlukan)

---

## Database Tables

### 1. users
**Migration:**
- `0001_01_01_000000_create_users_table.php` (base table)
- `2025_11_16_105229_add_username_role_and_is_active_to_users_table.php` (additions)

**Purpose:** Menyimpan data user (admin, teacher, student)

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | User ID |
| `name` | varchar(255) | NOT NULL | Nama lengkap user |
| `username` | varchar(255) | UNIQUE, NULLABLE | Username unik (optional) |
| `email` | varchar(255) | UNIQUE, NOT NULL | Email unik |
| `email_verified_at` | timestamp | NULLABLE | Waktu verifikasi email |
| `password` | varchar(255) | NOT NULL | Password (hashed) |
| `role` | enum | NOT NULL, DEFAULT 'student' | Role: 'admin', 'teacher', 'student' |
| `is_active` | boolean | NOT NULL, DEFAULT true | Status aktif/nonaktif |
| `remember_token` | varchar(100) | NULLABLE | Remember token untuk "remember me" |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE: `email`
- UNIQUE: `username`
- INDEX: `email` (for quick lookups)

**Relationships:**
- `hasMany` → `courses` (as teacher)
- `belongsToMany` → `courses` (as student, pivot: `course_student`)
- `hasMany` → `lesson_progress`
- `hasMany` → `certificates` (as student)

**Cascade Delete:**
- Jika user (teacher) dihapus → semua courses miliknya terhapus
- Jika user (student) dihapus → semua enrollments, progress, dan certificates terhapus

---

### 2. categories
**Migration:** `2025_11_16_112054_create_categories_table.php`

**Purpose:** Menyimpan kategori course

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Category ID |
| `name` | varchar(255) | NOT NULL | Nama kategori |
| `description` | text | NULLABLE | Deskripsi kategori |
| `is_active` | boolean | NOT NULL, DEFAULT true | Status aktif/nonaktif |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`

**Relationships:**
- `hasMany` → `courses`

**Cascade Delete:**
- Jika category dihapus → semua courses dengan category tersebut terhapus

**Note:** Category tidak bisa dihapus jika masih ada courses yang menggunakan category tersebut (foreign key constraint).

---

### 3. courses
**Migration:** `2025_11_16_113059_create_courses_table.php`

**Purpose:** Menyimpan data course

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Course ID |
| `name` | varchar(255) | NOT NULL | Nama course |
| `description` | text | NULLABLE | Deskripsi course |
| `start_date` | date | NOT NULL | Tanggal mulai course |
| `end_date` | date | NOT NULL | Tanggal selesai course |
| `is_active` | boolean | NOT NULL, DEFAULT true | Status aktif/nonaktif |
| `category_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke categories |
| `teacher_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke users (teacher) |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `category_id` → `categories.id` (CASCADE on delete)
- FOREIGN KEY: `teacher_id` → `users.id` (CASCADE on delete)

**Constraints:**
- `end_date` harus >= `start_date` (validated di Form Request, bukan di database level)

**Relationships:**
- `belongsTo` → `category`
- `belongsTo` → `teacher` (User)
- `belongsToMany` → `students` (User, pivot: `course_student`)
- `hasMany` → `lessons`
- `hasMany` → `certificates`

**Cascade Delete:**
- Jika course dihapus → semua lessons, enrollments, dan certificates terkait terhapus

---

### 4. lessons
**Migration:** `2025_11_16_113811_create_lessons_table.php`

**Purpose:** Menyimpan data lesson dalam course

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Lesson ID |
| `course_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke courses |
| `title` | varchar(255) | NOT NULL | Judul lesson |
| `content` | longtext | NOT NULL | Konten lesson (HTML/text) |
| `order` | integer | NOT NULL, DEFAULT 0 | Urutan lesson dalam course |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- FOREIGN KEY: `course_id` → `courses.id` (CASCADE on delete)

**Relationships:**
- `belongsTo` → `course`
- `hasMany` → `lesson_progress`

**Cascade Delete:**
- Jika lesson dihapus → semua lesson_progress terkait terhapus

**Ordering:**
- Lessons di-ordered berdasarkan field `order` (ascending)

---

### 5. course_student (Pivot Table)
**Migration:** `2025_11_16_114659_create_course_student_table.php`

**Purpose:** Menyimpan relasi many-to-many antara courses dan students (enrollment)

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Pivot ID |
| `course_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke courses |
| `student_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke users (student) |
| `enrolled_at` | timestamp | NULLABLE | Waktu enrollment |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE: `(course_id, student_id)` - Mencegah duplicate enrollment
- FOREIGN KEY: `course_id` → `courses.id` (CASCADE on delete)
- FOREIGN KEY: `student_id` → `users.id` (CASCADE on delete)

**Relationships:**
- Pivot table untuk `Course` ↔ `User` (student) many-to-many relationship

**Cascade Delete:**
- Jika course dihapus → semua enrollments terkait terhapus
- Jika student dihapus → semua enrollments terkait terhapus

**Unique Constraint:**
- Satu student tidak bisa enroll dua kali ke course yang sama

---

### 6. lesson_progress
**Migration:** `2025_11_16_114708_create_lesson_progress_table.php`

**Purpose:** Menyimpan progress lesson untuk setiap student

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Progress ID |
| `lesson_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke lessons |
| `student_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke users (student) |
| `is_done` | boolean | NOT NULL, DEFAULT false | Status selesai/belum |
| `done_at` | timestamp | NULLABLE | Waktu selesai |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE: `(lesson_id, student_id)` - Satu student hanya punya satu progress per lesson
- FOREIGN KEY: `lesson_id` → `lessons.id` (CASCADE on delete)
- FOREIGN KEY: `student_id` → `users.id` (CASCADE on delete)

**Relationships:**
- `belongsTo` → `lesson`
- `belongsTo` → `student` (User)

**Cascade Delete:**
- Jika lesson dihapus → semua progress terkait terhapus
- Jika student dihapus → semua progress terkait terhapus

**Unique Constraint:**
- Satu student hanya punya satu progress record per lesson

**Usage:**
- Track completion status untuk setiap lesson
- Calculate course progress: `(done lessons / total lessons) * 100`

---

### 7. certificates
**Migration:** `2025_11_24_114718_create_certificates_table.php`

**Purpose:** Menyimpan certificate yang dikeluarkan untuk student yang menyelesaikan course

**Fields:**

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | bigint unsigned | PRIMARY KEY, AUTO_INCREMENT | Certificate ID |
| `student_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke users (student) |
| `course_id` | bigint unsigned | FOREIGN KEY, NOT NULL | Foreign key ke courses |
| `certificate_number` | varchar(255) | UNIQUE, NOT NULL | Nomor sertifikat (format: CERT-{UNIQUE_ID}) |
| `issued_at` | date | NOT NULL | Tanggal dikeluarkan |
| `created_at` | timestamp | NULLABLE | Waktu dibuat |
| `updated_at` | timestamp | NULLABLE | Waktu diupdate |

**Indexes:**
- PRIMARY KEY: `id`
- UNIQUE: `certificate_number` - Nomor sertifikat harus unik
- UNIQUE: `(student_id, course_id)` - Satu student hanya punya satu certificate per course
- FOREIGN KEY: `student_id` → `users.id` (CASCADE on delete)
- FOREIGN KEY: `course_id` → `courses.id` (CASCADE on delete)

**Relationships:**
- `belongsTo` → `student` (User)
- `belongsTo` → `course`

**Cascade Delete:**
- Jika student dihapus → semua certificates terkait terhapus
- Jika course dihapus → semua certificates terkait terhapus

**Unique Constraints:**
- Satu student hanya bisa punya satu certificate per course
- Certificate number harus unik

**Certificate Generation:**
- Auto-generated saat student menyelesaikan course (progress = 100%)
- Format: `CERT-{UNIQUE_ID}` (uppercase)
- Example: `CERT-67890ABCDEF123`

---

## System Tables (Laravel Default)

### password_reset_tokens
**Migration:** `0001_01_01_000000_create_users_table.php`

**Purpose:** Menyimpan password reset tokens (Laravel default)

**Fields:**
- `email` (PRIMARY KEY)
- `token`
- `created_at`

**Note:** Fitur password reset saat ini disabled (coming soon).

---

### sessions
**Migration:** `0001_01_01_000000_create_users_table.php`

**Purpose:** Menyimpan session data (Laravel default)

**Fields:**
- `id` (PRIMARY KEY)
- `user_id` (FOREIGN KEY, nullable)
- `ip_address`
- `user_agent`
- `payload`
- `last_activity`

---

## Database Relationships

### Entity Relationship Diagram (ERD)

```
users (Teacher)
  │
  └─── hasMany ───> courses
        │
        ├─── belongsTo ───> categories
        │
        ├─── belongsTo ───> users (Teacher)
        │
        ├─── belongsToMany ───> users (Student) [pivot: course_student]
        │      │
        │      └─── enrolled_at (pivot column)
        │
        ├─── hasMany ───> lessons
        │      │
        │      └─── hasMany ───> lesson_progress
        │             │
        │             ├─── belongsTo ───> lessons
        │             │
        │             └─── belongsTo ───> users (Student)
        │
        └─── hasMany ───> certificates
               │
               ├─── belongsTo ───> users (Student)
               │
               └─── belongsTo ───> courses
```

---

## Foreign Key Constraints

### CASCADE on Delete
Semua foreign keys menggunakan `onDelete('cascade')`, artinya:
- Jika parent dihapus, child juga terhapus
- Memastikan data integrity
- Mencegah orphaned records

### Foreign Keys:

1. **courses.category_id** → `categories.id`
   - Jika category dihapus → semua courses dengan category tersebut terhapus

2. **courses.teacher_id** → `users.id`
   - Jika teacher dihapus → semua courses miliknya terhapus

3. **lessons.course_id** → `courses.id`
   - Jika course dihapus → semua lessons dalam course tersebut terhapus

4. **course_student.course_id** → `courses.id`
   - Jika course dihapus → semua enrollments terkait terhapus

5. **course_student.student_id** → `users.id`
   - Jika student dihapus → semua enrollments terkait terhapus

6. **lesson_progress.lesson_id** → `lessons.id`
   - Jika lesson dihapus → semua progress terkait terhapus

7. **lesson_progress.student_id** → `users.id`
   - Jika student dihapus → semua progress terkait terhapus

8. **certificates.student_id** → `users.id`
   - Jika student dihapus → semua certificates terkait terhapus

9. **certificates.course_id** → `courses.id`
   - Jika course dihapus → semua certificates terkait terhapus

---

## Unique Constraints

### Single Column Unique:
- `users.email` - Email harus unik
- `users.username` - Username harus unik (nullable)
- `certificates.certificate_number` - Nomor sertifikat harus unik

### Composite Unique:
- `course_student(course_id, student_id)` - Satu student tidak bisa enroll dua kali ke course yang sama
- `lesson_progress(lesson_id, student_id)` - Satu student hanya punya satu progress per lesson
- `certificates(student_id, course_id)` - Satu student hanya punya satu certificate per course

---

## Indexes

### Primary Keys:
- Semua tables memiliki `id` sebagai PRIMARY KEY (bigint unsigned, auto increment)

### Foreign Key Indexes:
- Semua foreign keys otomatis ter-index untuk query optimization

### Unique Indexes:
- `users.email`
- `users.username`
- `certificates.certificate_number`
- Composite unique indexes untuk pivot tables

---

## Data Types

### String Types:
- `varchar(255)` - Untuk nama, email, title (variable length)
- `text` - Untuk description (longer text)
- `longtext` - Untuk lesson content (very long text)

### Numeric Types:
- `bigint unsigned` - Untuk IDs dan foreign keys
- `integer` - Untuk order, counts
- `boolean` - Untuk flags (is_active, is_done)

### Date/Time Types:
- `date` - Untuk start_date, end_date, issued_at
- `timestamp` - Untuk created_at, updated_at, done_at, enrolled_at
- `timestamp nullable` - Untuk optional timestamps

### Enum Types:
- `enum('admin', 'teacher', 'student')` - Untuk user role

---

## Migration Execution Order

Migrations dijalankan berdasarkan timestamp:

1. `0001_01_01_000000_create_users_table.php` - Base users table
2. `2025_11_16_105229_add_username_role_and_is_active_to_users_table.php` - Add fields to users
3. `2025_11_16_112054_create_categories_table.php` - Categories
4. `2025_11_16_113059_create_courses_table.php` - Courses (depends on categories and users)
5. `2025_11_16_113811_create_lessons_table.php` - Lessons (depends on courses)
6. `2025_11_16_114659_create_course_student_table.php` - Enrollment pivot (depends on courses and users)
7. `2025_11_16_114708_create_lesson_progress_table.php` - Progress (depends on lessons and users)
8. `2025_11_24_114718_create_certificates_table.php` - Certificates (depends on courses and users)

---

## Database Seeding

**Seeder:** `database/seeders/DemoSeeder.php`

**Purpose:** Generate dummy data untuk development dan testing

**Data Generated:**
- Users (admin, teachers, students)
- Categories
- Courses dengan lessons
- Enrollments
- Progress data
- Certificates (auto-generated saat progress 100%)

**Usage:**
```bash
php artisan db:seed --class=DemoSeeder
```

---

## Query Optimization

### Eager Loading
Gunakan eager loading untuk menghindari N+1 queries:

```php
// Bad: N+1 queries
$courses = Course::all();
foreach ($courses as $course) {
    echo $course->teacher->name; // Query per course
}

// Good: Single query
$courses = Course::with('teacher')->get();
foreach ($courses as $course) {
    echo $course->teacher->name; // No additional queries
}
```

### Indexes
Semua foreign keys dan unique columns sudah ter-index untuk optimal performance.

### Pagination
Gunakan pagination untuk large datasets:

```php
$courses = Course::paginate(10);
```

---

## Best Practices

1. **Always use migrations** untuk schema changes
2. **Use foreign key constraints** untuk data integrity
3. **Use unique constraints** untuk prevent duplicates
4. **Use indexes** untuk query optimization
5. **Use CASCADE on delete** untuk automatic cleanup
6. **Use timestamps** untuk audit trail
7. **Use transactions** untuk atomic operations
8. **Use eager loading** untuk avoid N+1 queries
9. **Use pagination** untuk large datasets
10. **Backup database** regularly

---

## Database Backup & Restore

### Backup:
```bash
mysqldump -u username -p database_name > backup.sql
```

### Restore:
```bash
mysql -u username -p database_name < backup.sql
```

---

## Migration Commands

### Run Migrations:
```bash
php artisan migrate
```

### Rollback Last Migration:
```bash
php artisan migrate:rollback
```

### Rollback All Migrations:
```bash
php artisan migrate:reset
```

### Refresh Database:
```bash
php artisan migrate:refresh
```

### Fresh Migration (Drop All & Recreate):
```bash
php artisan migrate:fresh
```

### Fresh Migration with Seeding:
```bash
php artisan migrate:fresh --seed
```
