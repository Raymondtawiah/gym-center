<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ClassBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gym_class_id',
        'booking_date',
        'status',
        'gym_id',
        // Membership fields
        'membership_type',
        'start_date',
        'end_date',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gymClass(): BelongsTo
    {
        return $this->belongsTo(GymClass::class);
    }

    /**
     * Get the gym that owns the booking.
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    /**
     * Check if the membership is currently active.
     */
    public function isActive(): bool
    {
        if ($this->status !== 'confirmed') {
            return false;
        }
        
        $now = Carbon::now();
        $endDate = $this->end_date;
        
        return $endDate && $now->lte($endDate);
    }

    /**
     * Check if the membership has expired.
     */
    public function isExpired(): bool
    {
        // If status is explicitly marked as expired, return true
        if ($this->status === 'expired') {
            return true;
        }
        
        // Check if the membership was confirmed but the end date has passed
        if ($this->status === 'confirmed') {
            $now = Carbon::now();
            $endDate = $this->end_date;
            
            return $endDate && $now->gt($endDate);
        }
        
        return false;
    }

    /**
     * Check if the membership is expiring soon (within 7 days).
     */
    public function isExpiringSoon(): bool
    {
        if ($this->status !== 'confirmed') {
            return false;
        }
        
        $now = Carbon::now();
        $endDate = $this->end_date;
        $sevenDaysFromNow = $now->copy()->addDays(7);
        
        return $endDate && $now->lte($endDate) && $endDate->lte($sevenDaysFromNow);
    }

    /**
     * Scope a query to only include active bookings.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'confirmed')
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', Carbon::now());
            });
    }

    /**
     * Scope a query to only include expired bookings.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'confirmed')
            ->where('end_date', '<', Carbon::now());
    }

    /**
     * Scope a query to only include bookings expiring soon.
     */
    public function scopeExpiringSoon($query, $days = 7)
    {
        $futureDate = Carbon::now()->addDays($days);
        
        return $query->where('status', 'confirmed')
            ->where('end_date', '>=', Carbon::now())
            ->where('end_date', '<=', $futureDate);
    }

    /**
     * Scope a query to only include bookings for a specific gym.
     */
    public function scopeForGym($query, $gymId)
    {
        return $query->where('gym_id', $gymId);
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}
