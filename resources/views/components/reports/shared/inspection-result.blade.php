{{-- resources/views/components/reports/shared/inspection-result.blade.php --}}

@php
    $result = match ($inspection->final_result?->value ?? $inspection->final_result) {
        'Pass' => 'مطابق',
        'Fail' => 'غير مطابق',
        default => $inspection->final_result,
    };
@endphp
@props(['inspection'])

<div class="inspection-result">

    <table class="inspection-result-table">

        <tr>

            <td class="inspection-result-value">
                {{ $result }}
            </td>

            <td class="inspection-result-title">
                نتيجة الفحص
            </td>

        </tr>

    </table>

</div>
