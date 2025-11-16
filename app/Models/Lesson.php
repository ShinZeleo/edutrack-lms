<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Progress records for this lesson.
     */
    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
