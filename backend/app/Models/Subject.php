<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'grade_level',
        'is_active',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'grade_level' => 'integer',
            'order_index' => 'integer',
        ];
    }

    /**
     * Get the topics for this subject.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Get active topics for a specific grade.
     */
    public function topicsForGrade(int $grade): HasMany
    {
        return $this->topics()
            ->where('grade_level', $grade)
            ->where('is_active', true)
            ->orderBy('order_index');
    }

    /**
     * Scope: only active subjects.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
