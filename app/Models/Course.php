<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'category_id',
        'teacher_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Students enrolled in this course.
     */
    public function students()
    {
        return $this->belongsToMany(\App\Models\User::class, 'course_student', 'course_id', 'student_id')
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }

    /**
     * Lessons in this course.
     */
    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class);
    }


    /**
     * Calculate progress for a specific user.
     */
    public function getProgressForUser($user)
    {
        $totalLessons = $this->lessons()->count();

        if ($totalLessons === 0) {
            return 0;
        }

        $doneLessons = $this->lessons()
            ->join('lesson_progress', 'lessons.id', '=', 'lesson_progress.lesson_id')
            ->where('lesson_progress.student_id', $user->id)
            ->where('lesson_progress.is_done', true)
            ->count();

        return round(($doneLessons / $totalLessons) * 100, 2);
    }
}
