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
        if (!Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('industry_id')->nullable();
                $table->foreignId('company_id')->nullable();
                $table->foreignId('sub_company_id')->nullable();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->text('location');
                $table->string('branch_code');
                $table->string('location_code')->nullable();
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
        Schema::dropIfExists('locations');
    }
};
