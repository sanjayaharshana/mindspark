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
        Schema::table('event_jobs', function (Blueprint $table) {
            $table->decimal('default_commission_coordinator', 8, 2)->nullable()->after('activation_end_date')->comment('Default commission percentage for coordinators');
            $table->decimal('default_salary_promoter', 10, 2)->nullable()->after('default_commission_coordinator')->comment('Default daily salary for promoters');
            $table->text('salary_rules')->nullable()->after('default_salary_promoter')->comment('Salary calculation rules and policies');
            $table->text('special_note')->nullable()->after('salary_rules')->comment('Special notes for this event job');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_jobs', function (Blueprint $table) {
            $table->dropColumn([
                'default_commission_coordinator',
                'default_salary_promoter', 
                'salary_rules',
                'special_note'
            ]);
        });
    }
};