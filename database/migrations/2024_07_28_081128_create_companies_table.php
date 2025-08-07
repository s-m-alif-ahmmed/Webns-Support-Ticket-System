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
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('industry_id')->nullable();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->string('name');
                $table->text('image')->nullable();
                $table->text('web_slug')->nullable();
                $table->string('company_code')->nullable();
                $table->string('company_slug')->nullable();
                $table->text('company_prefix')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
