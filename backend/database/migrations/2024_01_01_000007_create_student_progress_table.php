<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->float('mastery_level')->default(0)->comment('0.0 to 1.0');
            $table->unsignedInteger('attempts_count')->default(0);
            $table->unsignedSmallInteger('best_score')->default(0);
            $table->timestamp('last_attempt_at')->nullable();
            $table->string('status')->default('not_started')->comment('not_started, in_progress, mastered');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'topic_id']);
            $table->index(['student_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_progress');
    }
};
