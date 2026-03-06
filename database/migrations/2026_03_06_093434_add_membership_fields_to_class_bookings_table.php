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
        Schema::table('class_bookings', function (Blueprint $table) {
            $table->string('membership_type')->nullable()->after('gym_id'); // monthly or yearly
            $table->date('start_date')->nullable()->after('membership_type');
            $table->date('end_date')->nullable()->after('start_date');
            $table->text('notes')->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'membership_type',
                'start_date',
                'end_date',
                'notes',
            ]);
        });
    }
};
