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
        Schema::create('emission_inspections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            $table->decimal('hc', 8, 2)->nullable();
            $table->decimal('co', 8, 2)->nullable();
            $table->decimal('lambda', 5, 3)->nullable();
            $table->decimal('opacity', 8, 2)->nullable();
            $table->string('result', 20)->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('inspected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emission_inspections');
    }
};
