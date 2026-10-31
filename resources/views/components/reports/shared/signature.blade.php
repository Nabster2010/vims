{{-- resources/views/components/reports/shared/signature.blade.php --}}

@props([
    'inspection',
    'inspectorSignature' => asset('images/reports/signatures/inspector.png'),
    'managerSignature' => asset('images/reports/signatures/manager.png'),
    'stamp' => asset('images/reports/stamp.png'),
])

<table class="signature-table">

    <tr>

        <td class="signature-header">
            المفتش
            <div class="signature-subtitle">
                Inspector
            </div>
        </td>

        <td class="signature-header">
            Stamp
        </td>

        <td class="signature-header">
            المدير الفني
            <div class="signature-subtitle">
                Technical Manager
            </div>
        </td>

    </tr>

    <tr>

        <td class="signature-name">
            {{ $inspection->vehicleInformation->inspector->name ?? '' }}
        </td>

        <td class="signature-name">
        </td>

        <td class="signature-name">
            {{ $inspection->branch->manager->name ?? '' }}
        </td>

    </tr>

    <tr>

        <td class="signature-image-cell">

            @if ($inspectorSignature)
                <img src="{{ $inspectorSignature }}" class="signature-image" alt="Inspector Signature">
            @endif

        </td>

        <td class="signature-image-cell">

            @if ($stamp)
                <img src="{{ $stamp }}" class="signature-image" alt="Stamp">
            @endif

        </td>

        <td class="signature-image-cell">

            @if ($managerSignature)
                <img src="{{ $managerSignature }}" class="signature-image" alt="Manager Signature">
            @endif

        </td>

    </tr>

</table>
