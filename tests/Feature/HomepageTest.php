<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create(['is_active' => true]);
        $this->teacher = User::factory()->create(['role' => 'teacher', 'is_active' => true]);
    }

    #[Test]
    public function homepage_displays_5_most_popular_courses()
    {
        $course1 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course2 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course3 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course4 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course5 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course6 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course7 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $students = User::factory()->count(10)->create(['role' => 'student']);

        $course1->students()->attach($students->pluck('id')->toArray());
        $course2->students()->attach($students->take(8)->pluck('id')->toArray());
        $course3->students()->attach($students->take(6)->pluck('id')->toArray());
        $course4->students()->attach($students->take(4)->pluck('id')->toArray());
        $course5->students()->attach($students->take(2)->pluck('id')->toArray());
        $course6->students()->attach($students->first()->id);

        $response = $this->get(route('home'));

        $response->assertOk();

        $response->assertSee($course1->name);
        $response->assertSee($course2->name);
        $response->assertSee($course3->name);
        $response->assertSee($course4->name);
        $response->assertSee($course5->name);

        $response->assertDontSee($course6->name);
        $response->assertDontSee($course7->name);
    }

    #[Test]
    public function homepage_only_shows_active_courses()
    {
        $activeCourse = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $inactiveCourse = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => false,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee($activeCourse->name);
        $response->assertDontSee($inactiveCourse->name);
    }

    #[Test]
    public function homepage_search_filters_courses()
    {
        $course1 = Course::factory()->create([
            'name' => 'Laravel Advanced',
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $course2 = Course::factory()->create([
            'name' => 'Vue.js Basics',
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('home', ['search' => 'Laravel']));

        $response->assertOk();
        $response->assertSee($course1->name);
        $response->assertDontSee($course2->name);
    }

    #[Test]
    public function homepage_category_filter_works()
    {
        $category1 = Category::factory()->create(['is_active' => true]);
        $category2 = Category::factory()->create(['is_active' => true]);

        $course1 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $category1->id,
            'is_active' => true,
        ]);

        $course2 = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $category2->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('home', ['category_id' => $category1->id]));

        $response->assertOk();
        $response->assertSee($course1->name);
        $response->assertDontSee($course2->name);
    }

    #[Test]
    public function homepage_shows_categories()
    {
        $category1 = Category::factory()->create(['is_active' => true]);
        $category2 = Category::factory()->create(['is_active' => true]);
        $inactiveCategory = Category::factory()->create(['is_active' => false]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee($category1->name);
        $response->assertSee($category2->name);
        $response->assertDontSee($inactiveCategory->name);
    }
}

