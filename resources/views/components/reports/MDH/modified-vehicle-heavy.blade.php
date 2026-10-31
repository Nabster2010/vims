@props(['inspection'])

<x-reports.MDH.page-1 :inspection="$inspection" />
<div class="page-break"></div>
<x-reports.MDH.page-2 :inspection="$inspection" />
<div class="page-break"></div>
<x-reports.MDH.page-3 :inspection="$inspection" />
<div class="page-break"></div>
<x-reports.shared.photos :inspection="$inspection" />
<div class="page-break"></div>
