{{-- resources/views/components/reports/shared/inspection-result.blade.php --}}
<div class="inspection-result">

    <table class="inspection-result-table">

        <tr>
            <td class="inspection-result-value {{ $reportData['final_result'] === 'غير مطابق' ? 'fail-result' : '' }}">
                {{ $reportData['final_result'] }}
            </td>

            <td class="inspection-result-title">
                نتيجة الفحص
            </td>

        </tr>

    </table>

</div>
