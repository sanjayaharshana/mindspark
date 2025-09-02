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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('tax_id')->nullable();
            $table->decimal('base_salary', 10, 2)->default(0);
            $table->decimal('bonus_percentage', 5, 2)->default(0);
            $table->enum('status', ['active', 'inactive', 'suspended', 'retired'])->default('active');
            $table->date('join_date')->nullable();
            $table->date('promotion_date')->nullable();
            $table->integer('team_size')->default(0);
            $table->text('responsibilities')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
