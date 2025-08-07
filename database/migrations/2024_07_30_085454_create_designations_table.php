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
        if (!Schema::hasTable('designations')) {
            Schema::create('designations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sub_company_id')->nullable();
                $table->foreignId('location_id')->nullable();
                $table->foreignId('department_id')->nullable();
                $table->foreignId('create_user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->string('name');
                $table->string('designation_slug')->nullable();
                $table->string('status')->default('Published');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
