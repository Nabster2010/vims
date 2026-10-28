@props(['inspection', 'report'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" :report="$report" />
    <x-reports.shared.vin :inspection="$inspection" :report="$report" />
    <x-reports.MDL.vehicle-information :inspection="$inspection" :report="$report" />
    <x-reports.MDL.basic-requirements :inspection="$inspection" :report="$report" />
    <x-reports.shared.inspection-result :inspection="$inspection" :report="$report" />
    <x-reports.shared.remarks :inspection="$inspection" :report="$report" />
    <x-reports.shared.signature :inspection="$inspection" :report="$report" />
    <x-reports.shared.footer :inspection="$inspection" :report="$report" :page="'Page 1 of 3'" />



</div>
