@props(['inspection'])


<div class="report-page">
    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">
        <x-reports.shared.vin :inspection="$inspection" />
        <x-reports.MTC.motorcycle-information :inspection="$inspection" />
        <x-reports.MTC.basic-requirements :inspection="$inspection" />
        <x-reports.shared.inspection-result :inspection="$inspection" />
        <x-reports.shared.remarks :inspection="$inspection" />
        <x-reports.shared.signature :inspection="$inspection" />
    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 1 of 3'" />
</div>
