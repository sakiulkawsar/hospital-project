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
        Schema::create('appointments', function (Blueprint $table) {
             $table->id();
            $table->string('full_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('submission_date')->nullable();
            $table->string('specialty')->nullable();
            $table->string('number')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->default('inprogress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
