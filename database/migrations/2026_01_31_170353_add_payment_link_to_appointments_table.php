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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('payment_link')->nullable()->after('fee');
            // nullable() allows appointments without a link initially
            // after('fee') places it after the fee column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('payment_link');
        });
    }
};
