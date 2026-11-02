{{-- resources/views/components/reports/IMP/imported-vehicle.blade.php --}}


@props(['reportData'])


<x-reports.IMP.page-1 :reportData="$reportData" />

<div class="page-break"></div>

<x-reports.IMP.page-2 :reportData="$reportData" />

<div class="page-break"></div>

<x-reports.IMP.page-3 :reportData="$reportData" />

<div class="page-break"></div>

<x-reports.IMP.page-4 :reportData="$reportData" />
