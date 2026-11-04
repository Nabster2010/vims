@php

    $items = [
        [
            'no' => 1,
            'reference' => '4.3.1',
            'code' => 'ENGINE',
            'category' => 'MDL-BASIC',
            'name' => 'المحرك',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENGINE')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENGINE')->first()?->is_modified,
        ],
        [
            'no' => 2,
            'reference' => '4.3.2',
            'code' => 'TRANSMISSION',
            'category' => 'MDL-BASIC',
            'name' => 'نظام نقل الحركة',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'TRANSMISSION')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'TRANSMISSION')->first()
                ?->is_modified,
        ],
        [
            'no' => 3,
            'reference' => '4.3.3',
            'code' => 'EXHAUST',
            'category' => 'MDL-BASIC',
            'name' => 'أنظمة العادم',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'EXHAUST')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'EXHAUST')->first()?->is_modified,
        ],
        [
            'no' => 4,
            'reference' => '4.3.4',
            'code' => 'FUEL',
            'category' => 'MDL-BASIC',
            'name' => 'نظام الوقود',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'FUEL')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'FUEL')->first()?->is_modified,
        ],
        [
            'no' => 5,
            'reference' => '4.3.5',
            'code' => 'BRAKE',
            'category' => 'MDL-BASIC',
            'name' => 'نظام الفرامل',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'BRAKE')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'BRAKE')->first()?->is_modified,
        ],
        [
            'no' => 6,
            'reference' => '4.3.6',
            'code' => 'EDGES',
            'category' => 'MDL-BASIC',
            'name' => 'الحواف والنتوءات الخارجية',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'EDGES')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'EDGES')->first()?->is_modified,
        ],
        [
            'no' => 7,
            'reference' => '4.3.7',
            'code' => 'STEERING',
            'category' => 'MDL-BASIC',
            'name' => 'عجلة القيادة',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'STEERING')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'STEERING')->first()
                ?->is_modified,
        ],
        [
            'no' => 8,
            'reference' => '4.3.8',
            'code' => 'TIRES',
            'category' => 'MDL-BASIC',
            'name' => 'الإطارات والعجلات',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'TIRES')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'TIRES')->first()?->is_modified,
        ],
        [
            'no' => 9,
            'reference' => '4.3.9',
            'code' => 'ENTERTAINMENT',
            'category' => 'MDL-BASIC',
            'name' => 'أنظمة الترفيه',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENTERTAINMENT')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'ENTERTAINMENT')->first()
                ?->is_modified,
        ],
        [
            'no' => 10,
            'reference' => '4.3.10',
            'code' => 'CHASSIS',
            'category' => 'MDL-BASIC',
            'name' => 'الهيكل والشاسية',
            'result' => $reportData['mdl_basic_items']->where('visualItem.code', 'CHASSIS')->first()?->result,
            'is_modified' => $reportData['mdl_basic_items']->where('visualItem.code', 'CHASSIS')->first()?->is_modified,
        ],
    ];

@endphp
<div class="section-title">
    المتطلبات الفنية للمركبات المعدلة
</div>

<table class="modified-technical-table">

    <thead>

        <tr>

            <th class="mt-no">
                م
            </th>

            <th class="mt-reference">
                المرجع
            </th>
            <th class="mt-item">
                البند
            </th>
            <th class="mt-modified">
                تم التعديل
            </th>
            <th class="mt-result">
                النتيجة
            </th>

        </tr>

    </thead>

    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>
                    {{ $item['no'] }}
                </td>
                <td>
                    {{ $item['reference'] }}
                </td>
                <td class="item-cell">
                    {{ $item['name'] }} </td>
                <td class="check-cell">
                    {{ $item['is_modified'] ? '✓' : '' }}
                </td>



                <td class="pass-cell {{ $item['result'] === 'فشل' ? 'fail-result' : '' }}">
                    {{ $item['result'] }}
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
