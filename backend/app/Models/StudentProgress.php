<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProgress extends Model
{
    use HasFactory;

    protected $table = 'student_progress';

    protected $fillable = [
        'student_id',
        'topic_id',
        'mastery_level',
        'attempts_count',
        'best_score',
        'last_attempt_at',
        'status',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'mastery_level' => 'float',
            'attempts_count' => 'integer',
            'best_score' => 'integer',
            'last_attempt_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the student.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the topic.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Check if topic is mastered (mastery >= 0.8).
     */
    public function getIsMasteredAttribute(): bool
    {
        return $this->mastery_level >= 0.8;
    }

    /**
     * Get mastery as percentage.
     */
    public function getMasteryPercentageAttribute(): float
    {
        return round($this->mastery_level * 100, 1);
    }

    /**
     * Scope: mastered topics.
     */
    public function scopeMastered($query)
    {
        return $query->where('status', 'mastered');
    }

    /**
     * Scope: in-progress topics.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }
}
