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
        Schema::create('imported_vehicle_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('request_no');

            $table->date('request_date');

            $table->string('custom_declaration_no');

            $table->date('custom_declaration_date');

            $table->foreignId('custom_port_id')
                ->constrained()
                ->restrictOnDelete();
            $table->string('payment_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imported_vehicle_registrations');
    }
};
