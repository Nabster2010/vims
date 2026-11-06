{{-- resources/views/reports/pdf.blade.php --}}

<x-reports.shared.layout>

    @switch($reportData['inspection_type_code'])
        @case('IMP')
            <x-reports.IMP.imported-vehicle :reportData="$reportData" />
        @break

        @case('MDL')
            <x-reports.MDL.modified-vehicle-light :reportData="$reportData" />
        @break

        @case('MDH')
            <x-reports.MDH.modified-vehicle-heavy :reportData="$reportData" />
        @break

        @case('SBG')
            <x-reports.SABER.saber-vehicle :reportData="$reportData" />
        @break

        @case('MTC')
            <x-reports.MTC.motorcycle :reportData="$reportData" />
        @break

        @case('TRL')
            <x-reports.TRL.trailer :reportData="$reportData" />
        @break
    @endswitch

</x-reports.shared.layout>
