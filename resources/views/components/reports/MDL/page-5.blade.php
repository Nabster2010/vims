@props(['inspection'])

<div class="report-page">

    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">
        <x-reports.IMP.technical-inspection-table :inspection="$inspection" />

    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 5 of 5'" />
</div>
