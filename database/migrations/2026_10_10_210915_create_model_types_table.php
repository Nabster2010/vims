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
        Schema::create('model_types', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('manufacturer_id')
                ->constrained('manufacturers')
                ->restrictOnDelete();

            $table->string('name');

            $table->string('name_ar');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique([
                'manufacturer_id',
                'name',
            ]);

            $table->unique([
                'manufacturer_id',
                'name_ar',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_types');
    }
};
