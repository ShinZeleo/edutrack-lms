# Tests Documentation

## Overview
Tests di EduTrack LMS menggunakan PHPUnit. Semua test files berada di `tests/` directory.

---

## Test Structure

### Directory Structure
```
tests/
├── Feature/          # Feature tests (integration tests)
│   ├── Auth/         # Authentication tests
│   ├── EnrollmentTest.php
│   ├── HomepageTest.php
│   ├── CourseAuthorizationTest.php
│   ├── LessonAuthorizationTest.php
│   └── ProfileTest.php
└── TestCase.php      # Base test case class
```

---

## Feature Tests

### 1. Authentication Tests
**Directory:** `tests/Feature/Auth/`

#### AuthenticationTest.php
**Tests:**
- User dapat melihat login form
- User dapat login dengan credentials valid
- User tidak bisa login dengan credentials invalid
- User dapat logout

#### RegistrationTest.php
**Tests:**
- User dapat melihat registration form
- User dapat register dengan data valid
- User tidak bisa register dengan email duplikat
- Password harus dikonfirmasi

#### PasswordResetTest.php
**Tests:**
- User dapat request password reset
- User dapat reset password dengan token valid
- User tidak bisa reset dengan token invalid

#### PasswordUpdateTest.php
**Tests:**
- User dapat update password
- Password baru harus dikonfirmasi
- Password lama harus benar

#### EmailVerificationTest.php
**Tests:**
- User harus verify email sebelum akses protected routes
- User dapat request verification email baru

#### PasswordConfirmationTest.php
**Tests:**
- User harus konfirmasi password untuk akses sensitive actions

---

### 2. EnrollmentTest.php
**File:** `tests/Feature/EnrollmentTest.php`

**Purpose:** Test enrollment dan progress tracking

**Tests:**
- Student dapat enroll ke course aktif
- Student tidak bisa enroll ke course nonaktif
- Student tidak bisa enroll dua kali ke course yang sama
- Student dapat mark lesson as done
- Student dapat mark lesson as not done
- Progress dihitung dengan benar
- Certificate otomatis dibuat ketika progress 100%
- Non-student tidak bisa enroll

**Setup:**
- Creates category, teacher, student, dan course dengan lessons

**Key Assertions:**
```php
$this->assertDatabaseHas('course_student', [
    'course_id' => $course->id,
    'student_id' => $student->id,
]);

$this->assertEquals(100, $course->getProgressForUser($student));

$this->assertDatabaseHas('certificates', [
    'student_id' => $student->id,
    'course_id' => $course->id,
]);
```

**Transaction Testing:**
- Tests verify bahwa transaction bekerja dengan benar
- Jika ada error, semua perubahan di-rollback

---

### 3. HomepageTest.php
**File:** `tests/Feature/HomepageTest.php`

**Purpose:** Test homepage functionality

**Tests:**
- User dapat mengakses homepage
- Homepage menampilkan course aktif
- Homepage menampilkan statistik
- Search functionality bekerja
- Filter by category bekerja

**Key Assertions:**
```php
$response->assertStatus(200);
$response->assertViewHas('courses');
$response->assertViewHas('stats');
```

---

### 4. CourseAuthorizationTest.php
**File:** `tests/Feature/CourseAuthorizationTest.php`

**Purpose:** Test authorization untuk course management

**Tests:**
- Teacher hanya bisa akses course miliknya
- Admin bisa akses semua course
- Student tidak bisa akses course management
- Unauthorized user tidak bisa akses course management

**Key Assertions:**
```php
$response->assertStatus(403); // Forbidden
$response->assertStatus(200);  // OK
```

---

### 5. LessonAuthorizationTest.php
**File:** `tests/Feature/LessonAuthorizationTest.php`

**Purpose:** Test authorization untuk lesson management

**Tests:**
- Teacher hanya bisa manage lesson di course miliknya
- Student hanya bisa view lesson di course yang di-enroll
- Unauthorized user tidak bisa akses lesson

**Key Assertions:**
```php
$response->assertStatus(403);
$response->assertStatus(200);
```

---

### 6. ProfileTest.php
**File:** `tests/Feature/ProfileTest.php`

**Purpose:** Test profile management

**Tests:**
- User dapat melihat profile edit form
- User dapat update profile
- User dapat update password
- User dapat delete account
- Validation bekerja dengan benar (menggunakan ProfileUpdateRequest)

**Key Assertions:**
```php
$this->assertDatabaseHas('users', [
    'id' => $user->id,
    'name' => 'Updated Name',
]);
```

---

## Test Traits

### RefreshDatabase
Digunakan di semua feature tests untuk reset database setiap test:

```php
use RefreshDatabase;

protected function setUp(): void
{
    parent::setUp();
    // Setup test data
}
```

**Purpose:** Memastikan setiap test dimulai dengan database yang bersih.

---

## Test Data Setup

### Factories
Laravel menggunakan factories untuk generate test data:

- `User::factory()` - Create user
- `Category::factory()` - Create category
- `Course::factory()` - Create course
- `Lesson::factory()` - Create lesson

**Example:**
```php
$teacher = User::factory()->create(['role' => 'teacher']);
$student = User::factory()->create(['role' => 'student']);
$course = Course::factory()->create(['teacher_id' => $teacher->id]);
```

---

## Common Test Patterns

### 1. Authentication
```php
$user = User::factory()->create();
$this->actingAs($user);
```

### 2. Database Assertions
```php
$this->assertDatabaseHas('table_name', [
    'field' => 'value',
]);

$this->assertDatabaseMissing('table_name', [
    'field' => 'value',
]);
```

### 3. Response Assertions
```php
$response->assertStatus(200);
$response->assertRedirect('/route');
$response->assertViewHas('variable');
$response->assertSee('Text');
```

### 4. Form Submission
```php
$response = $this->post('/route', [
    'field' => 'value',
]);
```

### 5. Following Redirects
```php
$response->assertRedirect('/route');
$this->followRedirects($response);
```

### 6. Testing Form Requests
```php
$response = $this->post('/route', [
    'name' => '', // Invalid data
]);
$response->assertSessionHasErrors(['name']);
```

### 7. Testing Transactions
```php
// Test that transaction rolls back on error
DB::shouldReceive('transaction')
    ->andThrow(new \Exception('Database error'));
```

---

## Running Tests

### Run All Tests
```bash
php artisan test
# atau
vendor/bin/phpunit
```

### Run Specific Test File
```bash
php artisan test tests/Feature/EnrollmentTest.php
```

### Run Specific Test Method
```bash
php artisan test --filter testStudentCanEnrollInCourse
```

### Run with Coverage
```bash
php artisan test --coverage
```

### Run Tests in Parallel
```bash
php artisan test --parallel
```

---

## Test Configuration

### phpunit.xml
**File:** `phpunit.xml`

**Key Settings:**
- Test suite configuration
- Database configuration (SQLite in-memory untuk testing)
- Coverage settings
- Bootstrap file

---

## Best Practices

1. **Isolation:** Setiap test harus independent
2. **RefreshDatabase:** Gunakan `RefreshDatabase` trait
3. **Factories:** Gunakan factories untuk test data
4. **Assertions:** Gunakan assertions yang spesifik
5. **Naming:** Gunakan descriptive test method names
6. **Setup/Teardown:** Gunakan `setUp()` untuk common setup
7. **Acting As:** Gunakan `actingAs()` untuk authentication
8. **Database:** Gunakan in-memory database untuk speed
9. **Form Requests:** Test validation rules di Form Request classes
10. **Transactions:** Test bahwa transactions bekerja dengan benar

---

## Test Coverage

### Current Coverage Areas:
- ✅ Authentication (login, register, password reset)
- ✅ Enrollment functionality
- ✅ Progress tracking
- ✅ Certificate generation
- ✅ Authorization (role-based access)
- ✅ Profile management
- ✅ Homepage functionality

### Areas That Could Use More Tests:
- Course CRUD operations dengan Form Request validation
- Lesson CRUD operations dengan Form Request validation
- Category management dengan Form Request validation
- User management (admin) dengan Form Request validation
- Certificate download/view dengan error handling
- Search and filter functionality
- Transaction rollback scenarios
- Error handling scenarios

---

## Writing New Tests

### Template:
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_something(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
            ->get('/route');

        // Assert
        $response->assertStatus(200);
    }
}
```

### Testing Form Requests:
```php
public function test_validation_fails_with_invalid_data(): void
{
    $response = $this->post('/route', [
        'name' => '', // Invalid
    ]);

    $response->assertSessionHasErrors(['name']);
}
```

### Testing Transactions:
```php
public function test_transaction_rolls_back_on_error(): void
{
    // Test that if one operation fails, all are rolled back
}
```

---

## Common Issues

### 1. Database Not Refreshing
**Solution:** Pastikan menggunakan `RefreshDatabase` trait

### 2. Authentication Issues
**Solution:** Gunakan `actingAs($user)` sebelum request

### 3. Foreign Key Constraints
**Solution:** Create related models dalam `setUp()` method

### 4. Route Not Found
**Solution:** Pastikan route sudah terdaftar di `routes/web.php`

### 5. Form Request Validation
**Solution:** Test validation rules di Form Request class, bukan di controller test

