@props([
    'reportData',
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
            {{ $reportData['inspector_name'] }}
        </td>

        <td class="signature-name">
        </td>

        <td class="signature-name">
            {{ $reportData['manager_name'] }}
        </td>

    </tr>

    <tr>

        <td class="signature-image-cell">

            <img src="{{ asset($reportData['inspector_name'] . '-signature' . '.jpeg') }}" class="signature-image"
                alt="Inspector Signature">

        </td>

        <td class="signature-image-cell">

            <img src="{{ asset($reportData['branch_code'] . '-stamp' . '.jpeg') }}" class="signature-image"
                alt="Stamp">

        </td>

        <td class="signature-image-cell">
            <img src="{{ asset($reportData['manager_name'] . '-signature' . '.jpeg') }}" class="signature-image"
                alt="Manager Signature">

        </td>

    </tr>

</table>
