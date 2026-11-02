{{-- resources/views/reports/pdf.blade.php --}}

<x-reports.shared.layout>

    @switch($reportData['inspection_type_code'])
        @case('IMP')
            <x-reports.IMP.imported-vehicle :reportData="$reportData" />
        @break

        @case('MDL')
            <x-reports.MDL.modified-vehicle-light :reportData="$reportData" />
        @break

        {{-- @case('MDH')
            <x-reports.MDH.modified-vehicle-heavy :inspection="$inspection" />
        @break --}}

        {{-- @case('SBG')
            <x-reports.IMP.imported-vehicle :inspection="$inspection" />
            <x-reports.SABER.saber-info :inspection="$inspection" />
        @break --}}

        {{-- @case('MTC')
            <x-reports.MTC.motorcycle :inspection="$inspection" />
        @break --}}

        {{-- @case('TRL')
            <x-reports.TRL.trailer :inspection="$inspection" />
        @break  --}}
    @endswitch

</x-reports.shared.layout>
