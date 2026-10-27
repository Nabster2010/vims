@props(['inspection', 'report'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" :report="$report" />
    <x-reports.MDH.technical-requirements-table :inspection="$inspection" :report="$report" />

    <x-reports.shared.footer :inspection="$inspection" :report="$report" />



</div>
