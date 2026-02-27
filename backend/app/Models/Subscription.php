<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_type',
        'started_at',
        'expires_at',
        'is_active',
        'payment_reference',
        'features',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
            'features' => 'array',
        ];
    }

    /**
     * Get the user who owns this subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if subscription is currently valid.
     */
    public function getIsValidAttribute(): bool
    {
        return $this->is_active && ($this->expires_at === null || $this->expires_at->isFuture());
    }

    /**
     * Check if this is a premium plan.
     */
    public function getIsPremiumAttribute(): bool
    {
        return in_array($this->plan_type, ['basic', 'premium']);
    }

    /**
     * Scope: active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }
}
