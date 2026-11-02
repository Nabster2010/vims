<?php

$technicalRequirements = [
    [
        'sn' => '1',
        'item' => 'Engine',
        'ref' => ['1/3/4'],
        'check' => 'Check Document : Inspection report (1).',
        'requirements' => ['Following items shall comply:', 'Weights if changed.', 'Dimensions if changed.', 'Brakes if applicable.', 'Suspension if applicable.', 'If applicable, the vehicle shall be upgraded with appropriate parts and equipment’s.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENGINE')->first()->result,
    ],

    [
        'sn' => 2,
        'item' => 'Transmission',
        'ref' => ['2/3/4'],
        'check' => 'Check Document : Inspection report (1).',
        'requirements' => ['Following items shall comply:', 'Gearbox.', 'Transferring between a manual system to an automatic system or vice versa is allowed as long as it does not affect the movement and safety of vehicle.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'TRANSMISSION')->first()->result,
    ],
];
?>


<div class="report-page">

    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.MDL.technical-requirements :reportData="$reportData" />
        <x-reports.MDL.details-table :reportData="$reportData" :rows="$technicalRequirements" />

    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 2 of 7'" />

</div>
