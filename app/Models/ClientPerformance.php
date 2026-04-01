<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ClientPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gym_id',
        'recorded_date',
        'weight',
        'height',
        'body_fat_percentage',
        'muscle_mass',
        'resting_heart_rate',
        'blood_pressure',
        'bench_press_max',
        'squat_max',
        'deadlift_max',
        'cardio_duration',
        'cardio_distance',
        'sit_and_reach',
        'fitness_score',
        'notes',
        'recommendations',
    ];

    protected $casts = [
        'recorded_date' => 'date',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
        'muscle_mass' => 'decimal:2',
        'bench_press_max' => 'decimal:2',
        'squat_max' => 'decimal:2',
        'deadlift_max' => 'decimal:2',
        'cardio_distance' => 'decimal:2',
        'sit_and_reach' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }

    /**
     * Calculate BMI from weight and height.
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->weight || !$this->height) {
            return null;
        }

        $heightInMeters = $this->height / 100;
        return round($this->weight / ($heightInMeters * $heightInMeters), 1);
    }

    /**
     * Get the BMI category label.
     */
    public function getBmiCategoryAttribute(): ?string
    {
        $bmi = $this->bmi;

        if ($bmi === null) {
            return null;
        }

        if ($bmi < 18.5) return 'Underweight';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Overweight';
        return 'Obese';
    }

    /**
     * Scope to filter by gym.
     */
    public function scopeForGym($query, $gymId)
    {
        return $query->where('gym_id', $gymId);
    }

    /**
     * Scope to get records for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to order by most recent.
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('recorded_date', 'desc');
    }
}
