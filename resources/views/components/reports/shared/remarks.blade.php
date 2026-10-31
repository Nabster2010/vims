{{-- resources/views/components/reports/shared/remarks.blade.php --}}

@props(['inspection'])

<div class="remarks-section">

    <div class="remarks-box">

        <div class="remarks-title">
            ملاحظات
        </div>

        <div class="remarks-content">
            {{ $inspection->vehicleInformation->remarks ?? '—' }}
        </div>

    </div>

</div>
