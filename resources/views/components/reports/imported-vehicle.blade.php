{{-- resources/views/components/reports/imported-vehicle.blade.php --}}

@props(['inspection', 'report'])

<x-reports.imported-vehicle.page-1 :inspection="$inspection" :report="$report" />

<div class="page-break"></div>

<x-reports.imported-vehicle.page-2 :inspection="$inspection" :report="$report" />

<div class="page-break"></div>

<x-reports.imported-vehicle.page-3 :inspection="$inspection" :report="$report" />
