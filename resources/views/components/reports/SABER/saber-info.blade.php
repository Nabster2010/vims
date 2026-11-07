@php
    $sections = [
        'General Information' => [
            'Manufacturer' => $reportData['manufacturer'] ?? '',
            'Model Type' => $reportData['modelType'] ?? '',
            'Model Division' => $reportData['model_division'] ?? '',
            'Manufacturing Year' => $reportData['manufacturing_year'] ?? '',
            'Manufacturing Month' => $reportData['manufacturing_month'] ?? '',
            'Model Year' => $reportData['model_year'] ?? '',
            'Vehicle Category' => $reportData['category'] ?? '',
            'Motorcycle Category' => $reportData['motorcycle_category'] ?? '',
            'Color' => $reportData['color'] ?? '',
            'Production Country' => $reportData['productionCountry'] ?? '',
            'Origin Country' => $reportData['originCountry'] ?? '',
            'Shipment Country' => $reportData['shipmentCountry'] ?? '',
            'Vehicle Condition' => $reportData['vehicle_condition'] ?? '',
        ],

        'Powertrain' => [
            'Fuel Type' => $reportData['fuel_type'] ?? '',
            'Gearbox Type' => $reportData['gearbox_type'] ?? '',
            'Drive Line' => $reportData['drive_line'] ?? '',
            'Air Intake' => $reportData['air_intake'] ?? '',
            'Engine Number' => $reportData['engine_no'] ?? '',
            'Engine Displacement' => $reportData['engine_displacement'] ?? '',
            'Engine Power' => $reportData['engine_power'] ?? '',
            'Engine Power RPM' => $reportData['engine_power_rpm'] ?? '',
            'Number of Cylinders' => $reportData['number_of_cylinders'] ?? '',
        ],

        'Electric Vehicle Information' => [
            'Electric Motor Power' => $reportData['electric_motor_power'] ?? '',
            'Battery Type' => $reportData['battery_type'] ?? '',
            'Battery Capacity' => $reportData['battery_capacity'] ?? '',
            'Battery Voltage' => $reportData['battery_voltage'] ?? '',
            'Battery Charge Time' => $reportData['battery_charge_time'] ?? '',
            'Electric Consumption' => $reportData['electric_consumption'] ?? '',
        ],

        'Capacity & Dimensions' => [
            'Number of Seats' => $reportData['number_of_seats'] ?? '',
            'Mileage' => $reportData['mileage'] ?? '',
            'Number of Doors' => $reportData['number_of_doors'] ?? '',
            'Number of Axles' => $reportData['number_of_axles'] ?? '',
            'Gross Weight' => $reportData['gross_weight'] ?? '',
            'Curb Weight' => $reportData['curb_weight'] ?? '',
            'Load Weight' => $reportData['load_weight'] ?? '',
            'Front Axle Weight' => $reportData['front_axle_weight'] ?? '',
            'Rear Axle Weight' => $reportData['rear_axle_weight'] ?? '',
            'Wheelbase' => $reportData['wheelbase'] ?? '',
            'Length' => $reportData['length'] ?? '',
            'Width' => $reportData['width'] ?? '',
            'Height' => $reportData['height'] ?? '',
            'Front Track Width' => $reportData['front_track_width'] ?? '',
            'Rear Track Width' => $reportData['rear_track_width'] ?? '',
        ],

        'Braking & Performance' => [
            'Service Brake' => $reportData['service_brake'] ?? '',
            'Emergency Brake' => $reportData['emergency_brake'] ?? '',
            'Front Brake' => $reportData['front_brake'] ?? '',
            'Rear Brake' => $reportData['rear_brake'] ?? '',
            'Maximum Speed' => $reportData['maximum_speed'] ?? '',
        ],

        'Fuel Economy & Compliance' => [
            'Fuel Economy' => $reportData['fuel_economy'] ?? '',
            'Equivalent Fuel Economy' => $reportData['equivalent_fuel_economy'] ?? '',
            'Energy Efficiency Compliance' => $reportData['energy_efficiency_compliance'] ?? '',
            'Fuel Economy Compliance' => $reportData['fuel_economy_compliance'] ?? '',
            'Vehicle Age Compliance' => $reportData['vehicle_age_compliance'] ?? '',
            'Rare Vehicle' => $reportData['is_vehicle_rare'] ?? '',
        ],

        'Additional Information' => [
            'Motorcycle Use' => $reportData['motorcycle_use'] ?? '',
            'Remarks' => $reportData['remarks'] ?? '',
            'Inspected By' => ($reportData['inspector'] ?? null)?->name ?? '',
        ],
    ];
@endphp

<div class="vehicle-details">

    @foreach ($sections as $title => $items)
        @php
            $items = collect($items)->reject(fn($value) => blank($value))->all();
        @endphp

        @continue(empty($items))

        <div class="vehicle-details-section">

            <div class="vehicle-details-title">
                {{ $title }}
            </div>

            <table class="vehicle-details-table">
                <tbody>
                    @foreach (array_chunk($items, 2, true) as $row)
                        <tr>
                            @foreach ($row as $label => $value)
                                <th>{{ $label }}</th>
                                <td>{{ $value }}</td>
                            @endforeach

                            @if (count($row) === 1)
                                <th></th>
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endforeach

</div>
