@props(['reportData'])

@php
    $sections = [
        'General Information' => [
            'Report No' => $reportData['report_no'] ?? '',
            'Final Result' => $reportData['final_result'] ?? '',
            'Branch' => $reportData['branch'] ?? '',
            'Inspection Type' => $reportData['inspection_type_name'] ?? '',
            'Plate Number' => $reportData['plate_number'] ?? '',
            'VIN' => $reportData['vin'] ?? '',
            'Manufacturer' => $reportData['manufacturer'] ?? '',
            'Model Type' => $reportData['modelType'] ?? '',
            'Model Division' => $reportData['model_division'] ?? '',
            'Manufacturing Year' => $reportData['manufacturing_year'] ?? '',
            'Manufacturing Month' => $reportData['manufacturing_month'] ?? '',
            'Model Year' => $reportData['model_year'] ?? '',
            'Vehicle Category' => $reportData['category'] ?? '',
            'Motorcycle Category' => $reportData['motorcycle_category'] ?? '',
            'Motorcycle Use' => $reportData['motorcycle_use'] ?? '',
            'Color' => $reportData['color'] ?? '',
            'Production Country' => $reportData['productionCountry'] ?? '',
            'Origin Country' => $reportData['originCountry'] ?? '',
            'Shipment Country' => $reportData['shipmentCountry'] ?? '',
            'Vehicle Condition' => $reportData['vehicle_condition'] ?? '',
            'Inspection Date' => $reportData['inspection_date'] ?? '',
            'Modification Center Name' => $reportData['modification_center_name'] ?? '',
            'Modification Center Report No' => $reportData['modification_center_report_no'] ?? '',
            'Old Model' => $reportData['old_model'] ?? '',
            'New Model' => $reportData['new_model'] ?? '',
            'Request Origin' => $reportData['request_origin'] ?? '',
            'Modification Description' => $reportData['modification_description'] ?? '',
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
            'Front Brake Type' => $reportData['front_brake_type'] ?? '',
            'Rear Brake Type' => $reportData['rear_brake_type'] ?? '',
            'Service Brake Type' => $reportData['service_brake'] ?? '',
            'Emergency Brake Type' => $reportData['emergency_brake'] ?? '',
            'Maximum Speed' => $reportData['maximum_speed'] ?? '',
        ],

        'Electric Vehicle Information' => [
            'Electric Motor Power' => $reportData['electric_motor_power'] ?? '',
            'Battery Type' => $reportData['battery_type'] ?? '',
            'Battery Capacity' => $reportData['battery_capacity'] ?? '',
            'Battery Voltage' => $reportData['battery_voltage'] ?? '',
            'Battery Charge Time' => $reportData['battery_charge_time'] ?? '',
            'Electric Consumption' => $reportData['electric_consumption'] ?? '',
        ],

        'Dimensions & Weights' => [
            'Number of Seats' => $reportData['number_of_seats'] ?? '',
            'Mileage' => $reportData['mileage'] ?? '',
            'Number of Doors' => $reportData['number_of_doors'] ?? '',
            'Number of Axles' => $reportData['number_of_axles'] ?? '',
            'Gross Weight' => $reportData['gross_weight'] ?? '',
            'Curb Weight' => $reportData['curb_weight'] ?? '',
            'Load Weight' => $reportData['load_weight'] ?? '',
            'Front Axle Weight' => $reportData['front_axle_weight'] ?? '',
            'Rear Axle Weight' => $reportData['rear_axle_weight'] ?? '',
            'Other Axle Weight' => $reportData['other_axle_weight'] ?? '',
            'Wheelbase' => $reportData['wheelbase'] ?? '',
            'Length' => $reportData['length'] ?? '',
            'Width' => $reportData['width'] ?? '',
            'Height' => $reportData['height'] ?? '',
            'Front Track Width' => $reportData['front_track_width'] ?? '',
            'Rear Track Width' => $reportData['rear_track_width'] ?? '',
        ],

        'Performance' => [
            'Maximum Speed' => $reportData['maximum_speed'] ?? '',
            'Motorcycle Use' => $reportData['motorcycle_use'] ?? '',
        ],

        'Compliance' => [
            'Fuel Economy' => $reportData['fuel_economy'] ?? '',
            'Equivalent Fuel Economy' => $reportData['equivalent_fuel_economy'] ?? '',
            'Energy Efficiency Compliance' => $reportData['energy_efficiency_compliance'] ?? '',
            'Fuel Economy Compliance' => $reportData['fuel_economy_compliance'] ?? '',
            'Vehicle Age Compliance' => $reportData['vehicle_age_compliance'] ?? '',
            'Rare Vehicle' => $reportData['is_vehicle_rare'] ?? '',
        ],

        'Additional Information' => [
            'Remarks' => $reportData['remarks'] ?? '',
            'Inspected By' => $reportData['inspector_name'] ?? '',
        ],

        'Emission Test' => [
            'Final Result' => $reportData['emission_final_result'] ?? '',
            'CO' => $reportData['emission_co'] ?? '',
            'HC' => $reportData['emission_hc'] ?? '',
            'Opacity' => $reportData['emission_opacity'] ?? '',
        ],

        'Brake Test' => [
            'Final Result' => $reportData['brake_final_result'] ?? '',
            'Front Brake' => $reportData['front_brake'] ?? '',
            'Rear Brake' => $reportData['rear_brake'] ?? '',
            'Parking Brake' => $reportData['parking_brake'] ?? '',
        ],

        'Suspension Test' => [
            'Final Result' => $reportData['suspension_final_result'] ?? '',
            'Front Right' => $reportData['suspension_fr'] ?? '',
            'Front Left' => $reportData['suspension_fl'] ?? '',
            'Rear Right' => $reportData['suspension_rr'] ?? '',
            'Rear Left' => $reportData['suspension_rl'] ?? '',
        ],

        'Side Slip Test' => [
            'Final Result' => $reportData['side_slip_final_result'] ?? '',
            'Side Slip Value' => $reportData['side_slip_value'] ?? '',
        ],

        'Headlight Test' => [
            'Final Result' => $reportData['headlight_final_result'] ?? '',
            'Left Headlight' => $reportData['headlight_left'] ?? '',
            'Right Headlight' => $reportData['headlight_right'] ?? '',
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

    @if (!empty($reportData['visual_inspection_groups']))

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

            <div class="border-b bg-gray-100 px-4 py-3">
                <h3 class="text-base font-semibold text-gray-800">
                    Visual Inspection
                </h3>
            </div>

            @foreach ($reportData['visual_inspection_groups'] as $category => $items)
                <div class="border-b bg-gray-50 px-4 py-2">
                    <h4 class="font-semibold text-gray-700">
                        {{ ucwords(str_replace('_', ' ', $category)) }}
                    </h4>
                </div>

                <table class="w-full border-collapse text-sm">

                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-3 py-2 w-96">Item</th>
                            <th class="border px-3 py-2  ">Remarks</th>
                            <th class="border px-3 py-2 w-16">Modified?</th>
                            <th class="border px-3 py-2 w-24">Result</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border px-3 py-2">
                                    {{ $item->visualItem?->name ?? '—' }}
                                </td>
                                <td class="border px-3 py-2">
                                    {{ $item->remarks ?? '—' }}
                                </td>
                                <td class="border px-3 py-2">
                                    {{ $item->is_modified ? 'Yes' : 'No' }}
                                </td>

                                <td class="border px-3 py-2">
                                    {{ $item->result?->value ?? ($item->result ?? '—') }}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @endforeach

        </div>

    @endif

</div>
