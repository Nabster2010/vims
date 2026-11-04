{{-- <pre>{{ dd($reportData['mtcBasicItems'][0]->visualItem->name) }}</pre> --}}

<div class="section-title">
    المتطلبات الفنية للدرجات
</div>

<table class="modified-checklist">
    <thead>
        <tr>
            <th class="no-col" rowspan="2">م</th>
            <th class="item-col" rowspan="2">البند</th>
            <th colspan="3" style="width: 45mm; height:5mm">القبول والرفض </th>
        </tr>
        <tr>
            <th class="status-col">Pass</th>
            <th class="status-col">Fail</th>
            <th class="status-col">N/A</th>
        </tr>

    </thead>

    <tbody>



        @foreach ($reportData['mtcBasicItems'] as $item)
            <tr>

                <td class="item-number" style="padding:1.3mm;">
                    {{ $item->visualItem->sort_order }}
                </td>
                <td class="item-text" style="padding:1.3mm;">
                    {{ $item->visualItem->name }}
                    <br>
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

            </tr>
        @endforeach

    </tbody>

</table>
