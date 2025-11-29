<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LessonAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create(['is_active' => true]);
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

        $this->lesson1 = Lesson::factory()->create([
            'course_id' => $this->course1->id,
            'order' => 1,
        ]);

        $this->lesson2 = Lesson::factory()->create([
            'course_id' => $this->course2->id,
            'order' => 1,
        ]);
    }

    #[Test]
    public function teacher_can_view_lessons_of_own_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.lessons.index', $this->course1));

        $response->assertOk();
        $response->assertSee($this->lesson1->title);
    }

    #[Test]
    public function teacher_cannot_view_lessons_of_other_teacher_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.lessons.index', $this->course2));

        $response->assertStatus(403);
    }

    #[Test]
    public function teacher_can_create_lesson_for_own_course()
    {
        $lessonData = [
            'title' => 'New Lesson',
            'content' => 'Lesson content here',
            'order' => 2,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.lessons.store', $this->course1), $lessonData);

        $response->assertRedirect(route('teacher.courses.lessons.index', $this->course1));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lessons', [
            'title' => 'New Lesson',
            'course_id' => $this->course1->id,
        ]);
    }

    #[Test]
    public function teacher_cannot_create_lesson_for_other_teacher_course()
    {
        $lessonData = [
            'title' => 'Hacked Lesson',
            'content' => 'Should not work',
            'order' => 2,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.lessons.store', $this->course2), $lessonData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('lessons', [
            'title' => 'Hacked Lesson',
            'course_id' => $this->course2->id,
        ]);
    }

    #[Test]
    public function teacher_can_edit_lesson_of_own_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.lessons.edit', $this->lesson1));

        $response->assertOk();
    }

    #[Test]
    public function teacher_cannot_edit_lesson_of_other_teacher_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.lessons.edit', $this->lesson2));

        $response->assertStatus(403);
    }

    #[Test]
    public function teacher_can_update_lesson_of_own_course()
    {
        $updateData = [
            'title' => 'Updated Lesson Title',
            'content' => 'Updated content',
            'order' => 1,
        ];

        $response = $this->actingAs($this->teacher1)
            ->put(route('teacher.courses.lessons.update', $this->lesson1), $updateData);

        $response->assertRedirect(route('teacher.courses.lessons.index', $this->course1));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lessons', [
            'id' => $this->lesson1->id,
            'title' => 'Updated Lesson Title',
        ]);
    }

    #[Test]
    public function teacher_cannot_update_lesson_of_other_teacher_course()
    {
        $updateData = [
            'title' => 'Hacked Lesson Title',
            'content' => 'Hacked content',
            'order' => 1,
        ];

        $response = $this->actingAs($this->teacher1)
            ->put(route('teacher.courses.lessons.update', $this->lesson2), $updateData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('lessons', [
            'id' => $this->lesson2->id,
            'title' => 'Hacked Lesson Title',
        ]);
    }

    #[Test]
    public function teacher_can_delete_lesson_of_own_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->delete(route('teacher.courses.lessons.destroy', $this->lesson1));

        $response->assertRedirect(route('teacher.courses.lessons.index', $this->course1));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('lessons', [
            'id' => $this->lesson1->id,
        ]);
    }

    #[Test]
    public function teacher_cannot_delete_lesson_of_other_teacher_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->delete(route('teacher.courses.lessons.destroy', $this->lesson2));

        $response->assertStatus(403);

        $this->assertDatabaseHas('lessons', [
            'id' => $this->lesson2->id,
        ]);
    }

    #[Test]
    public function lesson_validation_requires_title()
    {
        $lessonData = [
            'content' => 'Missing title',
            'order' => 1,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.lessons.store', $this->course1), $lessonData);

        $response->assertSessionHasErrors('title');
    }

    #[Test]
    public function lesson_validation_requires_content()
    {
        $lessonData = [
            'title' => 'Missing content',
            'order' => 1,
        ];

        $response = $this->actingAs($this->teacher1)
            ->post(route('teacher.courses.lessons.store', $this->course1), $lessonData);

        $response->assertSessionHasErrors('content');
    }

    #[Test]
    public function student_cannot_access_lesson_management()
    {
        $response = $this->actingAs($this->student)
            ->get(route('teacher.courses.lessons.index', $this->course1));

        $response->assertStatus(403);
    }

    #[Test]
    public function teacher_cannot_access_lesson_from_wrong_course()
    {
        $response = $this->actingAs($this->teacher1)
            ->get(route('teacher.courses.lessons.edit', $this->lesson2));

        $response->assertStatus(403);
    }
}

