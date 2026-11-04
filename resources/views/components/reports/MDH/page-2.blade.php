@props(['reportData'])
@php
    $rows = [
        [
            'no' => 1,
            'text' => 'الفحص الخارجي',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'EXTERNAL')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'EXTERNAL')?->remarks ?? '',
        ],
        [
            'no' => 2,
            'text' => 'الطول الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'LENGTH')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'LENGTH')?->remarks ?? '',
        ],

        [
            'no' => 3,
            'text' => 'العرض الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'WIDTH')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'WIDTH')?->remarks ?? '',
        ],

        [
            'no' => 4,
            'text' => 'الارتفاع الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'HEIGHT')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'HEIGHT')?->remarks ?? '',
        ],

        [
            'no' => 5,
            'text' => 'الوزن الإجمالي للمركبة (يكون التحقق من خلال لوحة تعريف بيانات المركبة)',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'GROSS-WEIGHT')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'GROSS-WEIGHT')?->remarks ?? '',
        ],

        [
            'no' => 6,
            'text' => 'الأوزان القصوى على المحاور',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'AXLE-LOADS')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'AXLE-LOADS')?->remarks ?? '',
        ],

        [
            'no' => 7,
            'text' => 'لون المركبة',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'COLOR')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'COLOR')?->remarks ?? '',
        ],

        [
            'no' => 8,
            'text' => 'الرقم المميز للمركبة',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'VIN')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'VIN')?->remarks ?? '',
        ],

        [
            'no' => 9,
            'text' => 'معلومات لوحة بيانات المركبة',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'INFORMATION-OF-VEHICLE')
                ?->result,
            'remarks' =>
                $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'INFORMATION-OF-VEHICLE')?->remarks ?? '',
        ],

        [
            'no' => 10,
            'text' => 'سلامة الهيكل الخارجي وقاعدة العجلات (الشاسيه) والجسور والقواطع',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BODY-BRIDGES')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BODY-BRIDGES')?->remarks ?? '',
        ],

        [
            'no' => 11,
            'text' => 'مجموعة التوصيلات الكهربائية',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'ELECTRICAL')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'ELECTRICAL')?->remarks ?? '',
        ],

        [
            'no' => 12,
            'text' => 'نظام المكابح',
            'result' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BRAKE-SYSTEM')?->result,
            'remarks' => $reportData['mdh_basic_items']->firstWhere('visualItem.code', 'BRAKE-SYSTEM')?->remarks ?? '',
        ],
    ];
@endphp

<div class="report-page">

    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.MDH.technical-requirements-table :rows="$rows" :reportData="$reportData" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 2 of 3'" />



</div>
