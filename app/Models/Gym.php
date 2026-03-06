<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gym extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'email',
        'logo',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        //
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Gym $gym) {
            if (empty($gym->slug)) {
                $gym->slug = Str::slug($gym->name);
            }
        });

        static::updating(function (Gym $gym) {
            if (empty($gym->slug)) {
                $gym->slug = Str::slug($gym->name);
            }
        });
    }

    /**
     * Get the admin (owner) of the gym.
     */
    public function admin()
    {
        return $this->hasOne(User::class, 'gym_id')->where('role', 'admin');
    }

    /**
     * Get all staff members of the gym.
     */
    public function staff()
    {
        return $this->hasMany(User::class, 'gym_id')->where('role', 'staff');
    }

    /**
     * Get all clients of the gym.
     */
    public function clients()
    {
        return $this->hasMany(User::class, 'gym_id')->where('role', 'client');
    }

    /**
     * Get all users (admin, staff, clients) of the gym.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'gym_id');
    }

    /**
     * Get all classes for the gym.
     */
    public function gymClasses()
    {
        return $this->hasMany(GymClass::class);
    }

    /**
     * Get all bookings for the gym.
     */
    public function classBookings()
    {
        return $this->hasMany(ClassBooking::class);
    }

    /**
     * Check if the gym is active.
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }
}
