@php
    $rows = [
        [
            'no' => 13,
            'text' => 'الانوار ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'LAMPS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'LAMPS')?->remarks ?? '',
        ],
        [
            'no' => 14,
            'text' => ' انوار اشارات الدوران الامامية والجانبية والخلفية',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'TURN-SIGNAL')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'TURN-SIGNAL')?->remarks ?? '',
        ],
        [
            'no' => 15,
            'text' => ' انوار السير الي الخلف',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'REVERSING-LAMPS')?->result,
            'remarks' =>
                $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'REVERSING-LAMPS')?->remarks ?? '',
        ],
        [
            'no' => 16,
            'text' => 'نظام التعليق',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SUSPENSION')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SUSPENSION')?->remarks ?? '',
        ],
        [
            'no' => 17,
            'text' => 'النوابض الامامية والخلفية ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SPRINGS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SPRINGS')?->remarks ?? '',
        ],
        [
            'no' => 18,
            'text' => 'ممتص الصدمات ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SHOCK-ABSORBERS')?->result,
            'remarks' =>
                $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'SHOCK-ABSORBERS')?->remarks ?? '',
        ],
        [
            'no' => 19,
            'text' => 'نظام العادم',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'EXHAUST-SYS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'EXHAUST-SYS')?->remarks ?? '',
        ],

        [
            'no' => 20,
            'text' => ' المرايا الجانبية الخارجية للرؤية الخلفية ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'MIRRORS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'MIRRORS')?->remarks ?? '',
        ],
        [
            'no' => 21,
            'text' => 'نظام الوقود',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'FUEL-SYSTEM')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'FUEL-SYSTEM')?->remarks ?? '',
        ],
        [
            'no' => 22,
            'text' => 'العجلة الخامسة ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'FIFTH-WHEEL')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'FIFTH-WHEEL')?->remarks ?? '',
        ],
        [
            'no' => 23,
            'text' => 'الحواجز ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BARRIERS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BARRIERS')?->remarks ?? '',
        ],
        [
            'no' => 24,
            'text' => 'الشاحنات المجهزة بمنازل  ',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'HOME-TRUCKS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'HOME-TRUCKS')?->remarks ?? '',
        ],
    ];
@endphp

<div class="report-page">

    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.MDH.technical-requirements-table :rows="$rows" :reportData="$reportData" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 3 of 3'" />

</div>
