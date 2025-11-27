# Middleware Documentation

## Overview
Middleware di EduTrack LMS menangani authentication, authorization, dan request filtering. Semua custom middleware berada di `app/Http/Middleware/` dan terdaftar di `bootstrap/app.php`.

**Middleware Functions:**
- Authentication checking
- Role-based authorization
- Request filtering
- Response modification

---

## Middleware Registration

**File:** `bootstrap/app.php`

**Aliases:**
```php
$middleware->alias([
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
    'student' => \App\Http\Middleware\StudentMiddleware::class,
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
```

**Usage:**
```php
Route::middleware(['auth', 'role:admin'])->group(...);
```

---

## Custom Middleware

### 1. AdminMiddleware
**File:** `app/Http/Middleware/AdminMiddleware.php`

**Alias:** `admin`

**Fungsi:** Memastikan hanya admin yang bisa akses route

**Code:**
```php
public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized access. Admins only.');
    }

    return $next($request);
}
```

**Alur Kerja:**
1. Check apakah user sudah login (`Auth::check()`)
2. Check apakah user role adalah 'admin'
3. Jika tidak memenuhi, abort dengan 403 error
4. Jika memenuhi, lanjutkan request ke controller

**Usage:**
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin only routes
});
```

**Error Response:**
- HTTP 403 Forbidden
- Message: "Unauthorized access. Admins only."

---

### 2. TeacherMiddleware
**File:** `app/Http/Middleware/TeacherMiddleware.php`

**Alias:** `teacher`

**Fungsi:** Memastikan hanya teacher yang bisa akses route

**Code:**
```php
public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check() || Auth::user()->role !== 'teacher') {
        abort(403, 'Unauthorized access. Teachers only.');
    }

    return $next($request);
}
```

**Alur Kerja:**
1. Check apakah user sudah login
2. Check apakah user role adalah 'teacher'
3. Jika tidak memenuhi, abort dengan 403 error
4. Jika memenuhi, lanjutkan request

**Usage:**
```php
Route::middleware(['auth', 'teacher'])->group(function () {
    // Teacher only routes
});
```

**Error Response:**
- HTTP 403 Forbidden
- Message: "Unauthorized access. Teachers only."

---

### 3. StudentMiddleware
**File:** `app/Http/Middleware/StudentMiddleware.php`

**Alias:** `student`

**Fungsi:** Memastikan hanya student yang bisa akses route

**Code:**
```php
public function handle(Request $request, Closure $next): Response
{
    if (!Auth::check() || Auth::user()->role !== 'student') {
        abort(403, 'Unauthorized access. Students only.');
    }

    return $next($request);
}
```

**Alur Kerja:**
1. Check apakah user sudah login
2. Check apakah user role adalah 'student'
3. Jika tidak memenuhi, abort dengan 403 error
4. Jika memenuhi, lanjutkan request

**Usage:**
```php
Route::middleware(['auth', 'student'])->group(function () {
    // Student only routes
});
```

**Error Response:**
- HTTP 403 Forbidden
- Message: "Unauthorized access. Students only."

---

### 4. RoleMiddleware
**File:** `app/Http/Middleware/RoleMiddleware.php`

**Alias:** `role`

**Fungsi:** Memastikan user memiliki role tertentu (flexible, bisa digunakan untuk semua role)

**Code:**
```php
public function handle(Request $request, Closure $next, string $role): Response
{
    if (!Auth::check()) {
        return redirect('login');
    }

    $user = Auth::user();

    if ($user->role !== $role) {
        abort(403, 'Unauthorized access. Role ' . $role . ' required.');
    }

    return $next($request);
}
```

**Alur Kerja:**
1. Check apakah user sudah login
2. Jika belum login, redirect ke login page
3. Check apakah user role sesuai dengan parameter `$role`
4. Jika tidak sesuai, abort dengan 403 error
5. Jika sesuai, lanjutkan request

**Parameters:**
- `$role` - Role yang diizinkan: 'admin', 'teacher', atau 'student'

**Usage:**
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin only routes
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Teacher only routes
});

Route::middleware(['auth', 'role:student'])->group(function () {
    // Student only routes
});
```

**Error Response:**
- HTTP 403 Forbidden
- Message: "Unauthorized access. Role {role} required."

**Benefits:**
- Flexible: bisa digunakan untuk semua role
- Reusable: satu middleware untuk semua role checks
- Consistent: error message yang konsisten

---

## Laravel Default Middleware

### Authentication Middleware
**Alias:** `auth`

**Fungsi:** Memastikan user sudah login

**Usage:**
```php
Route::middleware('auth')->group(function () {
    // Protected routes
});
```

**Behavior:**
- Jika user belum login, redirect ke login page
- Jika user sudah login, lanjutkan request

---

### Guest Middleware
**Alias:** `guest`

**Fungsi:** Memastikan user belum login (untuk login/register pages)

**Usage:**
```php
Route::middleware('guest')->group(function () {
    Route::get('/login', ...);
    Route::get('/register', ...);
});
```

**Behavior:**
- Jika user sudah login, redirect ke dashboard
- Jika user belum login, lanjutkan request

---

### Verified Middleware
**Alias:** `verified`

**Fungsi:** Memastikan email user sudah terverifikasi

**Usage:**
```php
Route::middleware(['auth', 'verified'])->group(function () {
    // Verified user only routes
});
```

**Behavior:**
- Jika email belum terverifikasi, redirect ke verification notice page
- Jika email sudah terverifikasi, lanjutkan request

---

### Signed Middleware
**Alias:** `signed`

**Fungsi:** Memastikan URL adalah signed URL (untuk security)

**Usage:**
```php
Route::middleware(['signed'])->get('/verify-email/{id}/{hash}', ...);
```

**Behavior:**
- Jika URL tidak valid atau expired, abort dengan 403
- Jika URL valid, lanjutkan request

---

### Throttle Middleware
**Alias:** `throttle`

**Fungsi:** Rate limiting untuk mencegah abuse

**Usage:**
```php
Route::middleware(['throttle:6,1'])->group(function () {
    // 6 requests per minute
});
```

**Parameters:**
- `throttle:6,1` - 6 requests per 1 minute
- `throttle:60,1` - 60 requests per 1 minute

**Behavior:**
- Jika melebihi limit, return 429 Too Many Requests
- Jika dalam limit, lanjutkan request

---

## Middleware Execution Order

Middleware dijalankan dalam urutan berikut:

1. **Global Middleware** (dijalankan untuk semua requests)
2. **Route Middleware** (dijalankan untuk routes tertentu)
3. **Controller** (setelah semua middleware passed)

**Example:**
```php
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // 1. Check authentication (auth)
    // 2. Check email verification (verified)
    // 3. Check admin role (role:admin)
    // 4. Execute controller
});
```

---

## Middleware Groups

Laravel memiliki beberapa middleware groups:

### Web Middleware Group
**Default untuk routes di `routes/web.php`**

**Includes:**
- Encrypt cookies
- Add queued cookies to response
- Start session
- Share errors from session
- Verify CSRF token
- Substitute bindings

---

### API Middleware Group
**Default untuk routes di `routes/api.php`**

**Includes:**
- Throttle API requests
- Bindings

---

## Request Flow dengan Middleware

```
HTTP Request
    ↓
Global Middleware
    ↓
Route Middleware (auth, verified, role:admin)
    ↓
Controller Method
    ↓
Response
    ↓
Route Middleware (response modification)
    ↓
Global Middleware (response modification)
    ↓
HTTP Response
```

---

## Error Handling

### 403 Forbidden
Dikembalikan oleh middleware jika user tidak memiliki akses:

```php
abort(403, 'Unauthorized access. Admins only.');
```

**Response:**
- HTTP Status: 403
- View: `resources/views/errors/403.blade.php` (jika ada)
- JSON Response: `{"message": "Unauthorized access. Admins only."}` (jika API request)

---

### Redirect to Login
Jika user belum login:

```php
if (!Auth::check()) {
    return redirect('login');
}
```

**Response:**
- HTTP Status: 302 Redirect
- Location: `/login`

---

## Best Practices

1. **Use specific middleware** untuk role checks (admin, teacher, student)
2. **Use role middleware** untuk flexible role checking
3. **Always check authentication** sebelum check role
4. **Provide clear error messages** untuk debugging
5. **Use middleware groups** untuk organization
6. **Cache middleware** di production untuk performance
7. **Test middleware** dengan unit tests

---

## Testing Middleware

**Example Test:**
```php
public function test_admin_middleware_allows_admin()
{
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    $response = $this->get('/admin/dashboard');
    $response->assertStatus(200);
}

public function test_admin_middleware_blocks_student()
{
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($student);

    $response = $this->get('/admin/dashboard');
    $response->assertStatus(403);
}
```

---

## Middleware vs Controller Authorization

**Middleware:**
- Check di level route
- Fail fast (sebelum controller)
- Reusable untuk multiple routes
- Consistent error handling

**Controller:**
- Check di level controller method
- More flexible (bisa check resource ownership)
- Specific untuk controller logic

**Best Practice:**
- Use middleware untuk role-based access
- Use controller untuk resource ownership checks

**Example:**
```php
// Middleware: Check role
Route::middleware(['auth', 'role:teacher'])->group(...);

// Controller: Check resource ownership
if ($course->teacher_id !== $user->id) {
    abort(403, 'Unauthorized access to this course.');
}
```

