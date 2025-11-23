# 📚 EduTrack LMS - Platform Kursus Daring Modern

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

**Platform pembelajaran online yang dirancang untuk memberikan pengalaman belajar terbaik dengan manajemen konten yang komprehensif**

[Fitur](#-fitur) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi) • [Kontribusi](#-kontribusi)

</div>

---

## 📸 Screenshot

### Homepage
![Homepage Screenshot](docs/screenshots/homepage.png)
*Landing page dengan hero section yang menarik dan statistik platform*

### Dashboard Admin
![Admin Dashboard Screenshot](docs/screenshots/admin-dashboard.png)
*Dashboard admin dengan statistik lengkap dan manajemen platform*

### Course Catalog
![Course Catalog Screenshot](docs/screenshots/course-catalog.png)
*Katalog kursus dengan filter dan pencarian yang mudah*

### Lesson View
![Lesson View Screenshot](docs/screenshots/lesson-view.png)
*Tampilan lesson dengan progress tracking dan navigasi yang intuitif*

### User Management
![User Management Screenshot](docs/screenshots/user-management.png)
*Manajemen user dengan card layout yang modern*

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur](#-fitur)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Struktur Proyek](#-struktur-proyek)
- [Penggunaan](#-penggunaan)
- [Testing](#-testing)
- [Kontribusi](#-kontribusi)
- [License](#-license)
- [Kontak](#-kontak)

---

## 🎯 Tentang Proyek

EduTrack LMS adalah sistem manajemen pembelajaran (Learning Management System) yang komprehensif yang dirancang untuk memfasilitasi proses pembelajaran online antara guru dan siswa. Platform ini menyediakan workflow CMS terpadu dengan tampilan modern, responsif, dan mudah digunakan.

### Tujuan
- Menyediakan proses pembelajaran terpandu lengkap dengan manajemen konten
- Memfasilitasi interaksi antara guru dan siswa
- Menyediakan pelacakan progres pembelajaran yang akurat
- Memberikan pengalaman pengguna yang modern dan intuitif

### Nilai Utama
- ✅ Workflow CMS terpadu
- ✅ Tampilan clean dengan hierarki visual jelas
- ✅ Komponen responsif dan aksesibilitas tinggi
- ✅ Arsitektur modular yang mudah diuji dan dikembangkan

---

## ✨ Fitur

### 👥 Manajemen Pengguna
- **Multi-role System**: Admin, Teacher, Student, dan Guest
- **User Management**: CRUD lengkap untuk pengguna dengan filter dan pencarian
- **Role-based Access Control**: Setiap role memiliki akses dan fitur yang berbeda
- **Profile Management**: Pengguna dapat mengelola profil mereka sendiri

### 📚 Manajemen Kursus
- **Course CRUD**: Buat, edit, dan hapus kursus dengan mudah
- **Category Management**: Organisasi kursus berdasarkan kategori
- **Course Status**: Aktif/Nonaktif untuk kontrol publikasi
- **Date Range**: Penjadwalan kursus dengan tanggal mulai dan akhir
- **Teacher Assignment**: Penugasan teacher ke kursus tertentu

### 📖 Manajemen Konten
- **Lesson Management**: Buat dan kelola lesson per course
- **Content Organization**: Urutan lesson yang dapat diatur
- **Rich Text Content**: Konten lesson dengan format yang kaya
- **Progress Tracking**: Pelacakan progres pembelajaran per siswa

### 📊 Dashboard & Analytics
- **Admin Dashboard**:
  - Statistik total users, courses, categories, dan enrollments
  - Recent users dan courses
  - Category management terintegrasi
- **Teacher Dashboard**:
  - Overview kursus yang diajar
  - Statistik siswa dan enrollment
- **Student Dashboard**:
  - Kursus yang diikuti
  - Progress tracking per course
  - Lesson yang sudah/belum selesai

### 🎓 Fitur Pembelajaran
- **Enrollment System**: Siswa dapat mendaftar ke kursus
- **Progress Tracking**: Otomatis melacak progres pembelajaran
- **Mark as Done**: Siswa dapat menandai lesson sebagai selesai
- **Lesson Navigation**: Navigasi mudah antar lesson
- **Course Catalog**: Katalog kursus dengan filter dan pencarian

### 🎨 UI/UX Modern
- **Responsive Design**: Optimal di semua perangkat
- **Card-based Layout**: Tampilan modern dengan card layout
- **Tailwind CSS**: Styling dengan utility-first CSS framework
- **Smooth Animations**: Transisi dan animasi yang halus
- **Accessibility**: Aksesibilitas tinggi untuk semua pengguna

---

## 🛠 Teknologi yang Digunakan

### Backend
- **Laravel 12.0** - PHP Framework
- **PHP 8.2+** - Programming Language
- **MySQL** - Database Management System
- **Eloquent ORM** - Database Abstraction Layer

### Frontend
- **Blade Templates** - Templating Engine
- **Tailwind CSS** - Utility-first CSS Framework
- **Alpine.js** - Lightweight JavaScript Framework
- **Vite** - Build Tool dan Development Server

### Development Tools
- **Laravel Breeze** - Authentication Scaffolding
- **Laravel Pint** - Code Style Fixer
- **PHPUnit** - Testing Framework
- **Laravel Sail** - Docker Development Environment

---

## 💻 Persyaratan Sistem

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **MySQL**: >= 8.0 atau **PostgreSQL**: >= 13
- **Web Server**: Apache/Nginx (untuk production)

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/edutrack-lms.git
cd edutrack-lms
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edutrack_lms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Jalankan Migration dan Seeder

```bash
# Run migrations
php artisan migrate

# Seed database dengan data dummy
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Server

```bash
# Development server
php artisan serve

# Atau dengan queue dan vite
composer run dev
```

Akses aplikasi di: `http://localhost:8000`

---

## ⚙️ Konfigurasi

### Default Credentials

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin:**
- Email: `admin@edutrack.com`
- Password: `password`

**Teacher:**
- Email: `teacher@edutrack.com`
- Password: `password`

**Student:**
- Email: `student@edutrack.com`
- Password: `password`

### Environment Variables

Beberapa variabel penting di `.env`:

```env
APP_NAME="EduTrack LMS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edutrack_lms
DB_USERNAME=root
DB_PASSWORD=

# Mail (opsional)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
```

---

## 📁 Struktur Proyek

```
edutrack-lms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── UserController.php
│   │   │   ├── AdminController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── CourseController.php
│   │   │   ├── EnrollmentController.php
│   │   │   ├── HomeController.php
│   │   │   ├── LessonController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       ├── RoleMiddleware.php
│   │       ├── StudentMiddleware.php
│   │       └── TeacherMiddleware.php
│   └── Models/
│       ├── Category.php
│       ├── Course.php
│       ├── Lesson.php
│       ├── LessonProgress.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── AdminUserSeeder.php
│       └── DemoSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   ├── courses/
│   │   ├── lessons/
│   │   ├── layouts/
│   │   └── users/
│   └── css/
├── routes/
│   ├── web.php
│   └── auth.php
├── tests/
│   └── Feature/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 📖 Penggunaan

### Untuk Admin

1. **Login** sebagai admin
2. **Dashboard**: Lihat statistik platform
3. **User Management**: Kelola semua pengguna (Admin, Teacher, Student)
4. **Course Management**: Buat, edit, dan hapus kursus
5. **Category Management**: Kelola kategori kursus

### Untuk Teacher

1. **Login** sebagai teacher
2. **Dashboard**: Lihat kursus yang diajar
3. **Create Course**: Buat kursus baru
4. **Manage Lessons**: Tambah dan kelola lesson dalam kursus
5. **View Students**: Lihat siswa yang terdaftar di kursus

### Untuk Student

1. **Register/Login** sebagai student
2. **Browse Courses**: Jelajahi katalog kursus
3. **Enroll**: Daftar ke kursus yang diminati
4. **Learn**: Akses lesson dan pelajari materi
5. **Track Progress**: Lihat progres pembelajaran

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter TestClassName

# Run with coverage
php artisan test --coverage
```

### Test Coverage

- ✅ Authentication Tests
- ✅ Authorization Tests
- ✅ Enrollment Tests
- ✅ Course Management Tests
- ✅ Lesson Management Tests

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Untuk berkontribusi:

1. **Fork** repository
2. **Create** feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Coding Standards

- Ikuti [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Gunakan Laravel Pint untuk code formatting
- Tulis test untuk fitur baru
- Update dokumentasi jika diperlukan

---

## 📝 License

Proyek ini menggunakan lisensi [MIT License](LICENSE).

---

## 👤 Kontak

**Developer** - [@ShinZeleo](https://github.com/ShinZeleo)

**Project Link**: [https://github.com/yourusername/edutrack-lms](https://github.com/yourusername/edutrack-lms)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Framework yang luar biasa
- [Tailwind CSS](https://tailwindcss.com) - CSS framework yang powerful
- [Heroicons](https://heroicons.com) - Icon set yang digunakan
- Semua kontributor dan pengguna EduTrack LMS

---

<div align="center">

**Dibuat dengan ❤️ untuk pendidikan yang lebih baik**

⭐ Jika proyek ini membantu Anda, berikan star di repository ini!

</div>
