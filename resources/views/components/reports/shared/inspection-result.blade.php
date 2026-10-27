<?php
$result = $inspection->final_result;

?>

<div class="mt-8 flex justify-center">

    <table class="w-[380px] table-fixed border border-gray-300 border-collapse">

        <tr>

            <td class="border border-gray-300 py-3 text-center font-bold">
                {{ $result }}
            </td>
            <th class="w-1/2 border border-gray-300 bg-gray-50 py-3 text-center font-bold">
                <span>:</span>
                <span>نتيجة الفحص </span>
            </th>
        </tr>

    </table>

</div>
