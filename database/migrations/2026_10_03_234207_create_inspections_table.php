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
   Schema::create('inspections', function (Blueprint $table) {

    $table->id();

    $table->uuid('uuid')->unique();

    $table->string('inspection_no',30)->unique();

    $table->foreignId('branch_id')
        ->constrained()
        ->restrictOnDelete();

    $table->foreignId('inspection_type_id')
        ->constrained()
        ->restrictOnDelete();

    $table->foreignId('customer_id')
        ->constrained()
        ->restrictOnDelete();

    $table->foreignId('sales_representative_id')
        ->constrained()
        ->restrictOnDelete();

    $table->string('vin', 17)->unique();

    $table->string('status');

    $table->string('final_result')->nullable();

    $table->foreignId('created_by')
        ->constrained('users')
        ->restrictOnDelete();

    $table->foreignId('inspector_id')
        ->nullable()
        ->constrained('users')
        ->restrictOnDelete();

    $table->foreignId('approved_by')
        ->nullable()
        ->constrained('users')
        ->restrictOnDelete();

    $table->timestamp('registered_at');

    $table->timestamp('inspection_started_at')->nullable();

    $table->timestamp('inspection_completed_at')->nullable();

    $table->timestamp('approved_at')->nullable();

    $table->unsignedTinyInteger('reinspection_count')->default(0);

    $table->boolean('is_locked')->default(false);

    $table->text('remarks')->nullable();

    $table->timestamps();

    $table->index('status');
    $table->index('registered_at');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
