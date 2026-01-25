<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {

            // Foreign keys
            $table->foreignId('specialty_id')
                  ->nullable()
                  ->after('message')
                  ->constrained('specialties')
                  ->nullOnDelete();

            $table->foreignId('doctor_id')
                  ->nullable()
                  ->after('specialty_id')
                  ->constrained('doctors')
                  ->nullOnDelete();

            // Appointment schedule
            $table->date('appointment_date')->nullable()->after('status');
            $table->time('appointment_time')->nullable()->after('appointment_date');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {

            $table->dropForeign(['specialty_id']);
            $table->dropForeign(['doctor_id']);

            $table->dropColumn([
                'specialty_id',
                'doctor_id',
                'appointment_date',
                'appointment_time',
            ]);
        });
    }
};
