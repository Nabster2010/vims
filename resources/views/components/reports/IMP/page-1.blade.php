@props(['inspection'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" />
    <x-reports.shared.vin :inspection="$inspection" />
    <x-reports.IMP.vehicle-information :inspection="$inspection" />
    <x-reports.shared.inspection-result :inspection="$inspection" />
    <x-reports.shared.remarks :inspection="$inspection" />
    <x-reports.shared.signature :inspection="$inspection" />
    <x-reports.shared.footer :inspection="$inspection" />



</div>
