@props(['inspection', 'report'])

<div class="page">

    <x-reports.header :inspection="$inspection" :report="$report" />
    <x-reports.imported-vehicle.vin :inspection="$inspection" :report="$report" />
    <x-reports.imported-vehicle.vehicle-information :inspection="$inspection" :report="$report" />
    <x-reports.imported-vehicle.inspection-result :inspection="$inspection" :report="$report" />
    <x-reports.imported-vehicle.remarks :inspection="$inspection" :report="$report" />
    <x-reports.imported-vehicle.signatures :inspection="$inspection" :report="$report" />

    <x-reports.footer :inspection="$inspection" :report="$report" />



</div>
