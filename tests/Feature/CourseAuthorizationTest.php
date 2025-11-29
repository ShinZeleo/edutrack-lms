<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CourseAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create(['is_active' => true]);
        $this->admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
        $this->teacher1 = User::factory()->create(['role' => 'teacher', 'is_active' => true]);
        $this->teacher2 = User::factory()->create(['role' => 'teacher', 'is_active' => true]);
        $this->student = User::factory()->create(['role' => 'student', 'is_active' => true]);

        $this->course1 = Course::factory()->create([
            'teacher_id' => $this->teacher1->id,
            'category_id' => $this->category->id,
        ]);

        $this->course2 = Course::factory()->create([
            'teacher_id' => $this->teacher2->id,
            'category_id' => $this->category->id,
        ]);
    }

    #[Test]
    public function teacher_can_view_own_courses()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.index'));

        $response->assertOk();
        $response->assertSee($this->course1->name);
        $response->assertDontSee($this->course2->name);
    }

    #[Test]
    public function teacher_can_create_course()
    {
        $courseData = [
            'name' => 'New Course',
            'description' => 'Course description',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.store'), $courseData);

        $response->assertRedirect(route('teacher.courses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('courses', [
            'name' => 'New Course',
            'teacher_id' => $this->teacher1->id,
        ]);
    }

    #[Test]
    public function teacher_can_edit_own_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.edit', $this->course1));

        $response->assertOk();
    }

    #[Test]
    public function teacher_cannot_edit_other_teacher_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.edit', $this->course2));

        $response->assertStatus(403);
    }

    #[Test]
    public function teacher_can_update_own_course()
    {
        $updateData = [
            'name' => 'Updated Course Name',
            'description' => 'Updated description',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->teacher1)
            ->put(route('teacher.courses.update', $this->course1), $updateData);

        $response->assertRedirect(route('teacher.courses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('courses', [
            'id' => $this->course1->id,
            'name' => 'Updated Course Name',
        ]);
    }

    #[Test]
    public function teacher_cannot_update_other_teacher_course()
    {
        $updateData = [
            'name' => 'Hacked Course Name',
            'description' => 'Hacked description',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->teacher1)
            ->put(route('teacher.courses.update', $this->course2), $updateData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('courses', [
            'id' => $this->course2->id,
            'name' => 'Hacked Course Name',
        ]);
    }

    #[Test]
    public function teacher_can_delete_own_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->delete(route('teacher.courses.destroy', $this->course1));

        $response->assertRedirect(route('teacher.courses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('courses', [
            'id' => $this->course1->id,
        ]);
    }

    #[Test]
    public function teacher_cannot_delete_other_teacher_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->delete(route('teacher.courses.destroy', $this->course2));

        $response->assertStatus(403);

        $this->assertDatabaseHas('courses', [
            'id' => $this->course2->id,
        ]);
    }

    #[Test]
    public function admin_can_view_all_courses()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.courses.index'));

        $response->assertOk();
        $response->assertSee($this->course1->name);
        $response->assertSee($this->course2->name);
    }

    #[Test]
    public function admin_can_edit_any_course()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.courses.edit', $this->course1));

        $response->assertOk();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.courses.edit', $this->course2));

        $response->assertOk();
    }

    #[Test]
    public function admin_can_update_any_course()
    {
        $updateData = [
            'name' => 'Admin Updated Course',
            'description' => 'Updated by admin',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
            'teacher_id' => $this->teacher1->id,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.courses.update', $this->course2), $updateData);

        $response->assertRedirect(route('admin.courses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('courses', [
            'id' => $this->course2->id,
            'name' => 'Admin Updated Course',
        ]);
    }

    #[Test]
    public function admin_can_delete_any_course()
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('admin.courses.destroy', $this->course2));

        $response->assertRedirect(route('admin.courses.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('courses', [
            'id' => $this->course2->id,
        ]);
    }

    #[Test]
    public function student_cannot_access_teacher_course_management()
    {
        $response = $this->actingAs($this->student)
            ->get(route('teacher.courses.index'));

        $response->assertStatus(403);
    }

    #[Test]
    public function student_cannot_create_course()
    {
        $courseData = [
            'name' => 'Student Course',
            'description' => 'Should not work',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
        ];

        $response = $this->actingAs($this->student)
            ->post(route('teacher.courses.store'), $courseData);

        $response->assertStatus(403);
    }

    #[Test]
    public function course_validation_requires_name()
    {
        $courseData = [
            'description' => 'Missing name',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(30)->format('Y-m-d'),
            'category_id' => $this->category->id,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.store'), $courseData);

        $response->assertSessionHasErrors('name');
    }

    #[Test]
    public function course_validation_requires_start_date_before_end_date()
    {
        $courseData = [
            'name' => 'Invalid Dates Course',
            'description' => 'Start after end',
            'start_date' => now()->addDays(30)->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
            'category_id' => $this->category->id,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.store'), $courseData);

        $response->assertSessionHasErrors();
    }
}

