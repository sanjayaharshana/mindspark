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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promoter_id');
            $table->date('promoter_attend_date');
            $table->unsignedBigInteger('event_id');
            $table->enum('status', ['attend', 'absent'])->default('absent');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('promoter_id')->references('id')->on('promoters')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('event_jobs')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate attendance records
            $table->unique(['promoter_id', 'promoter_attend_date', 'event_id']);
            
            // Indexes for better performance
            $table->index(['event_id', 'promoter_attend_date']);
            $table->index(['promoter_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};