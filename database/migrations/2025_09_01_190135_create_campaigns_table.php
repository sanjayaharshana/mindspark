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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->text('campaign_id');
            $table->text('name');
            $table->text('status');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->integer('days');
            $table->text('notes')->nullable();
            $table->text('organizer_id');
            $table->text('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
