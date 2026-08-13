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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('place', 100);
            $table->time('started_at');
            $table->time('finished_at');
            $table->string('day', 100);
            $table->uuid('course_offering_id');
            $table->uuid('created_by');
            $table->timestamps();

            $table->foreign('course_offering_id')
                ->references('id')
                ->on('course_offerings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
