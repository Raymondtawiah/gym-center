<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gym_id')->nullable()->constrained()->nullOnDelete();
            $table->date('recorded_date');
            
            // Body measurements
            $table->decimal('weight', 5, 2)->nullable()->comment('Weight in kg');
            $table->decimal('height', 5, 2)->nullable()->comment('Height in cm');
            $table->decimal('body_fat_percentage', 5, 2)->nullable();
            $table->decimal('muscle_mass', 5, 2)->nullable()->comment('Muscle mass in kg');
            
            // Vital stats
            $table->integer('resting_heart_rate')->nullable()->comment('BPM');
            $table->string('blood_pressure')->nullable()->comment('e.g. 120/80');
            
            // Strength benchmarks
            $table->decimal('bench_press_max', 6, 2)->nullable()->comment('kg');
            $table->decimal('squat_max', 6, 2)->nullable()->comment('kg');
            $table->decimal('deadlift_max', 6, 2)->nullable()->comment('kg');
            
            // Cardio
            $table->integer('cardio_duration')->nullable()->comment('Minutes');
            $table->decimal('cardio_distance', 6, 2)->nullable()->comment('km');
            
            // Flexibility
            $table->decimal('sit_and_reach', 5, 2)->nullable()->comment('cm');
            
            // General assessment
            $table->integer('fitness_score')->nullable()->comment('1-10 scale');
            $table->text('notes')->nullable();
            $table->text('recommendations')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_performances');
    }
};
