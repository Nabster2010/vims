<?php
$rows = [
    [
        'sn' => 5,
        'item' => 'Engine',
        'ref' => '1/3/4',
        'modified' => '',
        'check' => 'Check Document<br>Inspection Report',
        'requirements' => ['Weights if changed', 'Dimensions if changed', 'Brakes if applicable', 'Suspension if applicable', 'Vehicle upgraded using approved parts'],
        'result' => 'PASS',
        'final' => 'PASS',
    ],

    [
        'sn' => 6,
        'item' => 'Transmission',
        'ref' => '2/3/4',
        'modified' => '',
        'check' => 'Check Document<br>Inspection Report',
        'requirements' => ['Gearbox', 'Automatic / Manual conversion allowed if safe'],
        'result' => '--',
        'final' => '--',
    ],

    [
        'sn' => 7,
        'item' => 'Exhaust System',
        'ref' => 'A/3/3/4',
        'modified' => '',
        'check' => 'Visual Inspection',
        'requirements' => ['Leak proof', 'Outlet direction', 'No passenger compartment intrusion'],
        'result' => '--',
        'final' => '--',
    ],

    [
        'sn' => 8,
        'item' => 'Fuel System',
        'ref' => '4/3/4',
        'modified' => '',
        'check' => 'Visual Inspection',
        'requirements' => ['Secure mounting', 'Leak proof', 'Away from hot surfaces', 'Tank not inside engine compartment'],
        'result' => '--',
        'final' => '--',
    ],
    [
        'sn' => 9,
        'item' => 'Fuel System',
        'ref' => '4/3/4',
        'modified' => '',
        'check' => 'Visual Inspection',
        'requirements' => ['Secure mounting', 'Leak proof', 'Away from hot surfaces', 'Tank not inside engine compartment'],
        'result' => '--',
        'final' => '--',
    ],
    [
        'sn' => 10,
        'item' => 'Fuel System',
        'ref' => '4/3/4',
        'modified' => '',
        'check' => 'Visual Inspection',
        'requirements' => ['Secure mounting', 'Leak proof', 'Away from hot surfaces', 'Tank not inside engine compartment'],
        'result' => '--',
        'final' => '--',
    ],
];

?>
@props(['inspection'])

<div class="report-page">
    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">
        <x-reports.MDL.details-table :inspection="$inspection" :rows="$rows" />
    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 3 of 5'" />
</div>
