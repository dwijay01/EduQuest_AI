<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'topic_id',
        'session_type',
        'started_at',
        'ended_at',
        'score',
        'total_questions',
        'correct_answers',
        'time_spent_seconds',
        'ai_feedback',
        'answers_detail',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'answers_detail' => 'array',
            'metadata' => 'array',
            'score' => 'integer',
            'total_questions' => 'integer',
            'correct_answers' => 'integer',
            'time_spent_seconds' => 'integer',
        ];
    }

    /**
     * Get the student for this session.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the topic for this session.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get accuracy percentage.
     */
    public function getAccuracyAttribute(): float
    {
        if ($this->total_questions === 0)
            return 0;
        return round(($this->correct_answers / $this->total_questions) * 100, 1);
    }

    /**
     * Check if session is completed.
     */
    public function getIsCompletedAttribute(): bool
    {
        return $this->ended_at !== null;
    }

    /**
     * Get formatted duration.
     */
    public function getDurationAttribute(): string
    {
        $minutes = (int) floor($this->time_spent_seconds / 60);
        $seconds = $this->time_spent_seconds % 60;
        return "{$minutes}m {$seconds}s";
    }
}
