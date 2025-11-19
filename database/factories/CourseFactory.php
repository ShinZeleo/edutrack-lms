<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => true,
            'category_id' => Category::factory(),
            'teacher_id' => User::factory()->state(['role' => 'teacher']),
        ];
    }
}

