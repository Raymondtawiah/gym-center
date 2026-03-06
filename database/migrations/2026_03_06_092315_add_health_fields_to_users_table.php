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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('weight', 5, 2)->nullable()->after('date_of_birth'); // weight in kg
            $table->decimal('height', 5, 2)->nullable()->after('weight'); // height in cm
            $table->text('health_conditions')->nullable()->after('height'); // any medical conditions
            $table->text('allergies')->nullable()->after('health_conditions'); // any allergies
            $table->text('medications')->nullable()->after('allergies'); // current medications
            $table->text('fitness_goals')->nullable()->after('medications'); // fitness goals
            $table->boolean('injuries')->nullable()->after('fitness_goals'); // has any injuries
            $table->text('injury_details')->nullable()->after('injuries'); // details about injuries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'weight',
                'height',
                'health_conditions',
                'allergies',
                'medications',
                'fitness_goals',
                'injuries',
                'injury_details',
            ]);
        });
    }
};
