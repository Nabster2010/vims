@props(['inspection', 'report'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" :report="$report" />
    <x-reports.MDL.details-table :inspection="$inspection" :report="$report" />
    <x-reports.shared.footer :inspection="$inspection" :report="$report" />



</div>
