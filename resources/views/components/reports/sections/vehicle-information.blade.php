@props(['inspection'])

@php
    $sections = [
        'General Information' => [
            'Manufacturer' => $inspection->vehicleInformation->manufacturer?->name,
            'Model Type' => $inspection->vehicleInformation->modelType?->name,
            'Model Division' => $inspection->vehicleInformation->model_division,
            'Manufacturing Year' => $inspection->vehicleInformation->manufacturing_year,
            'Manufacturing Month' => $inspection->vehicleInformation->manufacturing_month,
            'Model Year' => $inspection->vehicleInformation->model_year,
            'Vehicle Category' => $inspection->vehicleInformation->category?->name,
            'Motorcycle Category' => $inspection->vehicleInformation->motorcycle_category,
            'Color' => $inspection->vehicleInformation->color?->name,
            'Production Country' => $inspection->vehicleInformation->productionCountry?->name,
            'Origin Country' => $inspection->vehicleInformation->originCountry?->name,
            'Shipment Country' => $inspection->vehicleInformation->shipmentCountry?->name,
            'Vehicle Condition' => $inspection->vehicleInformation->vehicle_condition,
        ],

        'Powertrain' => [
            'Fuel Type' => $inspection->vehicleInformation->fuel_type,
            'Gearbox Type' => $inspection->vehicleInformation->gearbox_type,
            'Drive Line' => $inspection->vehicleInformation->drive_line,
            'Air Intake' => $inspection->vehicleInformation->air_intake,
            'Engine Number' => $inspection->vehicleInformation->engine_no,
            'Engine Displacement' => $inspection->vehicleInformation->engine_displacement,
            'Engine Power' => $inspection->vehicleInformation->engine_power,
            'Engine Power RPM' => $inspection->vehicleInformation->engine_power_rpm,
            'Number of Cylinders' => $inspection->vehicleInformation->number_of_cylinders,
        ],

        'Electric Vehicle Information' => [
            'Electric Motor Power' => $inspection->vehicleInformation->electric_motor_power,
            'Battery Type' => $inspection->vehicleInformation->battery_type,
            'Battery Capacity' => $inspection->vehicleInformation->battery_capacity,
            'Battery Voltage' => $inspection->vehicleInformation->battery_voltage,
            'Battery Charge Time' => $inspection->vehicleInformation->battery_charge_time,
            'Electric Consumption' => $inspection->vehicleInformation->electric_consumption,
        ],

        'Capacity & Dimensions' => [
            'Number of Seats' => $inspection->vehicleInformation->number_of_seats,
            'Mileage' => $inspection->vehicleInformation->mileage,
            'Number of Doors' => $inspection->vehicleInformation->number_of_doors,
            'Number of Axles' => $inspection->vehicleInformation->number_of_axles,
            'Gross Weight' => $inspection->vehicleInformation->gross_weight,
            'Curb Weight' => $inspection->vehicleInformation->curb_weight,
            'Load Weight' => $inspection->vehicleInformation->load_weight,
            'Front Axle Weight' => $inspection->vehicleInformation->front_axle_weight,
            'Rear Axle Weight' => $inspection->vehicleInformation->rear_axle_weight,
            'Wheelbase' => $inspection->vehicleInformation->wheelbase,
            'Length' => $inspection->vehicleInformation->length,
            'Width' => $inspection->vehicleInformation->width,
            'Height' => $inspection->vehicleInformation->height,
            'Front Track Width' => $inspection->vehicleInformation->front_track_width,
            'Rear Track Width' => $inspection->vehicleInformation->rear_track_width,
        ],

        'Braking & Performance' => [
            'Service Brake' => $inspection->vehicleInformation->service_brake,
            'Emergency Brake' => $inspection->vehicleInformation->emergency_brake,
            'Front Brake' => $inspection->vehicleInformation->front_brake,
            'Rear Brake' => $inspection->vehicleInformation->rear_brake,
            'Maximum Speed' => $inspection->vehicleInformation->maximum_speed,
        ],

        'Fuel Economy & Compliance' => [
            'Fuel Economy' => $inspection->vehicleInformation->fuel_economy,
            'Equivalent Fuel Economy' => $inspection->vehicleInformation->equivalent_fuel_economy,
            'Energy Efficiency Compliance' => $inspection->vehicleInformation->energy_efficiency_compliance,
            'Fuel Economy Compliance' => $inspection->vehicleInformation->fuel_economy_compliance,
            'Vehicle Age Compliance' => $inspection->vehicleInformation->vehicle_age_compliance,
            'Rare Vehicle' => $inspection->vehicleInformation->is_vehicle_rare ? 'Yes' : 'No',
        ],

        'Additional Information' => [
            'Motorcycle Use' => $inspection->vehicleInformation->motorcycle_use,
            'Remarks' => $inspection->vehicleInformation->remarks,
            'Inspected By' => $inspection->vehicleInformation->inspector?->name,
            'Inspection Date' => optional($inspection->vehicleInformation->inspection_date)?->format('d/m/Y'),
        ],
    ];
@endphp

<div class="space-y-6">

    @foreach ($sections as $title => $items)
        @php
            $items = collect($items)->reject(fn($value) => blank($value))->all();
        @endphp

        @continue(empty($items))

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

            <div class="border-b bg-gray-100 px-4 py-3">
                <h3 class="text-base font-semibold text-gray-800">
                    {{ $title }}
                </h3>
            </div>

            <table class="w-full border-collapse text-sm">

                <tbody>

                    @foreach (array_chunk($items, 2, true) as $row)
                        <tr class="even:bg-gray-50">

                            @foreach ($row as $label => $value)
                                <th class="w-1/4 border px-3 py-2 text-left font-semibold bg-gray-50">
                                    {{ $label }}
                                </th>

                                <td class="w-1/4 border px-3 py-2">
                                    {{ $value }}
                                </td>
                            @endforeach

                            @if (count($row) === 1)
                                <th class="w-1/4 border bg-gray-50"></th>
                                <td class="w-1/4 border"></td>
                            @endif

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    @endforeach

</div>
