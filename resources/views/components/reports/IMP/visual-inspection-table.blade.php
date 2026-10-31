<?php

$visualInspection = $inspection->visualInspection->visualItemResults;

$groups = $visualInspection->load('visualItem')->groupBy(fn($result) => $result->visualItem->category);

$leftCategories = ['internal', 'interior', 'safety', 'modern_systems', 'fuel_economy', 'other'];

?>

<div class="visual-wrapper">
    <div class="section-title">
        تقرير الفحص الظاهري / ملحق (2)
    </div>
    {{-- Left --}}
    <table class="visual-table">

        <colgroup>
            <col class="result-col">
            <col class="item-col">
            <col class="number-col">
        </colgroup>

        <thead>

            <tr>

                <th colspan="3" class="table-title">
                    الفحص الداخلي
                </th>

            </tr>

            <tr>

                <th>الحالة</th>

                <th>البند</th>

                <th>م</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($leftCategories as $category)
                @php
                    $items = $groups[$category] ?? collect();

                    if ($items->isEmpty()) {
                        continue;
                    }
                @endphp

                <tr>

                    <td colspan="3" class="category-row">

                        {{ $items->first()->visualItem->category_ar }}

                    </td>

                </tr>

                @foreach ($items as $row)
                    <tr>

                        <td class="result-cell">
                            {{ $row->result }}
                        </td>

                        <td class="item-cell">
                            {{ $row->visualItem->name_ar }}
                        </td>

                        <td class="number-cell">
                            {{ $row->visualItem->sort_order }}
                        </td>

                    </tr>
                @endforeach
            @endforeach

        </tbody>

    </table>

    {{-- Right --}}
    <table class="visual-table">

        <colgroup>
            <col class="result-col">
            <col class="item-col">
            <col class="number-col">
        </colgroup>

        <thead>

            <tr>
                <th colspan="3" class="table-title">
                    الفحص الخارجي
                </th>
            </tr>

            <tr>

                <th>الحالة</th>

                <th>البند</th>

                <th>م</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($groups['external'] ?? [] as $row)
                <tr>

                    <td class="result-cell">
                        {{ $row->result }}
                    </td>

                    <td class="item-cell">
                        {{ $row->visualItem->name_ar }}
                    </td>

                    <td class="number-cell">
                        {{ $row->visualItem->sort_order }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>



</div>
