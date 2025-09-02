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
        Schema::table('customers', function (Blueprint $table) {
            // Add company field if it doesn't exist
            if (!Schema::hasColumn('customers', 'company')) {
                $table->string('company')->nullable()->after('address');
            }
            
            // Add status field if it doesn't exist
            if (!Schema::hasColumn('customers', 'status')) {
                $table->enum('status', ['active', 'inactive', 'pending'])->default('active')->after('company');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['company', 'status']);
        });
    }
};
