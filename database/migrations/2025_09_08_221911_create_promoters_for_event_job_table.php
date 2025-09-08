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
        Schema::create('promoters_for_event_job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promoter_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->decimal('supervisor_commission', 10, 2)->default(0);
            $table->decimal('promoter_salary_per_day', 10, 2)->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('promoter_id')->references('id')->on('promoters')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('event_jobs')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('promoters')->onDelete('cascade');

            // Unique constraint to prevent duplicate promoter assignments to same event
            $table->unique(['promoter_id', 'event_id']);
            
            // Indexes for better performance
            $table->index(['event_id', 'supervisor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promoters_for_event_job');
    }
};