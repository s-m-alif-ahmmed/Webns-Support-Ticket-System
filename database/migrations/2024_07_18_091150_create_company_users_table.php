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
        if (!Schema::hasTable('company_users')) {
            Schema::create('company_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->foreignId('company_user_id')->nullable();
                $table->foreignId('update_company_user_id')->nullable();
                $table->foreignId('employee_id')->unique();
                $table->foreignId('company_id')->nullable();
                $table->foreignId('sub_company_id')->nullable();
                $table->foreignId('location_id')->nullable();
                $table->foreignId('department_id')->nullable();
                $table->foreignId('designation_id')->nullable();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->text('photo')->nullable();
                $table->string('number')->nullable();
                $table->text('address')->nullable();
                $table->string('gender')->nullable();
                $table->string('role')->nullable();
                $table->string('task_role')->nullable();
                $table->longText('permission')->nullable();
                $table->string('status')->default('Active');
                $table->integer('ban_status')->default(1);
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webns_users');
    }
};
