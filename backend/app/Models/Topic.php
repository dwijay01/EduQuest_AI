<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'name',
        'slug',
        'description',
        'grade_level',
        'difficulty_level',
        'order_index',
        'prerequisites',
        'learning_objectives',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'prerequisites' => 'array',
            'learning_objectives' => 'array',
            'is_active' => 'boolean',
            'grade_level' => 'integer',
            'order_index' => 'integer',
        ];
    }

    /**
     * Get the subject this topic belongs to.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get learning sessions for this topic.
     */
    public function learningSessions(): HasMany
    {
        return $this->hasMany(LearningSession::class);
    }

    /**
     * Get student progress records for this topic.
     */
    public function studentProgress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    /**
     * Scope: only active topics.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: filter by grade level.
     */
    public function scopeForGrade($query, int $grade)
    {
        return $query->where('grade_level', $grade);
    }
}
