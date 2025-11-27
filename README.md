<div align="center">

![EduTrack LMS Banner](docs/screenshots/banner.png)

</div>

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)


**Platform pembelajaran online yang dirancang untuk memberikan pengalaman belajar terbaik dengan manajemen konten yang komprehensif**

[![Features](https://img.shields.io/badge/📋-Fitur-blue?style=flat-square)](#-features) • [![Installation](https://img.shields.io/badge/🚀-Instalasi-green?style=flat-square)](#-installation) • [![Contributing](https://img.shields.io/badge/🤝-Kontribusi-orange?style=flat-square)](#-contributing)

</div>

---

## 📸 Screenshot

### Halaman Utama
![Homepage Screenshot](docs/screenshots/homepage.png)
*Halaman landing dengan hero section yang menarik dan statistik platform*

### Dashboard Admin
![Admin Dashboard Screenshot](docs/screenshots/admin-dashboard.png)
*Dashboard admin dengan statistik komprehensif dan manajemen platform*

### Katalog Kursus
![Course Catalog Screenshot](docs/screenshots/course-catalog.png)
*Katalog kursus dengan filter dan pencarian yang mudah*

### Tampilan Pelajaran
![Lesson View Screenshot](docs/screenshots/lesson-view.png)
*Tampilan pelajaran dengan pelacakan progress dan navigasi yang intuitif*

### Manajemen Pengguna
![User Management Screenshot](docs/screenshots/user-management.png)
*Manajemen pengguna dengan layout card yang modern*

### Dashboard Teacher
![Teacher Dashboard Screenshot](docs/screenshots/teacher-dashboard.png)
*Dashboard teacher dengan daftar kursus yang dibuat dan statistik siswa*

### Dashboard Student
![Student Dashboard Screenshot](docs/screenshots/student-dashboard.png)
*Dashboard student dengan kursus yang diikuti, progress tracking, dan akses sertifikat*

---

## 📋 Daftar Isi

- [🎯 Tentang Proyek](#-about-project)
- [✨ Fitur](#-features)
- [🛠 Teknologi yang Digunakan](#-technologies-used)
- [💻 Persyaratan Sistem](#-system-requirements)
- [🚀 Instalasi](#-installation)
- [⚙️ Konfigurasi](#-configuration)
- [📁 Struktur Proyek](#-project-structure)
- [📖 Penggunaan](#-usage)
- [📚 Dokumentasi](#-documentation)
- [🧪 Pengujian](#-testing)
- [🤝 Kontribusi](#-contributing)
- [👤 Kontak](#-contact)

---

## 🎯 Tentang Proyek

EduTrack LMS adalah Learning Management System (LMS) yang komprehensif yang dirancang untuk memfasilitasi proses pembelajaran online antara guru dan siswa. Platform ini menyediakan workflow CMS terintegrasi dengan antarmuka yang modern, responsif, dan mudah digunakan.

### 🎯 Tujuan
- 📚 Menyediakan proses pembelajaran terpandu yang lengkap dengan manajemen konten
- 👥 Memfasilitasi interaksi antara guru dan siswa
- 📊 Menyediakan pelacakan progress pembelajaran yang akurat
- 🎨 Memberikan pengalaman pengguna yang modern dan intuitif

### ⭐ Nilai Inti
- ✅ **Integrated CMS Workflow** - Sistem manajemen konten terintegrasi
- ✅ **Clean Design** - Hierarki visual yang jelas dan mudah dipahami
- ✅ **Responsive & Accessible** - Optimal di semua perangkat dengan aksesibilitas tinggi
- ✅ **Modular Architecture** - Mudah untuk diuji, dikembangkan, dan dipelihara
- ✅ **Code Quality** - Validasi Form Request, database transactions, dan error handling yang komprehensif

---

## ✨ Fitur

### 👥 Manajemen Pengguna
- 🔐 **Sistem Multi-role** - Admin, Teacher, Student, dan Guest
- 👤 **Manajemen Pengguna** - CRUD lengkap untuk pengguna dengan filter dan pencarian
- 🛡️ **Role-based Access Control** - Setiap role memiliki akses dan fitur yang berbeda
- ⚙️ **Manajemen Profil** - Pengguna dapat mengelola profil mereka sendiri

### 📚 Manajemen Kursus
- ➕ **Course CRUD** - Membuat, mengedit, dan menghapus kursus dengan mudah
- 🏷️ **Manajemen Kategori** - Mengorganisir kursus berdasarkan kategori
- 🔄 **Status Kursus** - Aktif/Nonaktif untuk kontrol publikasi
- 📅 **Rentang Tanggal** - Penjadwalan kursus dengan tanggal mulai dan akhir
- 👨‍🏫 **Penugasan Guru** - Menugaskan guru ke kursus tertentu

### 📖 Manajemen Konten
- 📝 **Manajemen Pelajaran** - Membuat dan mengelola pelajaran per kursus
- 📋 **Organisasi Konten** - Urutan pelajaran yang dapat dikonfigurasi
- ✍️ **Rich Text Content** - Konten pelajaran dengan format yang kaya
- 📊 **Pelacakan Progress** - Melacak progress pembelajaran per siswa

### 📊 Dashboard & Analytics
- **👨‍💼 Dashboard Admin**:
  - 📈 Statistik untuk total pengguna, kursus, kategori, dan pendaftaran
  - 👥 Pengguna dan kursus terbaru
  - 🏷️ Manajemen kategori terintegrasi
- **👨‍🏫 Dashboard Teacher**:
  - 📚 Ringkasan kursus yang diajarkan
  - 📊 Statistik siswa dan pendaftaran
- **👨‍🎓 Dashboard Student**:
  - 📖 Kursus yang didaftarkan
  - 📈 Pelacakan progress per kursus
  - ✅ Pelajaran yang selesai/belum selesai

### 🎓 Fitur Pembelajaran
- 🎫 **Sistem Pendaftaran** - Siswa dapat mendaftar ke kursus
- 📈 **Pelacakan Progress** - Secara otomatis melacak progress pembelajaran
- ✅ **Tandai Selesai** - Siswa dapat menandai pelajaran sebagai selesai
- 🔄 **Navigasi Pelajaran** - Navigasi yang mudah antar pelajaran
- 🔍 **Katalog Kursus** - Katalog kursus dengan filter dan pencarian
- 🏆 **Penerbitan Sertifikat** - Sertifikat otomatis diterbitkan saat kursus selesai (progress 100%)
- 📄 **Sertifikat PDF** - Unduh sertifikat dalam format PDF

### 🎨 UI/UX Modern
- 📱 **Desain Responsif** - Optimal di semua perangkat
- 🎴 **Layout Berbasis Card** - Desain layout card yang modern
- 🎨 **Tailwind CSS** - Styling framework CSS utility-first
- ✨ **Animasi Halus** - Transisi dan animasi yang halus
- ♿ **Aksesibilitas** - Aksesibilitas tinggi untuk semua pengguna
- 🖼️ **Gambar Dinamis** - Variasi gambar otomatis untuk menghindari tampilan monoton

### 🔧 Fitur Teknis
- ✅ **Form Request Validation** - Validasi terstruktur dengan pesan error kustom
- 💾 **Database Transactions** - Operasi atomik untuk integritas data
- 🛡️ **Error Handling** - Penanganan error yang komprehensif dengan logging detail
- 📝 **Code Quality** - Kode bersih tanpa file dan komentar yang tidak terpakai
- 🔍 **Eager Loading** - Query yang dioptimalkan untuk menghindari masalah N+1

---

## 🛠 Teknologi yang Digunakan

### 🔧 Backend

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - PHP Framework

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)  - Bahasa Pemrograman

![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)  - Sistem Manajemen Database

![Eloquent](https://img.shields.io/badge/Eloquent-ORM-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Database Abstraction Layer

### 🎨 Frontend

![Blade](https://img.shields.io/badge/Blade-Templates-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Templating Engine

![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.1-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)  - Framework CSS Utility-first

![Alpine.js](https://img.shields.io/badge/Alpine.js-3.4-77C1D5?style=flat-square&logo=alpine.js&logoColor=white)  - Framework JavaScript Ringan

![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat-square&logo=vite&logoColor=white)  - Build Tool dan Development Server

### 🛠️ Development Tools

![Laravel Breeze](https://img.shields.io/badge/Breeze-Auth-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Authentication Scaffolding

![Laravel Pint](https://img.shields.io/badge/Pint-Code%20Style-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Code Style Fixer

![PHPUnit](https://img.shields.io/badge/PHPUnit-11.5-3EAAAF?style=flat-square&logo=phpunit&logoColor=white)  - Framework Testing PHP

![DomPDF](https://img.shields.io/badge/DomPDF-PDF%20Generation-FF2D20?style=flat-square&logo=adobe-acrobat-reader&logoColor=white)  - Generasi PDF untuk Sertifikat

---

## 💻 Persyaratan Sistem

![PHP](https://img.shields.io/badge/PHP-%3E%3D%208.2-777BB4?style=flat-square&logo=php&logoColor=white)

![Composer](https://img.shields.io/badge/Composer-%3E%3D%202.0-885630?style=flat-square&logo=composer&logoColor=white)

![Node.js](https://img.shields.io/badge/Node.js-%3E%3D%2018.x-339933?style=flat-square&logo=node.js&logoColor=white)

![NPM](https://img.shields.io/badge/NPM-%3E%3D%209.x-CB3837?style=flat-square&logo=npm&logoColor=white)

![MySQL](https://img.shields.io/badge/MySQL-%3E%3D%208.0-4479A1?style=flat-square&logo=mysql&logoColor=white)

![Apache](https://img.shields.io/badge/Apache-D22128?style=flat-square&logo=apache&logoColor=white)

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/ShinZeleo/edutrack-lms.git
cd edutrack-lms
```

### 2️⃣ Install Dependencies

```bash
# Install dependensi PHP
composer install

# Install dependensi Node.js
npm install
```

### 3️⃣ Setup Environment

```bash
# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edutrack_lms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5️⃣ Jalankan Migrasi dan Seeder

```bash
# Jalankan migrasi
php artisan migrate

# Seed database dengan data dummy
php artisan db:seed
```

### 6️⃣ Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7️⃣ Jalankan Server

```bash
# Development server
php artisan serve

# Atau dengan queue dan vite
composer run dev
```

🌐 Akses aplikasi di: `http://localhost:8000`

---

## ⚙️ Konfigurasi

### 🔑 Kredensial Default

Setelah menjalankan seeder, Anda dapat login dengan:

**👨‍💼 Admin:**
- ![Email](https://img.shields.io/badge/Email-admin%40edutrack.com-red?style=flat-square&logo=gmail&logoColor=white)
- ![Password](https://img.shields.io/badge/Password-password-black?style=flat-square&logo=keycdn&logoColor=white)

**👨‍🏫 Teacher:**
- ![Email](https://img.shields.io/badge/Email-teacher%40edutrack.com-red?style=flat-square&logo=gmail&logoColor=white)
- ![Password](https://img.shields.io/badge/Password-password-black?style=flat-square&logo=keycdn&logoColor=white)

**👨‍🎓 Student:**
- ![Email](https://img.shields.io/badge/Email-student%40edutrack.com-red?style=flat-square&logo=gmail&logoColor=white)
- ![Password](https://img.shields.io/badge/Password-password-black?style=flat-square&logo=keycdn&logoColor=white)

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
```

---

## 📁 Struktur Proyek

![Structure](https://img.shields.io/badge/📁-Struktur%20Proyek-FF6B6B?style=for-the-badge&logo=folder&logoColor=white)

### 📂 Direktori Utama

![app](https://img.shields.io/badge/app-PHP%20Application-777BB4?style=flat-square&logo=php&logoColor=white) **app/** - Aplikasi Laravel utama

![database](https://img.shields.io/badge/database-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) **database/** - Migrasi dan seeder database

![resources](https://img.shields.io/badge/resources-Views%20%26%20Assets-38B2AC?style=flat-square&logo=file-code&logoColor=white) **resources/** - Views, CSS, dan assets

![routes](https://img.shields.io/badge/routes-Routing-646CFF?style=flat-square&logo=route&logoColor=white) **routes/** - Definisi route aplikasi

![tests](https://img.shields.io/badge/tests-Testing-3EAAAF?style=flat-square&logo=phpunit&logoColor=white) **tests/** - Unit dan feature tests

```
edutrack-lms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── UserController.php
│   │   │   ├── AdminController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── CertificateController.php
│   │   │   ├── CourseController.php
│   │   │   ├── EnrollmentController.php
│   │   │   ├── HomeController.php
│   │   │   ├── LessonController.php
│   │   │   └── ProfileController.php
│   │   ├── Requests/
│   │   │   ├── Auth/
│   │   │   │   └── LoginRequest.php
│   │   │   ├── CategoryStoreRequest.php
│   │   │   ├── CategoryUpdateRequest.php
│   │   │   ├── CourseStoreRequest.php
│   │   │   ├── CourseUpdateRequest.php
│   │   │   ├── LessonStoreRequest.php
│   │   │   ├── LessonUpdateRequest.php
│   │   │   ├── ProfileUpdateRequest.php
│   │   │   ├── UserStoreRequest.php
│   │   │   └── UserUpdateRequest.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       ├── RoleMiddleware.php
│   │       ├── StudentMiddleware.php
│   │       └── TeacherMiddleware.php
│   └── Models/
│       ├── Category.php
│       ├── Certificate.php
│       ├── Course.php
│       ├── Lesson.php
│       ├── LessonProgress.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DemoSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   ├── certificates/
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
├── docs/
│   ├── controllers.md
│   ├── database.md
│   ├── models.md
│   ├── routes.md
│   ├── tests.md
│   ├── views.md
│   └── screenshots/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

### 📄 File Penting

![composer.json](https://img.shields.io/badge/composer.json-PHP%20Dependencies-885630?style=flat-square&logo=composer&logoColor=white)  - Dependensi PHP

![package.json](https://img.shields.io/badge/package.json-Node%20Dependencies-CB3837?style=flat-square&logo=npm&logoColor=white)  - Dependensi Node.js

![.env.example](https://img.shields.io/badge/.env.example-Configuration-FF6B6B?style=flat-square&logo=gear&logoColor=white)  - Template konfigurasi environment

---

## 📖 Penggunaan

### 👨‍💼 Untuk Admin

1. 🔐 **Login** sebagai admin
2. 📊 **Dashboard** - Melihat statistik platform
3. 👥 **Manajemen Pengguna** - Mengelola semua pengguna (Admin, Teacher, Student)
4. 📚 **Manajemen Kursus** - Membuat, mengedit, dan menghapus kursus
5. 🏷️ **Manajemen Kategori** - Mengelola kategori kursus

### 👨‍🏫 Untuk Teacher

1. 🔐 **Login** sebagai teacher
2. 📊 **Dashboard** - Melihat kursus yang diajarkan
3. ➕ **Buat Kursus** - Membuat kursus baru
4. 📝 **Kelola Pelajaran** - Menambah dan mengelola pelajaran dalam kursus
5. 👥 **Lihat Siswa** - Melihat siswa yang terdaftar di kursus

### 👨‍🎓 Untuk Student

1. 🔐 **Daftar/Login** sebagai student
2. 🔍 **Jelajahi Kursus** - Menjelajahi katalog kursus
3. 🎫 **Daftar** - Mendaftar ke kursus yang diinginkan
4. 📖 **Belajar** - Mengakses pelajaran dan materi pembelajaran
5. 📈 **Lacak Progress** - Melihat progress pembelajaran
6. 🏆 **Unduh Sertifikat** - Mengunduh sertifikat setelah menyelesaikan kursus (progress 100%)

---

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/` untuk membantu memahami struktur dan implementasi aplikasi:

### 📄 File Dokumentasi

- **[docs/controllers.md](docs/controllers.md)**
  Ikhtisar setiap controller beserta alur request → controller → response, middleware yang digunakan, penggunaan Form Request, transaksi database, dan error handling pattern.
- **[docs/models.md](docs/models.md)**
  Diagram relasi antar model, penjelasan setiap relationship (hasMany, belongsTo, belongsToMany), scopes, accessor/mutator, serta contoh query yang optimal.
- **[docs/views.md](docs/views.md)**
  Struktur folder Blade, penjelasan layout & component, contoh Blade directive, cara menampilkan error/flash message, serta guideline Tailwind untuk styling.
- **[docs/routes.md](docs/routes.md)**
  Daftar lengkap routes (public, auth, admin, teacher, student), middleware stack yang melindungi tiap route, contoh route model binding, dan naming convention.
- **[docs/middleware.md](docs/middleware.md)**
  Penjelasan workflow middleware (auth, role-based, verified), urutan eksekusi, contoh error/redirect, serta best practice fail-fast authorization.
- **[docs/database.md](docs/database.md)**
  Dokumentasi schema database, detail tiap migration, strategi cascade delete, diagram ERD, serta tips menjalankan/rollback migration.
- **[docs/tests.md](docs/tests.md)**
  Struktur test suite, contoh Arrange-Act-Assert, daftar assertion yang digunakan, serta panduan menjalankan test parsial maupun penuh.

### 🎯 Fitur yang Didokumentasikan

- ✅ **Form Request Classes** - Validasi terstruktur dengan pesan error kustom
- ✅ **Database Transactions** - Operasi atomik untuk integritas data
- ✅ **Error Handling** - Penanganan error yang komprehensif dengan logging
- ✅ **Certificate System** - Generasi PDF dan penerbitan sertifikat
- ✅ **Progress Tracking** - Auto-generate sertifikat saat progress mencapai 100%
- ✅ **Role-based Access Control** - Authorization untuk setiap role

---

## 🧪 Pengujian

```bash
# Jalankan semua tests
php artisan test

# Jalankan test spesifik
php artisan test --filter TestClassName

# Jalankan dengan coverage
php artisan test --coverage
```

### 📊 Test Coverage

![Auth Tests](https://img.shields.io/badge/Authentication-Tests-green?style=flat-square&logo=shield-check&logoColor=white) ✅ Authentication Tests

![Authz Tests](https://img.shields.io/badge/Authorization-Tests-blue?style=flat-square&logo=shield-lock&logoColor=white) ✅ Authorization Tests

![Enrollment Tests](https://img.shields.io/badge/Enrollment-Tests-purple?style=flat-square&logo=user-check&logoColor=white) ✅ Enrollment Tests

![Course Tests](https://img.shields.io/badge/Course%20Management-Tests-orange?style=flat-square&logo=book-open&logoColor=white) ✅ Course Management Tests

![Lesson Tests](https://img.shields.io/badge/Lesson%20Management-Tests-red?style=flat-square&logo=document-text&logoColor=white) ✅ Lesson Management Tests

![Profile Tests](https://img.shields.io/badge/Profile-Tests-teal?style=flat-square&logo=user-circle&logoColor=white) ✅ Profile Management Tests

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Untuk berkontribusi:

1. 🍴 **Fork** repository
2. 🌿 **Buat** feature branch (`git checkout -b feature/AmazingFeature`)
3. 💾 **Commit** perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. 📤 **Push** ke branch (`git push origin feature/AmazingFeature`)
5. 🔄 **Buka** Pull Request


---

## 👤 Kontak

![GitHub](https://img.shields.io/badge/GitHub-ShinZeleo-181717?style=for-the-badge&logo=github&logoColor=white) [@ShinZeleo](https://github.com/ShinZeleo)

![Project](https://img.shields.io/badge/Project-Link-FF6B6B?style=for-the-badge&logo=link&logoColor=white) : [https://github.com/ShinZeleo/edutrack-lms](https://github.com/ShinZeleo/edutrack-lms)

---

<div align="center">


⭐ Jika proyek ini membantu Anda, berikan bintang di repository!

</div>
