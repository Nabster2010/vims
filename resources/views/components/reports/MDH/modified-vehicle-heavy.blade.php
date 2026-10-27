@props(['inspection', 'report'])

<x-reports.MDH.page-1 :inspection="$inspection" :report="$report" />

<div class="page-break"></div>

<x-reports.MDH.page-2 :inspection="$inspection" :report="$report" />
<div class="page-break"></div>
<x-reports.MDH.page-3 :inspection="$inspection" :report="$report" />

<div class="page-break"></div>
