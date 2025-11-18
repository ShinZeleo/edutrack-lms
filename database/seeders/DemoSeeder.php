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
        $teacher1 = User::firstOrCreate([
            'email' => 'john.doe@example.com',
        ], [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        $teacher2 = User::firstOrCreate([
            'email' => 'jane.smith@example.com',
        ], [
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        // Create Students
        $student1 = User::firstOrCreate([
            'email' => 'alice.johnson@example.com',
        ], [
            'name' => 'Alice Johnson',
            'username' => 'alicej',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        $student2 = User::firstOrCreate([
            'email' => 'bob.williams@example.com',
        ], [
            'name' => 'Bob Williams',
            'username' => 'bobw',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        $student3 = User::firstOrCreate([
            'email' => 'charlie.brown@example.com',
        ], [
            'name' => 'Charlie Brown',
            'username' => 'charlieb',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Technology', 'description' => 'Courses related to technology and programming'],
            ['name' => 'Web Development', 'description' => 'Courses about web development'],
            ['name' => 'Data Science', 'description' => 'Courses about data science and analytics'],
            ['name' => 'Design', 'description' => 'Courses about UI/UX and graphic design'],
            ['name' => 'Business', 'description' => 'Courses about business and entrepreneurship'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate([
                'name' => $categoryData['name'],
            ], $categoryData);
        }

        // Create some courses for teachers
        $techCategory = Category::where('name', 'Technology')->first();
        $webDevCategory = Category::where('name', 'Web Development')->first();
        $designCategory = Category::where('name', 'Design')->first();
        $dataScienceCategory = Category::where('name', 'Data Science')->first();

        // Courses by John Doe (teacher1)
        $course1 = Course::firstOrCreate([
            'name' => 'Introduction to Programming',
            'teacher_id' => $teacher1->id,
        ], [
            'description' => 'Learn the basics of programming with Python. Perfect for beginners.',
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(40),
            'is_active' => true,
            'category_id' => $techCategory->id,
        ]);

        $course2 = Course::firstOrCreate([
            'name' => 'Advanced Web Development',
            'teacher_id' => $teacher1->id,
        ], [
            'description' => 'Deep dive into modern web development techniques using React and Node.js.',
            'start_date' => now()->subDays(5),
            'end_date' => now()->addDays(30),
            'is_active' => true,
            'category_id' => $webDevCategory->id,
        ]);

        // Courses by Jane Smith (teacher2)
        $course3 = Course::firstOrCreate([
            'name' => 'UI/UX Design Fundamentals',
            'teacher_id' => $teacher2->id,
        ], [
            'description' => 'Learn the principles of user interface and user experience design.',
            'start_date' => now()->subDays(15),
            'end_date' => now()->addDays(35),
            'is_active' => true,
            'category_id' => $designCategory->id,
        ]);

        $course4 = Course::firstOrCreate([
            'name' => 'Data Analysis with Python',
            'teacher_id' => $teacher2->id,
        ], [
            'description' => 'Master data analysis using Python libraries like pandas and numpy.',
            'start_date' => now()->subDays(7),
            'end_date' => now()->addDays(50),
            'is_active' => true,
            'category_id' => $dataScienceCategory->id,
        ]);

        // Create lessons for courses
        // Introduction to Programming lessons
        Lesson::firstOrCreate([
            'course_id' => $course1->id,
            'title' => 'Variables and Data Types',
        ], [
            'content' => 'In this lesson, you will learn about variables, data types, and how to declare them in Python.',
            'order' => 1,
        ]);

        Lesson::firstOrCreate([
            'course_id' => $course1->id,
            'title' => 'Control Structures',
        ], [
            'content' => 'Understanding if statements, loops, and other control structures in Python.',
            'order' => 2,
        ]);

        Lesson::firstOrCreate([
            'course_id' => $course1->id,
            'title' => 'Functions',
        ], [
            'content' => 'Learn how to define and use functions in Python programming.',
            'order' => 3,
        ]);

        // Advanced Web Development lessons
        Lesson::firstOrCreate([
            'course_id' => $course2->id,
            'title' => 'React Fundamentals',
        ], [
            'content' => 'Introduction to React, JSX, and component-based architecture.',
            'order' => 1,
        ]);

        Lesson::firstOrCreate([
            'course_id' => $course2->id,
            'title' => 'State Management',
        ], [
            'content' => 'Managing state in React applications using hooks and context.',
            'order' => 2,
        ]);

        // Enroll students in courses (avoid duplicates)
        $course1->students()->syncWithoutDetaching([$student1->id, $student2->id]);
        $course2->students()->syncWithoutDetaching([$student1->id, $student3->id]);
        $course3->students()->syncWithoutDetaching([$student2->id, $student3->id]);
        $course4->students()->syncWithoutDetaching([$student1->id, $student2->id, $student3->id]);

        // Create some lesson progress for students
        // Alice Johnson progress
        \App\Models\LessonProgress::updateOrCreate([
            'lesson_id' => 1, // Variables and Data Types
            'student_id' => $student1->id,
        ], [
            'is_done' => true,
            'done_at' => now()->subDays(9),
        ]);

        \App\Models\LessonProgress::updateOrCreate([
            'lesson_id' => 2, // Control Structures
            'student_id' => $student1->id,
        ], [
            'is_done' => true,
            'done_at' => now()->subDays(8),
        ]);

        \App\Models\LessonProgress::updateOrCreate([
            'lesson_id' => 3, // Functions
            'student_id' => $student1->id,
        ], [
            'is_done' => false,
            'done_at' => null,
        ]);

        // Bob Williams progress
        \App\Models\LessonProgress::updateOrCreate([
            'lesson_id' => 4, // React Fundamentals
            'student_id' => $student3->id,
        ], [
            'is_done' => true,
            'done_at' => now()->subDays(6),
        ]);

        \App\Models\LessonProgress::updateOrCreate([
            'lesson_id' => 5, // State Management
            'student_id' => $student3->id,
        ], [
            'is_done' => false,
            'done_at' => null,
        ]);

        $this->command->info('Demo data created successfully!');
        $this->command->info('');
        $this->command->info('Login credentials:');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('Teacher 1: john.doe@example.com / password');
        $this->command->info('Teacher 2: jane.smith@example.com / password');
        $this->command->info('Student 1: alice.johnson@example.com / password');
        $this->command->info('Student 2: bob.williams@example.com / password');
        $this->command->info('Student 3: charlie.brown@example.com / password');
    }
}