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
        Schema::create('inspection_type_visual_item', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('visual_item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_required')->default(true);

            $table->timestamps();

            $table->unique([
                'inspection_type_id',
                'visual_item_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_type_visual_item');
    }
};
