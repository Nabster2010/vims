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
        Schema::create('suspension_inspections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            $table->decimal('front_left', 8, 2)->nullable();
            $table->decimal('front_right', 8, 2)->nullable();
            $table->decimal('rear_left', 8, 2)->nullable();
            $table->decimal('rear_right', 8, 2)->nullable();

            $table->string('result', 20)->nullable();

            $table->foreignId('inspected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspension_inspections');
    }
};
