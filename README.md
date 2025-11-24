<div align="center">

![EduTrack LMS Banner](docs/screenshots/banner.png)

</div>

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)


**An online learning platform designed to provide the best learning experience with comprehensive content management**

[![Features](https://img.shields.io/badge/📋-Features-blue?style=flat-square)](#-features) • [![Installation](https://img.shields.io/badge/🚀-Installation-green?style=flat-square)](#-installation) • [![Contributing](https://img.shields.io/badge/🤝-Contributing-orange?style=flat-square)](#-contributing)

</div>

---

## 📸 Screenshots

### Homepage
![Homepage Screenshot](docs/screenshots/homepage.png)
*Landing page with attractive hero section and platform statistics*

### Admin Dashboard
![Admin Dashboard Screenshot](docs/screenshots/admin-dashboard.png)
*Admin dashboard with comprehensive statistics and platform management*

### Course Catalog
![Course Catalog Screenshot](docs/screenshots/course-catalog.png)
*Course catalog with easy filtering and search*

### Lesson View
![Lesson View Screenshot](docs/screenshots/lesson-view.png)
*Lesson view with progress tracking and intuitive navigation*

### User Management
![User Management Screenshot](docs/screenshots/user-management.png)
*User management with modern card layout*

---

## 📋 Table of Contents

- [🎯 About Project](#-about-project)
- [✨ Features](#-features)
- [🛠 Technologies Used](#-technologies-used)
- [💻 System Requirements](#-system-requirements)
- [🚀 Installation](#-installation)
- [⚙️ Configuration](#-configuration)
- [📁 Project Structure](#-project-structure)
- [📖 Usage](#-usage)
- [📚 Documentation](#-documentation)
- [🧪 Testing](#-testing)
- [🤝 Contributing](#-contributing)
- [👤 Contact](#-contact)

---

## 🎯 About Project

EduTrack LMS is a comprehensive Learning Management System (LMS) designed to facilitate online learning processes between teachers and students. The platform provides an integrated CMS workflow with modern, responsive, and user-friendly interface.

### 🎯 Goals
- 📚 Provide complete guided learning process with content management
- 👥 Facilitate interaction between teachers and students
- 📊 Provide accurate learning progress tracking
- 🎨 Deliver modern and intuitive user experience

### ⭐ Core Values
- ✅ **Integrated CMS Workflow** - Integrated content management system
- ✅ **Clean Design** - Clear and easy-to-understand visual hierarchy
- ✅ **Responsive & Accessible** - Optimal on all devices with high accessibility
- ✅ **Modular Architecture** - Easy to test, develop, and maintain
- ✅ **Code Quality** - Form Request validation, database transactions, and comprehensive error handling

---

## ✨ Features

### 👥 User Management
- 🔐 **Multi-role System** - Admin, Teacher, Student, and Guest
- 👤 **User Management** - Complete CRUD for users with filtering and search
- 🛡️ **Role-based Access Control** - Each role has different access and features
- ⚙️ **Profile Management** - Users can manage their own profiles

### 📚 Course Management
- ➕ **Course CRUD** - Create, edit, and delete courses easily
- 🏷️ **Category Management** - Organize courses by category
- 🔄 **Course Status** - Active/Inactive for publication control
- 📅 **Date Range** - Course scheduling with start and end dates
- 👨‍🏫 **Teacher Assignment** - Assign teachers to specific courses

### 📖 Content Management
- 📝 **Lesson Management** - Create and manage lessons per course
- 📋 **Content Organization** - Configurable lesson order
- ✍️ **Rich Text Content** - Lesson content with rich formatting
- 📊 **Progress Tracking** - Track learning progress per student

### 📊 Dashboard & Analytics
- **👨‍💼 Admin Dashboard**:
  - 📈 Statistics for total users, courses, categories, and enrollments
  - 👥 Recent users and courses
  - 🏷️ Integrated category management
- **👨‍🏫 Teacher Dashboard**:
  - 📚 Overview of courses taught
  - 📊 Student and enrollment statistics
- **👨‍🎓 Student Dashboard**:
  - 📖 Enrolled courses
  - 📈 Progress tracking per course
  - ✅ Completed/incomplete lessons

### 🎓 Learning Features
- 🎫 **Enrollment System** - Students can enroll in courses
- 📈 **Progress Tracking** - Automatically track learning progress
- ✅ **Mark as Done** - Students can mark lessons as completed
- 🔄 **Lesson Navigation** - Easy navigation between lessons
- 🔍 **Course Catalog** - Course catalog with filtering and search
- 🏆 **Certificate Issuance** - Certificates automatically issued when course is completed (100% progress)
- 📄 **PDF Certificate** - Download certificates in PDF format

### 🎨 Modern UI/UX
- 📱 **Responsive Design** - Optimal on all devices
- 🎴 **Card-based Layout** - Modern card layout design
- 🎨 **Tailwind CSS** - Utility-first CSS framework styling
- ✨ **Smooth Animations** - Smooth transitions and animations
- ♿ **Accessibility** - High accessibility for all users
- 🖼️ **Dynamic Images** - Automatic image variations to avoid monotonous display

### 🔧 Technical Features
- ✅ **Form Request Validation** - Structured validation with custom error messages
- 💾 **Database Transactions** - Atomic operations for data integrity
- 🛡️ **Error Handling** - Comprehensive error handling with detailed logging
- 📝 **Code Quality** - Clean code without unused files and comments
- 🔍 **Eager Loading** - Optimized queries to avoid N+1 problem

---

## 🛠 Technologies Used

### 🔧 Backend

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - PHP Framework

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)  - Programming Language

![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)  - Database Management System

![Eloquent](https://img.shields.io/badge/Eloquent-ORM-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Database Abstraction Layer

### 🎨 Frontend

![Blade](https://img.shields.io/badge/Blade-Templates-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Templating Engine

![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.1-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)  - Utility-first CSS Framework

![Alpine.js](https://img.shields.io/badge/Alpine.js-3.4-77C1D5?style=flat-square&logo=alpine.js&logoColor=white)  - Lightweight JavaScript Framework

![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat-square&logo=vite&logoColor=white)  - Build Tool and Development Server

### 🛠️ Development Tools

![Laravel Breeze](https://img.shields.io/badge/Breeze-Auth-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Authentication Scaffolding

![Laravel Pint](https://img.shields.io/badge/Pint-Code%20Style-FF2D20?style=flat-square&logo=laravel&logoColor=white)  - Code Style Fixer

![PHPUnit](https://img.shields.io/badge/PHPUnit-11.5-3EAAAF?style=flat-square&logo=phpunit&logoColor=white)  - PHP Testing Framework

![DomPDF](https://img.shields.io/badge/DomPDF-PDF%20Generation-FF2D20?style=flat-square&logo=adobe-acrobat-reader&logoColor=white)  - PDF Generation for Certificates

---

## 💻 System Requirements

![PHP](https://img.shields.io/badge/PHP-%3E%3D%208.2-777BB4?style=flat-square&logo=php&logoColor=white)

![Composer](https://img.shields.io/badge/Composer-%3E%3D%202.0-885630?style=flat-square&logo=composer&logoColor=white)

![Node.js](https://img.shields.io/badge/Node.js-%3E%3D%2018.x-339933?style=flat-square&logo=node.js&logoColor=white)

![NPM](https://img.shields.io/badge/NPM-%3E%3D%209.x-CB3837?style=flat-square&logo=npm&logoColor=white)

![MySQL](https://img.shields.io/badge/MySQL-%3E%3D%208.0-4479A1?style=flat-square&logo=mysql&logoColor=white)

![Apache](https://img.shields.io/badge/Apache-D22128?style=flat-square&logo=apache&logoColor=white)

---

## 🚀 Installation

### 1️⃣ Clone Repository

```bash
git clone https://github.com/ShinZeleo/edutrack-lms.git
cd edutrack-lms
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3️⃣ Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ Configure Database

Edit the `.env` file and adjust the database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edutrack_lms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5️⃣ Run Migrations and Seeder

```bash
# Run migrations
php artisan migrate

# Seed database with dummy data
php artisan db:seed
```

### 6️⃣ Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7️⃣ Run Server

```bash
# Development server
php artisan serve

# Or with queue and vite
composer run dev
```

🌐 Access the application at: `http://localhost:8000`

---

## ⚙️ Configuration

### 🔑 Default Credentials

After running the seeder, you can login with:

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

Some important variables in `.env`:

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

## 📁 Project Structure

![Structure](https://img.shields.io/badge/📁-Project%20Structure-FF6B6B?style=for-the-badge&logo=folder&logoColor=white)

### 📂 Main Directories

![app](https://img.shields.io/badge/app-PHP%20Application-777BB4?style=flat-square&logo=php&logoColor=white) **app/** - Main Laravel application

![database](https://img.shields.io/badge/database-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) **database/** - Database migrations and seeders

![resources](https://img.shields.io/badge/resources-Views%20%26%20Assets-38B2AC?style=flat-square&logo=file-code&logoColor=white) **resources/** - Views, CSS, and assets

![routes](https://img.shields.io/badge/routes-Routing-646CFF?style=flat-square&logo=route&logoColor=white) **routes/** - Application route definitions

![tests](https://img.shields.io/badge/tests-Testing-3EAAAF?style=flat-square&logo=phpunit&logoColor=white) **tests/** - Unit and feature tests

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

### 📄 Important Files

![composer.json](https://img.shields.io/badge/composer.json-PHP%20Dependencies-885630?style=flat-square&logo=composer&logoColor=white)  - PHP Dependencies

![package.json](https://img.shields.io/badge/package.json-Node%20Dependencies-CB3837?style=flat-square&logo=npm&logoColor=white)  - Node.js Dependencies

![.env.example](https://img.shields.io/badge/.env.example-Configuration-FF6B6B?style=flat-square&logo=gear&logoColor=white)  - Environment configuration template

---

## 📖 Usage

### 👨‍💼 For Admin

1. 🔐 **Login** as admin
2. 📊 **Dashboard** - View platform statistics
3. 👥 **User Management** - Manage all users (Admin, Teacher, Student)
4. 📚 **Course Management** - Create, edit, and delete courses
5. 🏷️ **Category Management** - Manage course categories

### 👨‍🏫 For Teacher

1. 🔐 **Login** as teacher
2. 📊 **Dashboard** - View courses being taught
3. ➕ **Create Course** - Create new course
4. 📝 **Manage Lessons** - Add and manage lessons within courses
5. 👥 **View Students** - View students enrolled in courses

### 👨‍🎓 For Student

1. 🔐 **Register/Login** as student
2. 🔍 **Browse Courses** - Explore course catalog
3. 🎫 **Enroll** - Enroll in desired courses
4. 📖 **Learn** - Access lessons and study materials
5. 📈 **Track Progress** - View learning progress
6. 🏆 **Download Certificate** - Download certificate after completing course (100% progress)

---

## 📚 Documentation

Complete documentation is available in the `docs/` folder to help understand the application structure and implementation:

### 📄 Documentation Files

- **[docs/controllers.md](docs/controllers.md)** - Complete documentation of all controllers, methods, authorization, Form Requests, error handling, and best practices
- **[docs/models.md](docs/models.md)** - Documentation of all models, relationships, scopes, methods, and database constraints
- **[docs/database.md](docs/database.md)** - Documentation of database schema, migrations, relationships, transactions, and query optimization
- **[docs/routes.md](docs/routes.md)** - Documentation of all routes, middleware, route model binding, and Form Request integration
- **[docs/tests.md](docs/tests.md)** - Documentation of testing, test patterns, setup, and how to run tests
- **[docs/views.md](docs/views.md)** - Documentation of views, layouts, components, Blade directives, and form validation display

### 🎯 Documented Features

- ✅ **Form Request Classes** - Structured validation with custom error messages
- ✅ **Database Transactions** - Atomic operations for data integrity
- ✅ **Error Handling** - Comprehensive error handling with logging
- ✅ **Certificate System** - PDF generation and certificate issuance
- ✅ **Progress Tracking** - Auto-generate certificate when progress reaches 100%
- ✅ **Role-based Access Control** - Authorization for each role

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

### 📊 Test Coverage

![Auth Tests](https://img.shields.io/badge/Authentication-Tests-green?style=flat-square&logo=shield-check&logoColor=white) ✅ Authentication Tests

![Authz Tests](https://img.shields.io/badge/Authorization-Tests-blue?style=flat-square&logo=shield-lock&logoColor=white) ✅ Authorization Tests

![Enrollment Tests](https://img.shields.io/badge/Enrollment-Tests-purple?style=flat-square&logo=user-check&logoColor=white) ✅ Enrollment Tests

![Course Tests](https://img.shields.io/badge/Course%20Management-Tests-orange?style=flat-square&logo=book-open&logoColor=white) ✅ Course Management Tests

![Lesson Tests](https://img.shields.io/badge/Lesson%20Management-Tests-red?style=flat-square&logo=document-text&logoColor=white) ✅ Lesson Management Tests

![Profile Tests](https://img.shields.io/badge/Profile-Tests-teal?style=flat-square&logo=user-circle&logoColor=white) ✅ Profile Management Tests

---

## 🤝 Contributing

Contributions are welcome! To contribute:

1. 🍴 **Fork** the repository
2. 🌿 **Create** a feature branch (`git checkout -b feature/AmazingFeature`)
3. 💾 **Commit** your changes (`git commit -m 'Add some AmazingFeature'`)
4. 📤 **Push** to the branch (`git push origin feature/AmazingFeature`)
5. 🔄 **Open** a Pull Request

### 📋 Coding Standards

- 📐 Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- 🎨 Use Laravel Pint for code formatting
- 🧪 Write tests for new features
- 📝 Update documentation if needed
- ✅ Use Form Request classes for validation
- 🔒 Implement proper error handling and logging
- 💾 Use database transactions for critical operations

---

## 👤 Contact

![GitHub](https://img.shields.io/badge/GitHub-ShinZeleo-181717?style=for-the-badge&logo=github&logoColor=white) [@ShinZeleo](https://github.com/ShinZeleo)

![Project](https://img.shields.io/badge/Project-Link-FF6B6B?style=for-the-badge&logo=link&logoColor=white) : [https://github.com/ShinZeleo/edutrack-lms](https://github.com/ShinZeleo/edutrack-lms)

---

## 🙏 Acknowledgments

Thanks to:

![Laravel](https://img.shields.io/badge/Laravel-Framework-FF2D20?style=flat-square&logo=laravel&logoColor=white) [Laravel](https://laravel.com) - Amazing framework

![Tailwind](https://img.shields.io/badge/Tailwind%20CSS-Framework-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white) [Tailwind CSS](https://tailwindcss.com) - Powerful CSS framework

![Heroicons](https://img.shields.io/badge/Heroicons-Icons-7C3AED?style=flat-square&logo=heroicons&logoColor=white) [Heroicons](https://heroicons.com) - Icon set used

![Contributors](https://img.shields.io/badge/Contributors-Thank%20You-FF6B6B?style=flat-square&logo=heart&logoColor=white) All contributors and users of EduTrack LMS

![Unsplash](https://img.shields.io/badge/Unsplash-Images-000000?style=flat-square&logo=unsplash&logoColor=white) [Unsplash](https://unsplash.com) - Placeholder images used

---

<div align="center">


⭐ If this project helps you, please give it a star on the repository!

</div>
