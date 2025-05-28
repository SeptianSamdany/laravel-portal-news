<?php
// app/Models/Subscription.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'interests',
        'frequency',
        'payment_proof',
        'amount',
        'is_subscribed',
        'subscribed_at',
        'expires_at',
        'admin_notes',
        'status',
    ];

    protected $casts = [
        'interests' => 'array',
        'is_subscribed' => 'boolean',
        'subscribed_at' => 'datetime',
        'expires_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    protected $attributes = [
        'frequency' => 'weekly',
        'status' => 'pending',
        'is_subscribed' => false,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPaymentProofUrlAttribute(): ?string
    {
        if ($this->payment_proof) {
            return Storage::url($this->payment_proof);
        }
        return null;
    }

    public function isActive(): bool
    {
        return $this->is_subscribed && 
               $this->status === 'active' && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function scopeActive($query)
    {
        return $query->where('is_subscribed', true)
                    ->where('status', 'active')
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'active' => 'success',
            'expired' => 'danger',
            'cancelled' => 'secondary',
            default => 'secondary'
        };
    }

    public function getInterestsListAttribute(): string
    {
        if (!$this->interests || !is_array($this->interests)) {
            return 'None';
        }
        
        return collect($this->interests)->map(function ($interest) {
            return ucfirst($interest);
        })->join(', ');
    }
}