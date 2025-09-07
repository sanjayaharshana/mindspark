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
        Schema::create('event_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_number')->unique();
            $table->string('job_name');
            $table->string('client_name');
            $table->date('activation_start_date');
            $table->date('activation_end_date')->nullable();
            $table->string('officer_name');
            $table->string('reporter_officer_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_jobs');
    }
};
