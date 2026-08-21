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
        Schema::create('submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('notes');
            $table->unsignedTinyInteger('attempt_number');
            $table->uuid('student_id');
            $table->uuid('assignment_id');
            $table->timestamp('submitted_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('assignment_id')
                ->references('id')
                ->on('assignments')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
