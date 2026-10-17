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
        Schema::table('vehicle_information', function (Blueprint $table) {

            $table->foreignId('category_id')
                ->nullable()
                ->after('gearbox_type')
                ->constrained()
                ->restrictOnDelete();

            $table->dropColumn('body_type');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_information', function (Blueprint $table) {

            $table->string('body_type')->nullable();

            $table->dropConstrainedForeignId('category_id');
        });
    }
};
