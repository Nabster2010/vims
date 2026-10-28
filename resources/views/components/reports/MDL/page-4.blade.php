@props(['inspection', 'report'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" :report="$report" />
    <x-reports.IMP.visual-inspection-table :inspection="$inspection" :report="$report" />
    <x-reports.shared.footer :inspection="$inspection" :report="$report" :page="'Page 4 of 5'" />


</div>
