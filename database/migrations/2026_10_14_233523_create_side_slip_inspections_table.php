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
        Schema::create('side_slip_inspections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            $table->decimal('value', 8, 2)->nullable();

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
        Schema::dropIfExists('side_slip_inspections');
    }
};
