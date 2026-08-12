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
        Schema::create('submission_grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('score', 5, 2);
            $table->text('feedback')->nullable();
            $table->uuid('teacher_id');
            $table->uuid('submission_id');
            $table->timestamps();

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_grades');
    }
};
