<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('learning_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->string('session_type')->default('practice')->comment('practice, quiz, review, baseline');
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->unsignedSmallInteger('score')->default(0);
            $table->unsignedSmallInteger('total_questions')->default(0);
            $table->unsignedSmallInteger('correct_answers')->default(0);
            $table->unsignedInteger('time_spent_seconds')->default(0);
            $table->text('ai_feedback')->nullable();
            $table->json('answers_detail')->nullable()->comment('Detailed answers per question');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['student_id', 'topic_id']);
            $table->index(['student_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_sessions');
    }
};
