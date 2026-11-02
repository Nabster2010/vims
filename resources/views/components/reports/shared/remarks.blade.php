{{-- resources/views/components/reports/shared/remarks.blade.php --}}



@props(['reportData'])

<div class="remarks-section">

    <div class="remarks-box">

        <div class="remarks-title">
            ملاحظات
        </div>

        <div class="remarks-content">
            {{ $reportData['remarks'] }}
        </div>

    </div>

</div>
