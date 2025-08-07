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
        if (!Schema::hasTable('ticket_assigns')) {
            Schema::create('ticket_assigns', function (Blueprint $table) {
                $table->id();
                $table->foreignId('create_user_id')->nullable();
                $table->foreignId('update_user_id')->nullable();
                $table->foreignId('ticket_id')->nullable();
                $table->foreignId('assign_user_id')->nullable();
                $table->string('work_role')->nullable();
                $table->dateTime('approx_end_time')->nullable();
                $table->dateTime('updated_approx_end_time')->nullable();
                $table->string('status')->default('On');
                $table->string('assign_status')->default('Pending');
                $table->dateTime('work_end_time')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_asigns');
    }
};
