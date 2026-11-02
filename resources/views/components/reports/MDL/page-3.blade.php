<?php

$technicalRequirements = [
    [
        'sn' => '3',
        'item' => 'Exhaust System',
        'ref' => ['4/3/3/A', '4/3/3/B', '4/3/3/C'],
        'check' => 'Visual Inspection',
        'requirements' => ['Check for any leakage : it shall be leak-proof.', 'The exhaust fume discharge must be directed to the outside that its direction does not meet side windows or flammable objects, if the exhaust is in the rear part, on the side of the vehicle’s body, or on the top.', 'It’s not permitted for any part of vehicle to pass through the passenger compartment or in a place close to the fuel system or directed towards a part added to the vehicle that is combustible or flammable.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'EXHAUST')->first()->result,
    ],

    [
        'sn' => '4',
        'item' => 'Fuel System',
        'ref' => ['4/3/4/A', '4/3/4/B', '4/3/4/C', '4/3/4/D'],
        'check' => 'Visual Inspection',
        'requirements' => ['If applicable, The modified fuel system in the vehicle shall be firmly fixed to the vehicle and shall not obstruct the operation and movement of the modified vehicle.', 'If applicable, The modified fuel system shall be of a leak-proof design and shall be securely fastened.', 'If applicable, fuel lines shall not be in contact with high temperature surfaces or moving parts.', 'If applicable, the fuel tank shall not place in the engine compartment.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'FUEL')->first()->result,
    ],

    [
        'sn' => '5',
        'item' => 'Brake System',
        'ref' => ['4/3/5/A', '4/3/5/B'],
        'check' => 'Annex 2',
        'requirements' => ['If applicable, the modified vehicle must be equipped with a manual hand emergency brake.', 'If applicable, the complete brake system replacement shall comply with the requirements so the standards. Proceed to test Service and hand brake (Annex 2).'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'BRAKE')->first()->result,
    ],

    [
        'sn' => '6',
        'item' => 'External Edges and Protrusions',
        'ref' => ['4/3/6/A', '4/3/6/B'],
        'check' => 'Visual Inspection',
        'requirements' => ['The structure / body of the vehicle must be free from sharp edges in the internal and external places.', 'If applicable, check if there is any "unchamfered" windows, holes or openings.'],
        'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'EDGES')->first()->result,
    ],
];

?>



<div class="report-page">

    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.MDL.details-table :reportData="$reportData" :rows="$technicalRequirements" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 3 of 7'" />

</div>
