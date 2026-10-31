@props(['inspection'])

<div class="report-page">
    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">
        <x-reports.IMP.visual-inspection-table :inspection="$inspection" />
    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 4 of 5'" />
</div>
