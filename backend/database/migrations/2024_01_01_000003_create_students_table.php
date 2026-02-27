<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->unsignedTinyInteger('grade')->default(1)->comment('Kelas 1-6 SD');
            $table->date('birth_date')->nullable();
            $table->string('avatar')->nullable();
            $table->json('interests')->nullable()->comment('Minat anak, e.g. ["dinosaurus","luar angkasa"]');
            $table->string('cognitive_level')->default('beginner')->comment('beginner, intermediate, advanced');
            $table->unsignedInteger('stars')->default(0);
            $table->unsignedInteger('level')->default(1);
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'grade']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
