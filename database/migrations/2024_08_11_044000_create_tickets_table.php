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
        if (!Schema::hasTable('tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('create_user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->foreignId('company_user_id')->nullable();
                $table->foreignId('update_company_user_id')->nullable();
                $table->foreignId('company_id')->nullable();
                $table->foreignId('sub_company_id')->nullable();
                $table->foreignId('location_id')->nullable();
                $table->foreignId('module_id')->nullable();
                $table->foreignId('sub_module_id')->nullable();
                $table->foreignId('ticket_nature_id')->nullable();
                $table->string('subject');
                $table->longText('description')->nullable();
                $table->longText('attachment')->nullable();
                $table->string('priority')->nullable();
                $table->string('operation_end_time')->nullable();
                $table->string('operation_status')->default('Pending');
                $table->string('read_status')->default('UnRead');
                $table->string('status')->default('Pending');
                $table->string('end_time')->nullable();
                $table->string('ticket_code')->nullable()->unique();
                $table->string('ticket_slug')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
