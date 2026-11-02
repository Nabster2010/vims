@php
    function getResultByItemName($reportData, $code, $category)
    {
        $result = $reportData['mdl_basic_items']
            ->where('visualItem.code', $code)
            ->where('visualItem.category', $category)
            ->first();

        return $result?->result === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل';
    }

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

        <tr>
            <td>
                1
            </td>
            <td>
                4.3.1
            </td>
            <td class="item-cell">
                المحرك </td>
            <td class="check-cell">

            </td>



            <td
                class="pass-cell {{ getResultByItemName($reportData, 'ENGINE', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'ENGINE', 'MDL-BASIC') }}
            </td>
        </tr>
        <tr>
            <td>
                2
            </td>
            <td>
                4.3.2
            </td>
            <td class="item-cell">
                نظام نقل الحركة </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'TRANSMISSION', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'TRANSMISSION', 'MDL-BASIC') }} </td>
        </tr>
        <tr>
            <td>
                3
            </td>
            <td>
                4.3.3
            </td>
            <td class="item-cell">
                أنظمة العادم </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'EXHAUST', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'EXHAUST', 'MDL-BASIC') }} </td>
        </tr>
        <tr>
            <td>
                4
            </td>
            <td>
                4.3.4
            </td>
            <td class="item-cell">
                نظام الوقود </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'FUEL', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'FUEL', 'MDL-BASIC') }} </td>
            </td>
        </tr>

        <tr>
            <td>
                5
            </td>
            <td>
                4.3.5
            </td>
            <td class="item-cell">
                نظام الفرامل </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'BRAKE', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'BRAKE', 'MDL-BASIC') }} </td>
            </td>
        </tr>
        <tr>
            <td>
                6
            </td>
            <td>
                4.3.6
            </td>
            <td class="item-cell">
                الحواف والنتوءات الخارجية </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'EDGES', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'EDGES', 'MDL-BASIC') }} </td>
            </td>
        </tr>
        <tr>
            <td>
                7
            </td>
            <td>
                4.3.7
            </td>
            <td class="item-cell">
                عجلة القيادة </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'STEERING', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'STEERING', 'MDL-BASIC') }} </td>
            </td>
        </tr>
        <tr>
            <td>
                8
            </td>
            <td>
                4.3.8
            </td>
            <td class="item-cell">
                الإطارات والعجلات </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'TIRES', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'TIRES', 'MDL-BASIC') }} </td>
            </td>
        </tr>
        <tr>
            <td>
                9
            </td>
            <td>
                4.3.9
            </td>
            <td class="item-cell">
                أنظمة الترفيه </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'ENTERTAINMENT', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'ENTERTAINMENT', 'MDL-BASIC') }} </td>
            </td>
        </tr>
        <tr>
            <td>
                10
            </td>
            <td>
                4.3.10
            </td>
            <td class="item-cell">
                الهيكل والشاسية </td>
            <td class="check-cell">

            </td>
            <td
                class="pass-cell {{ getResultByItemName($reportData, 'CHASSIS', 'MDL-BASIC') === 'فشل' ? 'fail-result' : '' }}">
                {{ getResultByItemName($reportData, 'CHASSIS', 'MDL-BASIC') }} </td>
            </td>
        </tr>

    </tbody>

</table>
