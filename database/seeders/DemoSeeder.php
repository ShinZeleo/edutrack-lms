<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate([
            'email' => 'admin@edutrack.com',
        ], [
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Teachers
        $teachers = [
            [
                'email' => 'budi@edutrack.com',
                'name' => 'Budi Santoso',
                'username' => 'budi',
            ],
            [
                'email' => 'siti@edutrack.com',
                'name' => 'Siti Nurhaliza',
                'username' => 'siti',
            ],
            [
                'email' => 'agus@edutrack.com',
                'name' => 'Agus Priyono',
                'username' => 'agus',
            ],
            [
                'email' => 'dewi@edutrack.com',
                'name' => 'Dewi Sari',
                'username' => 'dewi',
            ],
            [
                'email' => 'andi@edutrack.com',
                'name' => 'Andi Wijaya',
                'username' => 'andi',
            ],
            [
                'email' => 'rini@edutrack.com',
                'name' => 'Rini Kartika',
                'username' => 'rini',
            ],
        ];

        $teacherObjects = [];
        foreach ($teachers as $teacherData) {
            $teacher = User::firstOrCreate([
                'email' => $teacherData['email'],
            ], [
                'name' => $teacherData['name'],
                'username' => $teacherData['username'],
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'is_active' => true,
            ]);
            $teacherObjects[] = $teacher;
        }

        $teacher1 = $teacherObjects[0];
        $teacher2 = $teacherObjects[1];
        $teacher3 = $teacherObjects[2];
        $teacher4 = $teacherObjects[3];
        $teacher5 = $teacherObjects[4];
        $teacher6 = $teacherObjects[5];

        // Create Students
        $students = [
            ['email' => 'amanda@edutrack.com', 'name' => 'Amanda Putri', 'username' => 'amanda'],
            ['email' => 'bambang@edutrack.com', 'name' => 'Bambang Sutrisno', 'username' => 'bambang'],
            ['email' => 'cindy@edutrack.com', 'name' => 'Cindy Ratna', 'username' => 'cindy'],
            ['email' => 'dian@edutrack.com', 'name' => 'Dian Permatasari', 'username' => 'dian'],
            ['email' => 'eko@edutrack.com', 'name' => 'Eko Prasetyo', 'username' => 'eko'],
            ['email' => 'fitri@edutrack.com', 'name' => 'Fitri Ayu', 'username' => 'fitri'],
            ['email' => 'guntur@edutrack.com', 'name' => 'Guntur Hidayat', 'username' => 'guntur'],
            ['email' => 'hana@edutrack.com', 'name' => 'Hana Lestari', 'username' => 'hana'],
            ['email' => 'indra@edutrack.com', 'name' => 'Indra Kurniawan', 'username' => 'indra'],
            ['email' => 'jihan@edutrack.com', 'name' => 'Jihan Maulida', 'username' => 'jihan'],
            ['email' => 'krisna@edutrack.com', 'name' => 'Krisna Wibowo', 'username' => 'krisna'],
            ['email' => 'lina@edutrack.com', 'name' => 'Lina Melati', 'username' => 'lina'],
            ['email' => 'mario@edutrack.com', 'name' => 'Mario Tanuwijaya', 'username' => 'mario'],
            ['email' => 'nina@edutrack.com', 'name' => 'Nina Wardani', 'username' => 'nina'],
            ['email' => 'okta@edutrack.com', 'name' => 'Okta Ramadhan', 'username' => 'okta'],
        ];

        $studentObjects = [];
        foreach ($students as $studentData) {
            $student = User::firstOrCreate([
                'email' => $studentData['email'],
            ], [
                'name' => $studentData['name'],
                'username' => $studentData['username'],
                'password' => Hash::make('password'),
                'role' => 'student',
                'is_active' => true,
            ]);
            $studentObjects[] = $student;
        }

        $student1 = $studentObjects[0];
        $student2 = $studentObjects[1];
        $student3 = $studentObjects[2];

        // Create Categories
        $categories = [
            ['name' => 'Technology', 'description' => 'Courses related to technology and programming'],
            ['name' => 'Web Development', 'description' => 'Courses about web development'],
            ['name' => 'Data Science', 'description' => 'Courses about data science and analytics'],
            ['name' => 'Design', 'description' => 'Courses about UI/UX and graphic design'],
            ['name' => 'Business', 'description' => 'Courses about business and entrepreneurship'],
            ['name' => 'Mobile Development', 'description' => 'Courses about mobile app development'],
            ['name' => 'Programming Fundamentals', 'description' => 'Basic programming concepts and fundamentals'],
            ['name' => 'Database Management', 'description' => 'Courses about database design and management'],
            ['name' => 'Cloud Computing', 'description' => 'Courses about cloud platforms and services'],
            ['name' => 'Cybersecurity', 'description' => 'Courses about security and ethical hacking'],
        ];

        $categoryObjects = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate([
                'name' => $categoryData['name'],
            ], array_merge($categoryData, ['is_active' => true]));
            $categoryObjects[] = $category;
        }

        // Get category objects
        $techCategory = Category::where('name', 'Technology')->first();
        $webDevCategory = Category::where('name', 'Web Development')->first();
        $designCategory = Category::where('name', 'Design')->first();
        $dataScienceCategory = Category::where('name', 'Data Science')->first();
        $businessCategory = Category::where('name', 'Business')->first();
        $mobileCategory = Category::where('name', 'Mobile Development')->first();
        $programmingCategory = Category::where('name', 'Programming Fundamentals')->first();
        $databaseCategory = Category::where('name', 'Database Management')->first();
        $cloudCategory = Category::where('name', 'Cloud Computing')->first();
        $securityCategory = Category::where('name', 'Cybersecurity')->first();

        // Create Courses
        $coursesData = [
            // Teacher 1 - Budi Santoso
            ['name' => 'Introduction to Programming', 'teacher' => $teacher1, 'category' => $programmingCategory, 'description' => 'Learn the basics of programming with Python. Perfect for beginners.', 'days_ago' => 10, 'days_ahead' => 40],
            ['name' => 'Advanced Web Development', 'teacher' => $teacher1, 'category' => $webDevCategory, 'description' => 'Deep dive into modern web development techniques using React and Node.js.', 'days_ago' => 5, 'days_ahead' => 30],
            ['name' => 'Full Stack JavaScript', 'teacher' => $teacher1, 'category' => $webDevCategory, 'description' => 'Build complete web applications using JavaScript, Node.js, and MongoDB.', 'days_ago' => 3, 'days_ahead' => 60],

            // Teacher 2 - Siti Nurhaliza
            ['name' => 'UI/UX Design Fundamentals', 'teacher' => $teacher2, 'category' => $designCategory, 'description' => 'Learn the principles of user interface and user experience design.', 'days_ago' => 15, 'days_ahead' => 35],
            ['name' => 'Data Analysis with Python', 'teacher' => $teacher2, 'category' => $dataScienceCategory, 'description' => 'Master data analysis using Python libraries like pandas and numpy.', 'days_ago' => 7, 'days_ahead' => 50],
            ['name' => 'Machine Learning Basics', 'teacher' => $teacher2, 'category' => $dataScienceCategory, 'description' => 'Introduction to machine learning algorithms and applications.', 'days_ago' => 2, 'days_ahead' => 45],

            // Teacher 3 - Agus Priyono
            ['name' => 'React Native Mobile Development', 'teacher' => $teacher3, 'category' => $mobileCategory, 'description' => 'Build cross-platform mobile apps using React Native.', 'days_ago' => 8, 'days_ahead' => 55],
            ['name' => 'iOS App Development with Swift', 'teacher' => $teacher3, 'category' => $mobileCategory, 'description' => 'Create native iOS applications using Swift and Xcode.', 'days_ago' => 12, 'days_ahead' => 40],

            // Teacher 4 - Dewi Sari
            ['name' => 'MySQL Database Design', 'teacher' => $teacher4, 'category' => $databaseCategory, 'description' => 'Learn database design, normalization, and SQL queries.', 'days_ago' => 6, 'days_ahead' => 50],
            ['name' => 'MongoDB for Developers', 'teacher' => $teacher4, 'category' => $databaseCategory, 'description' => 'Master NoSQL database with MongoDB and Mongoose.', 'days_ago' => 4, 'days_ahead' => 35],

            // Teacher 5 - Andi Wijaya
            ['name' => 'AWS Cloud Fundamentals', 'teacher' => $teacher5, 'category' => $cloudCategory, 'description' => 'Introduction to Amazon Web Services and cloud computing.', 'days_ago' => 9, 'days_ahead' => 60],
            ['name' => 'Docker and Kubernetes', 'teacher' => $teacher5, 'category' => $cloudCategory, 'description' => 'Containerization and orchestration with Docker and Kubernetes.', 'days_ago' => 1, 'days_ahead' => 45],

            // Teacher 6 - Rini Kartika
            ['name' => 'Web Security Essentials', 'teacher' => $teacher6, 'category' => $securityCategory, 'description' => 'Learn about common web vulnerabilities and how to prevent them.', 'days_ago' => 11, 'days_ahead' => 50],
            ['name' => 'Ethical Hacking Basics', 'teacher' => $teacher6, 'category' => $securityCategory, 'description' => 'Introduction to ethical hacking and penetration testing.', 'days_ago' => 13, 'days_ahead' => 55],
            ['name' => 'Digital Marketing Strategy', 'teacher' => $teacher6, 'category' => $businessCategory, 'description' => 'Learn modern digital marketing techniques and strategies.', 'days_ago' => 14, 'days_ahead' => 40],
        ];

        $courseObjects = [];
        foreach ($coursesData as $courseData) {
            $course = Course::firstOrCreate([
                'name' => $courseData['name'],
                'teacher_id' => $courseData['teacher']->id,
            ], [
                'description' => $courseData['description'],
                'start_date' => now()->subDays($courseData['days_ago']),
                'end_date' => now()->addDays($courseData['days_ahead']),
                'is_active' => true,
                'category_id' => $courseData['category']->id,
            ]);
            $courseObjects[] = $course;
        }

        $course1 = $courseObjects[0];
        $course2 = $courseObjects[1];
        $course3 = $courseObjects[2];
        $course4 = $courseObjects[3];

        // Create lessons for courses
        $lessonsData = [
            // Course 1: Introduction to Programming
            ['course' => $course1, 'title' => 'Variabel dan Tipe Data', 'content' => 'Dalam lesson ini, Anda akan mempelajari tentang variabel, tipe data, dan cara mendeklarasikannya di Python. Kita akan membahas integer, float, string, boolean, dan konversi tipe data.', 'order' => 1],
            ['course' => $course1, 'title' => 'Struktur Kontrol', 'content' => 'Memahami pernyataan if, perulangan (for dan while), dan struktur kontrol lainnya di Python. Pelajari cara mengontrol alur program Anda.', 'order' => 2],
            ['course' => $course1, 'title' => 'Fungsi', 'content' => 'Pelajari cara mendefinisikan dan menggunakan fungsi dalam pemrograman Python. Kita akan membahas parameter fungsi, nilai return, dan scope.', 'order' => 3],
            ['course' => $course1, 'title' => 'List dan Dictionary', 'content' => 'Bekerja dengan koleksi data di Python: list, dictionary, tuple, dan set. Pelajari cara memanipulasi dan melakukan iterasi melalui koleksi.', 'order' => 4],
            ['course' => $course1, 'title' => 'Penanganan File', 'content' => 'Membaca dan menulis file di Python. Pelajari tentang berbagai mode file dan praktik terbaik dalam penanganan file.', 'order' => 5],

            // Course 2: Advanced Web Development
            ['course' => $course2, 'title' => 'Dasar-dasar React', 'content' => 'Pengenalan React, JSX, dan arsitektur berbasis komponen. Pelajari konsep inti React dan cara membangun komponen yang dapat digunakan kembali.', 'order' => 1],
            ['course' => $course2, 'title' => 'Manajemen State', 'content' => 'Mengelola state dalam aplikasi React menggunakan hooks (useState, useEffect) dan Context API. Pelajari kapan menggunakan setiap pendekatan.', 'order' => 2],
            ['course' => $course2, 'title' => 'React Router', 'content' => 'Mengimplementasikan routing di sisi klien dalam aplikasi React. Pelajari cara membuat aplikasi multi-halaman dengan React Router.', 'order' => 3],
            ['course' => $course2, 'title' => 'Integrasi API', 'content' => 'Menghubungkan aplikasi React ke backend API. Pelajari tentang fetch, axios, dan menangani operasi asynchronous.', 'order' => 4],
            ['course' => $course2, 'title' => 'Backend Node.js', 'content' => 'Membangun RESTful API dengan Node.js dan Express. Pelajari tentang middleware, routing, dan integrasi database.', 'order' => 5],

            // Course 3: UI/UX Design Fundamentals
            ['course' => $course3, 'title' => 'Prinsip Desain', 'content' => 'Memahami prinsip-prinsip desain fundamental: keseimbangan, kontras, hierarki, dan alignment. Pelajari cara membuat antarmuka yang menarik secara visual.', 'order' => 1],
            ['course' => $course3, 'title' => 'Penelitian Pengguna', 'content' => 'Melakukan penelitian pengguna dan membuat user persona. Pelajari cara memahami target audiens dan kebutuhan mereka.', 'order' => 2],
            ['course' => $course3, 'title' => 'Wireframing', 'content' => 'Membuat wireframe dan prototipe low-fidelity. Pelajari cara merencanakan desain Anda sebelum beralih ke mockup high-fidelity.', 'order' => 3],
            ['course' => $course3, 'title' => 'Prototyping dengan Figma', 'content' => 'Menggunakan Figma untuk membuat prototipe interaktif. Pelajari tentang komponen, style, dan design system.', 'order' => 4],

            // Course 4: Data Analysis with Python
            ['course' => $course4, 'title' => 'Dasar-dasar Pandas', 'content' => 'Pengenalan library pandas untuk manipulasi data. Pelajari tentang DataFrame, Series, dan operasi dasar.', 'order' => 1],
            ['course' => $course4, 'title' => 'Pembersihan Data', 'content' => 'Membersihkan dan memproses data. Pelajari cara menangani nilai yang hilang, duplikat, dan outlier.', 'order' => 2],
            ['course' => $course4, 'title' => 'Visualisasi Data', 'content' => 'Membuat visualisasi dengan matplotlib dan seaborn. Pelajari cara membuat grafik, chart, dan dashboard.', 'order' => 3],
            ['course' => $course4, 'title' => 'Analisis Statistik', 'content' => 'Melakukan analisis statistik pada dataset. Pelajari tentang statistik deskriptif, korelasi, dan pengujian hipotesis.', 'order' => 4],
        ];

        // Add lessons for remaining courses
        foreach ($courseObjects as $index => $course) {
            if ($index < 4) continue; // Skip courses that already have lessons defined

            $lessonTitles = [
                'Pengenalan dan Gambaran Umum',
                'Konsep Inti',
                'Teknik Lanjutan',
                'Aplikasi Praktis',
                'Praktik Terbaik',
                'Implementasi Proyek',
            ];

            foreach ($lessonTitles as $order => $title) {
                Lesson::firstOrCreate([
                    'course_id' => $course->id,
                    'title' => $title,
                ], [
                    'content' => "Lesson ini membahas {$title} untuk {$course->name}. Anda akan mempelajari konsep-konsep penting dan keterampilan praktis untuk menguasai topik ini.",
                    'order' => $order + 1,
                ]);
            }
        }

        foreach ($lessonsData as $lessonData) {
            Lesson::firstOrCreate([
                'course_id' => $lessonData['course']->id,
                'title' => $lessonData['title'],
            ], [
                'content' => $lessonData['content'],
                'order' => $lessonData['order'],
            ]);
        }

        // Enroll students in courses (avoid duplicates)
        // Distribute enrollments across all courses and students
        foreach ($courseObjects as $course) {
            $randomStudents = collect($studentObjects)->random(rand(3, 8));
            $course->students()->syncWithoutDetaching($randomStudents->pluck('id')->toArray());
        }

        // Create lesson progress for students
        foreach ($studentObjects as $student) {
            $enrolledCourses = $student->enrolledCourses()->with('lessons')->get();

            foreach ($enrolledCourses as $course) {
                $lessons = $course->lessons;
                $completedCount = rand(0, $lessons->count());

                foreach ($lessons->take($completedCount) as $lesson) {
                    \App\Models\LessonProgress::updateOrCreate([
                        'lesson_id' => $lesson->id,
                        'student_id' => $student->id,
                    ], [
                        'is_done' => true,
                        'done_at' => now()->subDays(rand(1, 20)),
                    ]);
                }
            }
        }

        $this->command->info('Demo data created successfully!');
        $this->command->info('');
        $this->command->info('Summary:');
        $this->command->info('- 1 Admin user');
        $this->command->info('- ' . count($teacherObjects) . ' Teacher users');
        $this->command->info('- ' . count($studentObjects) . ' Student users');
        $this->command->info('- ' . count($categoryObjects) . ' Categories');
        $this->command->info('- ' . count($courseObjects) . ' Courses');
        $this->command->info('- ' . Lesson::count() . ' Lessons');
        $this->command->info('');
        $this->command->info('Login credentials (all passwords: password):');
        $this->command->info('Admin: admin@edutrack.com');
        $this->command->info('Teachers:');
        foreach ($teacherObjects as $teacher) {
            $this->command->info('  - ' . $teacher->email);
        }
        $this->command->info('Students:');
        foreach (array_slice($studentObjects, 0, 5) as $student) {
            $this->command->info('  - ' . $student->email);
        }
        $this->command->info('  ... and ' . (count($studentObjects) - 5) . ' more students');
    }
}