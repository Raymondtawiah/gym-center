<?php

namespace Database\Seeders;

use App\Models\GymClass;
use Illuminate\Database\Seeder;

class GymClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'Morning Yoga',
                'description' => 'Start your day with energizing yoga poses and breathing exercises',
                'instructor' => 'Sarah Johnson',
                'day_of_week' => 'Monday',
                'start_time' => '06:00',
                'end_time' => '07:00',
                'capacity' => 20,
                'room' => 'Studio A',
                'is_active' => true,
            ],
            [
                'name' => 'HIIT Cardio',
                'description' => 'High-intensity interval training to boost your metabolism',
                'instructor' => 'Mike Chen',
                'day_of_week' => 'Monday',
                'start_time' => '18:00',
                'end_time' => '19:00',
                'capacity' => 15,
                'room' => 'Main Floor',
                'is_active' => true,
            ],
            [
                'name' => 'Strength Training',
                'description' => 'Build muscle and strength with weights and resistance training',
                'instructor' => 'David Wilson',
                'day_of_week' => 'Tuesday',
                'start_time' => '07:00',
                'end_time' => '08:00',
                'capacity' => 12,
                'room' => 'Weight Room',
                'is_active' => true,
            ],
            [
                'name' => 'Spin Class',
                'description' => 'Indoor cycling for cardio and endurance',
                'instructor' => 'Emma Davis',
                'day_of_week' => 'Tuesday',
                'start_time' => '12:00',
                'end_time' => '13:00',
                'capacity' => 25,
                'room' => 'Cycling Studio',
                'is_active' => true,
            ],
            [
                'name' => 'Pilates',
                'description' => 'Core strengthening and flexibility exercises',
                'instructor' => 'Sarah Johnson',
                'day_of_week' => 'Wednesday',
                'start_time' => '06:00',
                'end_time' => '07:00',
                'capacity' => 18,
                'room' => 'Studio A',
                'is_active' => true,
            ],
            [
                'name' => 'Boxing Fitness',
                'description' => 'Learn boxing techniques while getting a great workout',
                'instructor' => 'Mike Chen',
                'day_of_week' => 'Wednesday',
                'start_time' => '19:00',
                'end_time' => '20:00',
                'capacity' => 20,
                'room' => 'Boxing Ring',
                'is_active' => true,
            ],
            [
                'name' => 'Zumba',
                'description' => 'Dance your way to fitness with Latin-inspired moves',
                'instructor' => 'Lisa Martinez',
                'day_of_week' => 'Thursday',
                'start_time' => '18:00',
                'end_time' => '19:00',
                'capacity' => 30,
                'room' => 'Studio B',
                'is_active' => true,
            ],
            [
                'name' => 'CrossFit',
                'description' => 'Functional fitness with varied high-intensity workouts',
                'instructor' => 'David Wilson',
                'day_of_week' => 'Thursday',
                'start_time' => '07:00',
                'end_time' => '08:00',
                'capacity' => 15,
                'room' => 'CrossFit Area',
                'is_active' => true,
            ],
            [
                'name' => 'Evening Yoga',
                'description' => 'Unwind with relaxing yoga stretches',
                'instructor' => 'Sarah Johnson',
                'day_of_week' => 'Friday',
                'start_time' => '19:00',
                'end_time' => '20:00',
                'capacity' => 20,
                'room' => 'Studio A',
                'is_active' => true,
            ],
            [
                'name' => 'Weekend Bootcamp',
                'description' => 'Intensive full-body workout to end your week',
                'instructor' => 'Mike Chen',
                'day_of_week' => 'Saturday',
                'start_time' => '09:00',
                'end_time' => '10:30',
                'capacity' => 25,
                'room' => 'Main Floor',
                'is_active' => true,
            ],
        ];

        foreach ($classes as $class) {
            GymClass::create($class);
        }
    }
}
