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
        Schema::create('class_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->string('academic_year', 10);
            $table->uuid('major_id');
            $table->uuid('homeroom_teacher_id');
            $table->uuid('created_by');
            $table->timestamps();

            $table->foreign('major_id')
                ->references('id')
                ->on('majors')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('homeroom_teacher_id')
                ->references('id')
                ->on('teachers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_groups');
    }
};
