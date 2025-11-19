<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Category;
use App\Models\LessonProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test data
        $this->category = Category::factory()->create(['is_active' => true]);
        $this->teacher = User::factory()->create(['role' => 'teacher', 'is_active' => true]);
        $this->student = User::factory()->create(['role' => 'student', 'is_active' => true]);
        $this->course = Course::factory()->create([
            'teacher_id' => $this->teacher->id,
            'category_id' => $this->category->id,
            'is_active' => true,
        ]);
    }

    #[Test]
    public function student_can_enroll_in_active_course()
    {
        $response = $this->actingAs($this->student)
            ->post(route('courses.enroll', $this->course));

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertTrue($this->course->students->contains($this->student));
    }

    #[Test]
    public function student_cannot_enroll_in_inactive_course()
    {
        $this->course->update(['is_active' => false]);

        $response = $this->actingAs($this->student)
            ->post(route('courses.enroll', $this->course));

        $response->assertStatus(403);
        $this->assertFalse($this->course->students->contains($this->student));
    }

    #[Test]
    public function teacher_cannot_enroll_in_course()
    {
        $response = $this->actingAs($this->teacher)
            ->post(route('courses.enroll', $this->course));

        $response->assertStatus(403);
    }

    #[Test]
    public function guest_cannot_enroll_in_course()
    {
        $response = $this->post(route('courses.enroll', $this->course));

        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function student_can_enroll_multiple_times_without_duplicate()
    {
        // First enrollment
        $this->actingAs($this->student)
            ->post(route('courses.enroll', $this->course));

        // Second enrollment attempt
        $response = $this->actingAs($this->student)
            ->post(route('courses.enroll', $this->course));

        $response->assertRedirect();

        // Should only have one enrollment record
        $this->assertEquals(1, $this->course->students()->where('users.id', $this->student->id)->count());
    }

    #[Test]
    public function enrolled_student_can_access_lesson()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        $response = $this->actingAs($this->student)
            ->get(route('lessons.show', [$this->course, $lesson]));

        $response->assertOk();
    }

    #[Test]
    public function non_enrolled_student_cannot_access_lesson()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->student)
            ->get(route('lessons.show', [$this->course, $lesson]));

        $response->assertRedirect(route('courses.public.show', $this->course));
        $response->assertSessionHas('error');
    }

    #[Test]
    public function student_can_mark_lesson_as_done_when_enrolled()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        $response = $this->actingAs($this->student)
            ->post(route('lessons.mark.done', $lesson));

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lesson_progress', [
            'lesson_id' => $lesson->id,
            'student_id' => $this->student->id,
            'is_done' => true,
        ]);
    }

    #[Test]
    public function student_cannot_mark_lesson_as_done_when_not_enrolled()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->student)
            ->post(route('lessons.mark.done', $lesson));

        $response->assertStatus(403);
    }

    #[Test]
    public function student_can_mark_lesson_as_not_done()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        // Mark as done first
        LessonProgress::create([
            'lesson_id' => $lesson->id,
            'student_id' => $this->student->id,
            'is_done' => true,
            'done_at' => now(),
        ]);

        // Mark as not done
        $response = $this->actingAs($this->student)
            ->post(route('lessons.mark.not.done', $lesson));

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lesson_progress', [
            'lesson_id' => $lesson->id,
            'student_id' => $this->student->id,
            'is_done' => false,
        ]);
    }

    #[Test]
    public function teacher_cannot_mark_lesson_as_done()
    {
        $lesson = Lesson::factory()->create([
            'course_id' => $this->course->id,
            'order' => 1,
        ]);

        $response = $this->actingAs($this->teacher)
            ->post(route('lessons.mark.done', $lesson));

        $response->assertStatus(403);
    }

    #[Test]
    public function course_progress_is_calculated_correctly()
    {
        // Create 4 lessons
        $lessons = Lesson::factory()->count(4)->create([
            'course_id' => $this->course->id,
        ]);

        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        // Mark 2 lessons as done
        LessonProgress::create([
            'lesson_id' => $lessons[0]->id,
            'student_id' => $this->student->id,
            'is_done' => true,
            'done_at' => now(),
        ]);
        LessonProgress::create([
            'lesson_id' => $lessons[1]->id,
            'student_id' => $this->student->id,
            'is_done' => true,
            'done_at' => now(),
        ]);

        $progress = $this->course->getProgressForUser($this->student);

        // 2 out of 4 = 50%
        $this->assertEquals(50.0, $progress);
    }

    #[Test]
    public function course_progress_is_zero_when_no_lessons()
    {
        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        $progress = $this->course->getProgressForUser($this->student);

        $this->assertEquals(0, $progress);
    }

    #[Test]
    public function course_progress_is_zero_when_no_lessons_done()
    {
        Lesson::factory()->count(3)->create([
            'course_id' => $this->course->id,
        ]);

        // Enroll student
        $this->course->students()->attach($this->student->id, ['enrolled_at' => now()]);

        $progress = $this->course->getProgressForUser($this->student);

        $this->assertEquals(0, $progress);
    }
}

