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
        Schema::create('branches', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('name');

            $table->string('code', 10)->unique();

            $table->text('address');

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('phone', 20)->nullable();

            $table->string('email')->nullable();

            $table->string('logo_path')->nullable();

            $table->string('stamp_path')->nullable();

            $table->unsignedBigInteger('last_inspection_sequence')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
