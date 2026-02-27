<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('grade_level')->comment('Kelas 1-6');
            $table->string('difficulty_level')->default('easy')->comment('easy, medium, hard');
            $table->unsignedInteger('order_index')->default(0);
            $table->json('prerequisites')->nullable()->comment('Array of topic IDs');
            $table->json('learning_objectives')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['subject_id', 'slug', 'grade_level']);
            $table->index(['subject_id', 'grade_level', 'order_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
