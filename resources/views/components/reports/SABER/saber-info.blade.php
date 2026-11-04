@props(['reportData'])

@php

    $sections = [
        [
            'title' => 'General Information',
            'rows' => [
                ['Inspection Type', $reportData['inspection_type_name']],
                ['Inspection Date', $reportData['created_at']],
                ['Manufacturer', $reportData['manufacturer']],
                ['Model Type', $reportData['modelType']],
                ['Model Division', $reportData['model_division']],
                ['Manufacturing Year', $reportData['manufacturing_year']],
                ['Manufacturing Month', $reportData['manufacturing_month'] ?? ''],
                ['Model Year', $reportData['model_year']],
                ['Vehicle Condition', $reportData['vehicle_condition']],
            ],
        ],

        [
            'title' => 'Vehicle Identification',
            'rows' => [
                ['Category', $reportData['category']],
                ['Color', $reportData['color']],
                ['Production Country', $reportData['productionCountry']],
                ['Origin Country', $reportData['originCountry']],
                ['Shipment Country', $reportData['shipmentCountry']],
                ['Fuel Type', $reportData['fuel_type']],
                ['Gearbox', $reportData['gearbox']],
                ['Drive Line', $reportData['drive_line']],
                ['Air Intake', $reportData['air_intake']],
            ],
        ],

        [
            'title' => 'Engine Specifications',
            'rows' => [
                ['Engine No.', $reportData['engine_no']],
                ['Displacement', $reportData['engine_displacement']],
                ['Power', $reportData['engine_power']],
                ['Power RPM', $reportData['engine_power_rpm']],
                ['Cylinders', $reportData['number_of_cylinders']],
                ['Maximum Speed', $reportData['maximum_speed']],
            ],
        ],

        [
            'title' => 'Electric Vehicle',
            'rows' => [
                ['Motor Power', $reportData['electric_motor_power']],
                ['Battery Type', $reportData['battery_type']],
                ['Capacity', $reportData['battery_capacity']],
                ['Voltage', $reportData['battery_voltage']],
                ['Charge Time', $reportData['battery_charge_time']],
                ['Consumption', $reportData['electric_consumption']],
            ],
        ],

        [
            'title' => 'Dimensions',
            'rows' => [
                ['Length', $reportData['length']],
                ['Width', $reportData['width']],
                ['Height', $reportData['height']],
                ['Wheelbase', $reportData['wheelbase']],
                ['Front Track', $reportData['front_track_width']],
                ['Rear Track', $reportData['rear_track_width']],
            ],
        ],

        [
            'title' => 'Weight Information',
            'rows' => [
                ['Gross Weight', $reportData['gross_weight']],
                ['Curb Weight', $reportData['curb_weight']],
                ['Load Weight', $reportData['load_weight']],
                ['Front Axle', $reportData['front_axle_weight']],
                ['Rear Axle', $reportData['rear_axle_weight']],
                ['Number of Axles', $reportData['number_of_axles']],
            ],
        ],

        [
            'title' => 'Capacity',
            'rows' => [
                ['Seats', $reportData['number_of_seats']],
                ['Doors', $reportData['number_of_doors']],
                ['Mileage', $reportData['mileage']],
                ['Motorcycle Category', $reportData['motorcycle_category'] ?? 'N/A'],
                ['Motorcycle Use', $reportData['motorcycle_use'] ?? 'N/A'],
            ],
        ],

        [
            'title' => 'Brake System',
            'rows' => [
                ['Service Brake', $reportData['service_brake']],
                ['Emergency Brake', $reportData['emergency_brake']],
                ['Front Brake', $reportData['front_brake']],
                ['Rear Brake', $reportData['rear_brake']],
            ],
        ],

        [
            'title' => 'Fuel Economy & Compliance',
            'rows' => [
                ['Fuel Economy', $reportData['fuel_economy']],
                ['Equivalent Economy', $reportData['equivalent_fuel_economy']],
                ['Energy Efficiency', $reportData['energy_efficiency_compliance']],
                ['Fuel Economy Compliance', $reportData['fuel_economy_compliance']],
                ['Vehicle Age Compliance', $reportData['vehicle_age_compliance']],
                ['Rare Vehicle', $reportData['is_vehicle_rare']],
            ],
        ],
    ];

@endphp


<div class="specifications-section" dir="ltr">

    <div class="specifications-title">
        Vehicle Technical Specifications
    </div>

    <table class="specifications-layout">

        <tbody>

            @foreach (array_chunk($sections, 2) as $sectionPair)
                <tr>

                    @foreach ($sectionPair as $section)
                        <td class="specification-column">

                            <table class="specification-table">

                                <thead>

                                    <tr>
                                        <th colspan="2">
                                            {{ $section['title'] }}
                                        </th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($section['rows'] as $row)
                                        <tr>

                                            <td class="spec-label">
                                                {{ $row[0] }}
                                            </td>

                                            <td class="spec-value">
                                                {{ $row[1] ?? '' }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </td>
                    @endforeach

                    @if (count($sectionPair) === 1)
                        <td class="specification-column"></td>
                    @endif

                </tr>
            @endforeach

        </tbody>

    </table>

</div>
