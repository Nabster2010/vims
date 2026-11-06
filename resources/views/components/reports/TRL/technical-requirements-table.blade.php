<div class="section-title section-title-underline">
    المتطلبات الفنية للمقطورات
</div>

<table class="modified-checklist">

    <thead>

        <tr>
            <th class="no-col">م</th>
            <th class="item-col">البند</th>
            <th class="status-col">Pass</th>
            <th class="status-col">Fail</th>
            <th class="status-col">N/A</th>
            <th style="width: 60mm">ملاحظات</th>
        </tr>

    </thead>

    <tbody>



        @foreach ($reportData['trl_basic_items'] as $item)
            <tr>

                <td class="item-number">
                    {{ $item->visualItem->sort_order }}
                </td>
                <td class="item-text">
                    {{ $item->visualItem->name_ar }}
                </td>

                <td class="checkbox-cell" style="padding:1.3mm;">
                    {{ $item->result === \App\Enums\InspectionResult::Pass ? '☒' : '☐' }}
                </td>
                <td class="checkbox-cell" style="padding:1.3mm;">
                    {{ $item->result === \App\Enums\InspectionResult::Fail ? '☒' : '☐' }}
                </td>
                <td class="checkbox-cell" style="padding:1.3mm;">
                    {{ $item->result === \App\Enums\InspectionResult::NotApplicable ? '☒' : '☐' }}
                </td>
                <td>{{ $item->remarks }}</td>

            </tr>
        @endforeach

    </tbody>

</table>
