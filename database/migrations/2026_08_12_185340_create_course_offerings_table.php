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
        Schema::create('course_offerings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->string('academic_year', 10);
            $table->uuid('subject_id');
            $table->uuid('class_group_id');
            $table->uuid('teacher_id');
            $table->uuid('created_by')->nullable();
            $table->timestamps();

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('class_group_id')
                ->references('id')
                ->on('class_groups')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

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
        Schema::dropIfExists('course_offerings');
    }
};
