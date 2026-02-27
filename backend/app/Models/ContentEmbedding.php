<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ContentEmbedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'embeddable_type',
        'embeddable_id',
        'embedding',
        'content_text',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    /**
     * Get the parent embeddable model (Topic, Subject, etc.).
     */
    public function embeddable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Set the embedding from an array of floats.
     */
    public function setEmbeddingAttribute($value): void
    {
        if (is_array($value)) {
            $this->attributes['embedding'] = '[' . implode(',', $value) . ']';
        } else {
            $this->attributes['embedding'] = $value;
        }
    }

    /**
     * Get the embedding as an array of floats.
     */
    public function getEmbeddingAttribute($value): ?array
    {
        if ($value === null)
            return null;

        // Remove brackets and split
        $cleaned = trim($value, '[]');
        return array_map('floatval', explode(',', $cleaned));
    }
}
