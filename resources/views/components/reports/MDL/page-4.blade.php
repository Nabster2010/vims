<?php
$technicalRequirements = [
    [
        'sn' => '7',
        'item' => 'Steering Wheel',
        'ref' => ['4/3/7/A'],
        'check' => 'Visual Inspection',
        'requirements' => ['If applicable, The modified steering wheel must be circular – fully or partially.', 'If applicable, the steering system must remain unobstructed for its complete rotation.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'STEERING')->first()->result,
        'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'STEERING')->first()->is_modified,
    ],

    [
        'sn' => '8',
        'item' => 'Tires and Wheels',
        'ref' => ['4/3/8/A', '4/3/8/B', '4/3/8/C'],
        'check' => 'Visual Inspection',
        'requirements' => ['If applicable, the replaced wheels shall comply the requirements, refer to annex 1 Visual external inspection.', 'If applicable, the replaced tires shall not be in contact with any part of the vehicle\'s body while travelling.', 'If applicable, it’s obligatory to adhere to the limits of the classified load of the replaced wheels.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'TIRES')->first()->result,
        'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'TIRES')->first()->is_modified,
    ],

    [
        'sn' => '9',
        'item' => 'Entertainment System',
        'ref' => ['4/3/9/A', '4/3/9/B'],
        'check' => 'Visual Inspection',
        'requirements' => ['When installing the visual display units of the entertainment system inside the vehicle, they must not interfere with the driver\'s field of vision.', 'The electrical system shall be adequately protected from fire hazards.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENTERTAINMENT')->first()->result,
        'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENTERTAINMENT')->first()->is_modified,
    ],

    [
        'sn' => '10',
        'item' => 'Body and Chassis',
        'ref' => ['4/3/10/A', '4/3/10/B'],
        'check' => 'Visual Inspection',
        'requirements' => ['The modified vehicle\'s structure shall be composed of structural beams or channels, or structural tubes, capable of supporting the vehicle, its load and torque in all opening conditions.', 'The chassis must be solid, free of cracks and apparent weakness indicators.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'CHASSIS')->first()->result,
        'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'CHASSIS')->first()->is_modified,
    ],
];

?>
@props(['reportData'])

<div class="report-page">
    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.MDL.details-table :reportData="$reportData" :rows="$technicalRequirements" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 4 of 7'" />
</div>
