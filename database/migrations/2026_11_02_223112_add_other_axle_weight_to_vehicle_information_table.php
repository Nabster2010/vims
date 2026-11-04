<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicle_information', function (Blueprint $table) {
            $table->unsignedSmallInteger('other_axle_weight')->nullable()
                ->after('rear_axle_weight');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_information', function (Blueprint $table) {
            $table->dropColumn('other_axle_weight');
        });
    }
};
