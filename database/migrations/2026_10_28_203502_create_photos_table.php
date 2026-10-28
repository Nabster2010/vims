<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('photo_type', 50);

            $table->string('path');

            $table->text('remarks')->nullable();

            $table->unsignedSmallInteger('sort_order')->default(1);

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['inspection_id', 'photo_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
