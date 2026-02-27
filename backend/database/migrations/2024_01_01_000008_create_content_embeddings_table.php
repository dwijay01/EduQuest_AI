<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_embeddings', function (Blueprint $table) {
            $table->id();
            $table->string('embeddable_type');
            $table->unsignedBigInteger('embeddable_id');
            $table->text('content_text')->nullable()->comment('Original text that was embedded');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['embeddable_type', 'embeddable_id']);
        });

        // Add vector column using raw SQL (pgvector)
        DB::statement('ALTER TABLE content_embeddings ADD COLUMN embedding vector(768)');

        // Create an IVFFlat index for fast similarity search
        DB::statement('CREATE INDEX content_embeddings_embedding_idx ON content_embeddings USING ivfflat (embedding vector_cosine_ops) WITH (lists = 100)');
    }

    public function down(): void
    {
        Schema::dropIfExists('content_embeddings');
    }
};
