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
            'email' => 'admin@example.com',
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
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'username' => 'johndoe',
            ],
            [
                'email' => 'jane.smith@example.com',
                'name' => 'Jane Smith',
                'username' => 'janesmith',
            ],
            [
                'email' => 'michael.chen@example.com',
                'name' => 'Michael Chen',
                'username' => 'michaelchen',
            ],
            [
                'email' => 'sarah.wilson@example.com',
                'name' => 'Sarah Wilson',
                'username' => 'sarahw',
            ],
            [
                'email' => 'david.kumar@example.com',
                'name' => 'David Kumar',
                'username' => 'davidk',
            ],
            [
                'email' => 'lisa.anderson@example.com',
                'name' => 'Lisa Anderson',
                'username' => 'lisaa',
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
            ['email' => 'alice.johnson@example.com', 'name' => 'Alice Johnson', 'username' => 'alicej'],
            ['email' => 'bob.williams@example.com', 'name' => 'Bob Williams', 'username' => 'bobw'],
            ['email' => 'charlie.brown@example.com', 'name' => 'Charlie Brown', 'username' => 'charlieb'],
            ['email' => 'diana.prince@example.com', 'name' => 'Diana Prince', 'username' => 'dianap'],
            ['email' => 'edward.miller@example.com', 'name' => 'Edward Miller', 'username' => 'edwardm'],
            ['email' => 'fiona.garcia@example.com', 'name' => 'Fiona Garcia', 'username' => 'fionag'],
            ['email' => 'george.taylor@example.com', 'name' => 'George Taylor', 'username' => 'georget'],
            ['email' => 'hannah.martinez@example.com', 'name' => 'Hannah Martinez', 'username' => 'hannahm'],
            ['email' => 'ivan.lee@example.com', 'name' => 'Ivan Lee', 'username' => 'ivanl'],
            ['email' => 'julia.white@example.com', 'name' => 'Julia White', 'username' => 'juliaw'],
            ['email' => 'kevin.thomas@example.com', 'name' => 'Kevin Thomas', 'username' => 'kevint'],
            ['email' => 'luna.rodriguez@example.com', 'name' => 'Luna Rodriguez', 'username' => 'lunar'],
            ['email' => 'marcus.davis@example.com', 'name' => 'Marcus Davis', 'username' => 'marcusd'],
            ['email' => 'nina.moore@example.com', 'name' => 'Nina Moore', 'username' => 'ninam'],
            ['email' => 'oscar.jackson@example.com', 'name' => 'Oscar Jackson', 'username' => 'oscarj'],
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
            // Teacher 1 - John Doe
            ['name' => 'Introduction to Programming', 'teacher' => $teacher1, 'category' => $programmingCategory, 'description' => 'Learn the basics of programming with Python. Perfect for beginners.', 'days_ago' => 10, 'days_ahead' => 40],
            ['name' => 'Advanced Web Development', 'teacher' => $teacher1, 'category' => $webDevCategory, 'description' => 'Deep dive into modern web development techniques using React and Node.js.', 'days_ago' => 5, 'days_ahead' => 30],
            ['name' => 'Full Stack JavaScript', 'teacher' => $teacher1, 'category' => $webDevCategory, 'description' => 'Build complete web applications using JavaScript, Node.js, and MongoDB.', 'days_ago' => 3, 'days_ahead' => 60],

            // Teacher 2 - Jane Smith
            ['name' => 'UI/UX Design Fundamentals', 'teacher' => $teacher2, 'category' => $designCategory, 'description' => 'Learn the principles of user interface and user experience design.', 'days_ago' => 15, 'days_ahead' => 35],
            ['name' => 'Data Analysis with Python', 'teacher' => $teacher2, 'category' => $dataScienceCategory, 'description' => 'Master data analysis using Python libraries like pandas and numpy.', 'days_ago' => 7, 'days_ahead' => 50],
            ['name' => 'Machine Learning Basics', 'teacher' => $teacher2, 'category' => $dataScienceCategory, 'description' => 'Introduction to machine learning algorithms and applications.', 'days_ago' => 2, 'days_ahead' => 45],

            // Teacher 3 - Michael Chen
            ['name' => 'React Native Mobile Development', 'teacher' => $teacher3, 'category' => $mobileCategory, 'description' => 'Build cross-platform mobile apps using React Native.', 'days_ago' => 8, 'days_ahead' => 55],
            ['name' => 'iOS App Development with Swift', 'teacher' => $teacher3, 'category' => $mobileCategory, 'description' => 'Create native iOS applications using Swift and Xcode.', 'days_ago' => 12, 'days_ahead' => 40],

            // Teacher 4 - Sarah Wilson
            ['name' => 'MySQL Database Design', 'teacher' => $teacher4, 'category' => $databaseCategory, 'description' => 'Learn database design, normalization, and SQL queries.', 'days_ago' => 6, 'days_ahead' => 50],
            ['name' => 'MongoDB for Developers', 'teacher' => $teacher4, 'category' => $databaseCategory, 'description' => 'Master NoSQL database with MongoDB and Mongoose.', 'days_ago' => 4, 'days_ahead' => 35],

            // Teacher 5 - David Kumar
            ['name' => 'AWS Cloud Fundamentals', 'teacher' => $teacher5, 'category' => $cloudCategory, 'description' => 'Introduction to Amazon Web Services and cloud computing.', 'days_ago' => 9, 'days_ahead' => 60],
            ['name' => 'Docker and Kubernetes', 'teacher' => $teacher5, 'category' => $cloudCategory, 'description' => 'Containerization and orchestration with Docker and Kubernetes.', 'days_ago' => 1, 'days_ahead' => 45],

            // Teacher 6 - Lisa Anderson
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
            ['course' => $course1, 'title' => 'Variables and Data Types', 'content' => 'In this lesson, you will learn about variables, data types, and how to declare them in Python. We will cover integers, floats, strings, booleans, and type conversion.', 'order' => 1],
            ['course' => $course1, 'title' => 'Control Structures', 'content' => 'Understanding if statements, loops (for and while), and other control structures in Python. Learn how to control the flow of your program.', 'order' => 2],
            ['course' => $course1, 'title' => 'Functions', 'content' => 'Learn how to define and use functions in Python programming. We will cover function parameters, return values, and scope.', 'order' => 3],
            ['course' => $course1, 'title' => 'Lists and Dictionaries', 'content' => 'Working with collections in Python: lists, dictionaries, tuples, and sets. Learn how to manipulate and iterate through collections.', 'order' => 4],
            ['course' => $course1, 'title' => 'File Handling', 'content' => 'Reading from and writing to files in Python. Learn about different file modes and best practices.', 'order' => 5],

            // Course 2: Advanced Web Development
            ['course' => $course2, 'title' => 'React Fundamentals', 'content' => 'Introduction to React, JSX, and component-based architecture. Learn the core concepts of React and how to build reusable components.', 'order' => 1],
            ['course' => $course2, 'title' => 'State Management', 'content' => 'Managing state in React applications using hooks (useState, useEffect) and context API. Learn when to use each approach.', 'order' => 2],
            ['course' => $course2, 'title' => 'React Router', 'content' => 'Implementing client-side routing in React applications. Learn how to create multi-page applications with React Router.', 'order' => 3],
            ['course' => $course2, 'title' => 'API Integration', 'content' => 'Connecting React applications to backend APIs. Learn about fetch, axios, and handling async operations.', 'order' => 4],
            ['course' => $course2, 'title' => 'Node.js Backend', 'content' => 'Building RESTful APIs with Node.js and Express. Learn about middleware, routing, and database integration.', 'order' => 5],

            // Course 3: UI/UX Design Fundamentals
            ['course' => $course3, 'title' => 'Design Principles', 'content' => 'Understanding fundamental design principles: balance, contrast, hierarchy, and alignment. Learn how to create visually appealing interfaces.', 'order' => 1],
            ['course' => $course3, 'title' => 'User Research', 'content' => 'Conducting user research and creating user personas. Learn how to understand your target audience and their needs.', 'order' => 2],
            ['course' => $course3, 'title' => 'Wireframing', 'content' => 'Creating wireframes and low-fidelity prototypes. Learn how to plan your design before moving to high-fidelity mockups.', 'order' => 3],
            ['course' => $course3, 'title' => 'Prototyping with Figma', 'content' => 'Using Figma to create interactive prototypes. Learn about components, styles, and design systems.', 'order' => 4],

            // Course 4: Data Analysis with Python
            ['course' => $course4, 'title' => 'Pandas Basics', 'content' => 'Introduction to pandas library for data manipulation. Learn about DataFrames, Series, and basic operations.', 'order' => 1],
            ['course' => $course4, 'title' => 'Data Cleaning', 'content' => 'Cleaning and preprocessing data. Learn how to handle missing values, duplicates, and outliers.', 'order' => 2],
            ['course' => $course4, 'title' => 'Data Visualization', 'content' => 'Creating visualizations with matplotlib and seaborn. Learn how to create charts, graphs, and dashboards.', 'order' => 3],
            ['course' => $course4, 'title' => 'Statistical Analysis', 'content' => 'Performing statistical analysis on datasets. Learn about descriptive statistics, correlations, and hypothesis testing.', 'order' => 4],
        ];

        // Add lessons for remaining courses
        foreach ($courseObjects as $index => $course) {
            if ($index < 4) continue; // Skip courses that already have lessons defined

            $lessonTitles = [
                'Introduction and Overview',
                'Core Concepts',
                'Advanced Techniques',
                'Practical Applications',
                'Best Practices',
                'Project Implementation',
            ];

            foreach ($lessonTitles as $order => $title) {
                Lesson::firstOrCreate([
                    'course_id' => $course->id,
                    'title' => $title,
                ], [
                    'content' => "This lesson covers {$title} for {$course->name}. You will learn essential concepts and practical skills to master this topic.",
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
        $this->command->info('Admin: admin@example.com');
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