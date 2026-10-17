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
        Schema::create('vehicle_information', function (Blueprint $table) {
            $table->id();

            $table->foreignId('inspection_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->date('inspection_date')->nullable();

            $table->foreignId('manufacturer_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('model_type_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->string('model_division')->nullable();

            $table->unsignedSmallInteger('manufacturing_year')->nullable();
            $table->unsignedSmallInteger('manufacturing_month')->nullable();
            $table->unsignedSmallInteger('model_year')->nullable();
            $table->string('motorcycle_category')->nullable();

            $table->foreignId('color_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('production_country_id')
                ->nullable()
                ->constrained('countries')
                ->restrictOnDelete();

            $table->foreignId('origin_country_id')
                ->nullable()
                ->constrained('countries')
                ->restrictOnDelete();

            $table->foreignId('shipment_country_id')
                ->nullable()
                ->constrained('countries')
                ->restrictOnDelete();


            $table->string('fuel_type')->nullable();

            $table->string('gearbox_type')->nullable();

            $table->string('drive_line')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();
            $table->string('air_intake')->nullable();

            $table->string('vehicle_condition')->nullable();

            $table->string('engine_no')->nullable();

            $table->unsignedSmallInteger('engine_displacement')->nullable();

            $table->unsignedSmallInteger('engine_power')->nullable();
            $table->unsignedSmallInteger('engine_power_rpm')->nullable();
            $table->unsignedSmallInteger('number_of_cylinders')->nullable();

            $table->unsignedSmallInteger('electric_motor_power')->nullable();

            $table->string('battery_type')->nullable();

            $table->decimal('battery_capacity', 8, 2)->nullable();

            $table->unsignedSmallInteger('battery_voltage')->nullable();

            $table->unsignedSmallInteger('battery_charge_time')->nullable();

            $table->decimal('electric_consumption', 8, 2)->nullable();

            $table->unsignedSmallInteger('number_of_seats')->nullable();

            $table->unsignedSmallInteger('number_of_doors')->nullable();

            $table->unsignedInteger('mileage')->nullable();

            $table->unsignedSmallInteger('number_of_axles')->nullable();

            $table->unsignedSmallInteger('gross_weight')->nullable();

            $table->unsignedSmallInteger('curb_weight')->nullable();

            $table->unsignedSmallInteger('load_weight')->nullable();

            $table->unsignedSmallInteger('front_axle_weight')->nullable();

            $table->unsignedSmallInteger('rear_axle_weight')->nullable();

            $table->unsignedSmallInteger('wheelbase')->nullable();

            $table->unsignedSmallInteger('width')->nullable();

            $table->unsignedSmallInteger('height')->nullable();

            $table->unsignedSmallInteger('length')->nullable();

            $table->unsignedSmallInteger('front_track_width')->nullable();

            $table->unsignedSmallInteger('rear_track_width')->nullable();

            $table->string('motorcycle_use')->nullable();

            $table->unsignedSmallInteger('maximum_speed')->nullable();

            $table->string('service_brake')->nullable();

            $table->string('emergency_brake')->nullable();

            $table->string('front_brake')->nullable();

            $table->string('rear_brake')->nullable();

            $table->decimal('fuel_economy', 8, 2)->nullable();

            $table->unsignedSmallInteger('equivalent_fuel_economy')->nullable();

            $table->string('energy_efficiency_compliance')->nullable();
            $table->string('fuel_economy_compliance')->nullable();
            $table->string('vehicle_age_compliance')->nullable();
            $table->string('is_vehicle_rare')->nullable();
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
        Schema::dropIfExists('vehicle_information');
    }
};
