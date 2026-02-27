<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'grade',
        'birth_date',
        'avatar',
        'interests',
        'cognitive_level',
        'stars',
        'level',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'interests' => 'array',
            'settings' => 'array',
            'grade' => 'integer',
            'stars' => 'integer',
            'level' => 'integer',
        ];
    }

    /**
     * Get the parent user who owns this student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias for user relationship (semantic clarity).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all learning sessions for this student.
     */
    public function learningSessions(): HasMany
    {
        return $this->hasMany(LearningSession::class);
    }

    /**
     * Get all progress records for this student.
     */
    public function progress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    /**
     * Add stars to the student.
     */
    public function addStars(int $amount): void
    {
        $this->increment('stars', $amount);

        // Level up every 100 stars
        $newLevel = (int) floor($this->stars / 100) + 1;
        if ($newLevel > $this->level) {
            $this->update(['level' => $newLevel]);
        }
    }
}
