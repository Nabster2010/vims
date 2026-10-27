<div class="mt-6">

    <h2 class="mb-4 text-center text-2xl font-bold">
        Technical Requirement for Modified Vehicle
    </h2>

    <table class="w-full table-fixed border border-black text-center text-sm">

        <thead class="bg-gray-100">

            <tr>

                <th class="w-12 border p-2">
                    S/N
                </th>

                <th class="w-36 border p-2">
                    Item
                </th>

                <th class="w-24 border p-2">
                    Ref.
                </th>

                <th class="w-32 border p-2">
                    Modified
                    <br>
                    Yes / No
                </th>

                <th class="w-32 border p-2">
                    How to Check
                </th>

                <th class="border p-2">
                    Requirements
                </th>

                <th class="w-32 border p-2">
                    Result
                </th>

                <th class="w-32 border p-2">
                    Final Result
                </th>

            </tr>

        </thead>

        <tbody>

            @php

                $rows = [
                    [
                        'sn' => 1,
                        'item' => 'Engine',
                        'ref' => '1/3/4',
                        'modified' => '',
                        'check' => 'Check Document<br>Inspection Report',
                        'requirements' => [
                            'Weights if changed',
                            'Dimensions if changed',
                            'Brakes if applicable',
                            'Suspension if applicable',
                            'Vehicle upgraded using approved parts',
                        ],
                        'result' => 'PASS',
                        'final' => 'PASS',
                    ],

                    [
                        'sn' => 2,
                        'item' => 'Transmission',
                        'ref' => '2/3/4',
                        'modified' => '',
                        'check' => 'Check Document<br>Inspection Report',
                        'requirements' => ['Gearbox', 'Automatic / Manual conversion allowed if safe'],
                        'result' => '--',
                        'final' => '--',
                    ],

                    [
                        'sn' => 3,
                        'item' => 'Exhaust System',
                        'ref' => 'A/3/3/4',
                        'modified' => '',
                        'check' => 'Visual Inspection',
                        'requirements' => ['Leak proof', 'Outlet direction', 'No passenger compartment intrusion'],
                        'result' => '--',
                        'final' => '--',
                    ],

                    [
                        'sn' => 4,
                        'item' => 'Fuel System',
                        'ref' => '4/3/4',
                        'modified' => '',
                        'check' => 'Visual Inspection',
                        'requirements' => [
                            'Secure mounting',
                            'Leak proof',
                            'Away from hot surfaces',
                            'Tank not inside engine compartment',
                        ],
                        'result' => '--',
                        'final' => '--',
                    ],
                    [
                        'sn' => 5,
                        'item' => 'Fuel System',
                        'ref' => '4/3/4',
                        'modified' => '',
                        'check' => 'Visual Inspection',
                        'requirements' => [
                            'Secure mounting',
                            'Leak proof',
                            'Away from hot surfaces',
                            'Tank not inside engine compartment',
                        ],
                        'result' => '--',
                        'final' => '--',
                    ],
                ];

            @endphp

            @foreach ($rows as $row)
                <tr class="align-top">

                    <td class="border p-2">
                        {{ $row['sn'] }}
                    </td>

                    <td class="border p-2 font-semibold">
                        {{ $row['item'] }}
                    </td>

                    <td class="border p-2">
                        {{ $row['ref'] }}
                    </td>

                    <td class="border p-2">
                        {{ $row['modified'] }}
                    </td>

                    <td class="border p-2">
                        {!! $row['check'] !!}
                    </td>

                    <td class="border p-0">

                        <table class="w-full border-collapse">

                            @foreach ($row['requirements'] as $req)
                                <tr>

                                    <td class="border-b p-2 text-left">

                                        {{ $req }}

                                    </td>

                                </tr>
                            @endforeach

                        </table>

                    </td>

                    <td class="border p-2 font-semibold">

                        {{ $row['result'] }}

                    </td>

                    <td class="border p-2 font-semibold">

                        {{ $row['final'] }}

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</div>
