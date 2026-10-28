<?php

$technicalTests = [
    [
        'spec' => 'م ق س 1284',
        'item' => '1/4/6',
        'name' => 'Exhaust Gas Test',
        'type' => 'gas',
        'result' => [
            'CO' => $inspection->emissionInspection->co,
            'HC' => $inspection->emissionInspection->hc,
            'Diesel' => $inspection->emissionInspection->diesel,
        ],
        'status' => $inspection->emissionInspection->result,
    ],

    [
        'spec' => 'م ق س 1284',
        'item' => '5/6',
        'name' => 'Headlight Alignment',
        'type' => 'headlight',
        'result' => [
            'Left' => '108 cd',
            'Right' => '114 cd',
        ],
        'status' => 'PASS',
    ],

    [
        'spec' => 'م ق س 1284',
        'item' => '2/6',
        'name' => 'Side Slip',
        'type' => 'single',
        'result' => '2.3',
        'status' => 'PASS',
    ],

    [
        'spec' => 'م ق س 1284',
        'item' => '7/6',
        'name' => 'Suspension',
        'type' => 'suspension',
        'result' => [
            'FR' => '65%',
            'FL' => '64%',
            'RR' => '62%',
            'RL' => '61%',
        ],
        'status' => 'PASS',
    ],

    [
        'spec' => 'م ق س 1284',
        'item' => '3/6',
        'name' => 'Brake',
        'type' => 'brake',
        'result' => [
            'Parking' => '32%',
            'Front' => '68%',
            'Rear' => '64%',
        ],
        'status' => 'PASS',
    ],
];
?>


@props(['inspection', 'report'])
<div class="space-y-6" dir="rtl">

    {{-- Title --}}
    <h2 class="text-center text-2xl font-bold">
        تقرير الفحوصات الفنية
    </h2>

    {{-- Technical Inspection Table --}}

    <table class="w-full border border-gray-400 border-collapse text-center text-sm">

        <thead class="bg-gray-100 font-bold">
            <tr>
                <th class="w-12 border p-2">م.</th>
                <th class="w-32 border p-2">المواصفة</th>
                <th class="w-20 border p-2">البند</th>
                <th class="w-56 border p-2">اسم الفحص</th>
                <th class="border p-2">النتائج</th>
                <th class="w-24 border p-2">المطابقة</th>
            </tr>
        </thead>

        <tbody>

            {{-- Exhaust --}}
            <tr>

                <td class="border">1</td>

                <td class="border">
                    SASO 2864
                </td>

                <td class="border">
                    1/4/6
                </td>

                <td class="border">
                    فحص غازات العادم
                </td>

                <td class="border p-0">

                    <div class="grid grid-cols-3">

                        <div class="border p-2 font-semibold">
                            CO
                        </div>

                        <div class="border p-2 font-semibold">
                            HC
                        </div>

                        <div class="border p-2 font-semibold">
                            Diesel
                        </div>

                        <div class="border p-2">
                            {{ $inspection->emissionInspection->co }}
                        </div>

                        <div class="border p-2">
                            {{ $inspection->emissionInspection->hc }}
                        </div>

                        <div class="border p-2">
                            {{ $inspection->emissionInspection->opacity }} %
                        </div>

                    </div>

                </td>

                <td class="border">
                    {{ $inspection->emissionInspection->result }}
                </td>

            </tr>

            {{-- Head Light --}}
            <tr>

                <td class="border">2</td>

                <td class="border">
                    SASO 2864
                </td>

                <td class="border">
                    5/6
                </td>

                <td class="border">
                    فحص الأنوار
                </td>

                <td class="border p-0">

                    <div class="grid grid-cols-2">

                        <div class="border p-2 font-semibold">
                            Left
                        </div>

                        <div class="border p-2 font-semibold">
                            Right
                        </div>

                        <div class="border p-2">
                            {{ $inspection->headLightInspection->right }}
                        </div>

                        <div class="border p-2">
                            {{ $inspection->headLightInspection->left }}
                        </div>

                    </div>

                </td>

                <td class="border">
                    {{ $inspection->headLightInspection->result }}
                </td>

            </tr>

            {{-- Side Slip --}}
            <tr>

                <td class="border p-2 ">3</td>

                <td class="border">
                    SASO 2864
                </td>

                <td class="border">
                    2/6
                </td>

                <td class="border">
                    Side Slip
                </td>

                <td class="border text-center">
                    2.3 m/km
                </td>

                <td class="border">
                    {{ $inspection->sideSlipInspection->result }}
                </td>

            </tr>

            {{-- Suspension --}}
            <tr>

                <td class="border">4</td>

                <td class="border">
                    SASO 2864
                </td>

                <td class="border">
                    7/6
                </td>

                <td class="border">
                    Suspension
                </td>

                <td class="border p-0">

                    <div class="grid grid-cols-4">

                        <div class="border p-2 font-semibold">FR</div>
                        <div class="border p-2 font-semibold">FL</div>
                        <div class="border p-2 font-semibold">RR</div>
                        <div class="border p-2 font-semibold">RL</div>

                        <div class="border p-2">{{ $inspection->suspensionInspection->front_right }}%</div>
                        <div class="border p-2">{{ $inspection->suspensionInspection->front_left }}%</div>
                        <div class="border p-2">{{ $inspection->suspensionInspection->rear_right }}%</div>
                        <div class="border p-2">{{ $inspection->suspensionInspection->rear_left }}%</div>

                    </div>

                </td>

                <td class="border">
                    {{ $inspection->suspensionInspection->result }}
                </td>

            </tr>
            {{-- Brake --}}
            <tr>

                <td class="border">5</td>

                <td class="border">
                    SASO 2864
                </td>

                <td class="border">
                    3/6
                </td>

                <td class="border">
                    Brake Test
                </td>

                <td class="border p-0">

                    <div class="grid grid-cols-3">

                        <div class="border p-2 font-semibold">
                            Parking
                        </div>

                        <div class="border p-2 font-semibold">
                            Front
                        </div>

                        <div class="border p-2 font-semibold">
                            Rear
                        </div>

                        <div class="border p-2">
                            {{ $inspection->brakeInspection->parking }}
                        </div>

                        <div class="border p-2">
                            {{ $inspection->brakeInspection->front }}
                        </div>

                        <div class="border p-2">
                            {{ $inspection->brakeInspection->rear }}
                        </div>

                    </div>

                </td>

                <td class="border">
                    {{ $inspection->brakeInspection->result }}
                </td>

            </tr>

        </tbody>

    </table>

</div>
