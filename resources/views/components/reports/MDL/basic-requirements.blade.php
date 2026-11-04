<div class="section-title">
    المتطلبات الأساسية للمركبات المعدلة
</div>

<table class="modified-basic-table">

    <tr>

        <th class="basic-head">
            الوزن الكلي
        </th>

        <th class="basic-head">
            الأبعاد
        </th>
        <td class="basic-head">
            عدد المحاور
        </td>

        <td class="basic-head" colspan="3">
            وزن المحاور
        </td>



    </tr>

    <tr>

        <td rowspan="2">
            {{ $reportData['total_weight'] }}
        </td>

        <td rowspan="2">
            {{ $reportData['width'] }} × {{ $reportData['length'] }} × {{ $reportData['height'] }}
        </td>
        <td rowspan="2">
            {{ $reportData['number_of_axles'] }}
        </td>
        <td>
            محور امامي </td>

        <td>
            محور خلفي </td>

        <td>
            اخري
        </td>



    </tr>
    <tr>


        <td>
            {{ $reportData['front_axle_weight'] }}
        </td>

        <td>
            {{ $reportData['rear_axle_weight'] }}
        </td>
        <td>
            {{ $reportData['other_axle_weight'] }}
        </td>

    </tr>


</table>
