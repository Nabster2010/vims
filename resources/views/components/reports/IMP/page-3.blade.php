@props(['inspection'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" />


    < <x-reports.IMP.technical-inspection-table :inspection="$inspection" />


    <x-reports.shared.footer :inspection="$inspection" />



</div>
